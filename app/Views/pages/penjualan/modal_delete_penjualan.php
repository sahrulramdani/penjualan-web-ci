<!-- Modal -->
<div class="modal fade" id="deletePenjualan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletePenjualanLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="deletePenjualanLabel">Modal Delete Penjualan</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3 mb-1">
                    Yakin Menghapus Data Penjualan ! : 
                </div>
                <div class="form-group mb-2">
                    <label for="id_nota">ID NOTA</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="id_nota" name="id_nota" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <select class="form-select form-select form-input-dark bg-dark" aria-label="Small select example" id="nama_pelanggan" name="nama_pelanggan" required disabled>
                        <option value="">Pilih Pelanggan</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" onclick="hapusData()">Yakin</button>
      </div>
    </div>
  </div>
</div>

<script>
    function hapusData(){
        var container = document.getElementById('deletePenjualan');
        var id = container.querySelector('#id_nota').value;
        $.ajax({
            type: "DELETE",
            url: "http://127.0.0.1:8000/api/penjualan/delete/" + id,
            success: function (response) {
                if(response['status'] == 'true'){
                    container.querySelector('#id_nota').value  = '';
                    container.querySelector('#nama_pelanggan').value  = '';


                    $('#deletePenjualan').modal('hide');

                    var modalInfo = new bootstrap.Modal(document.getElementById("modalSuccess"));
                    var divElement = document.querySelector(".pesan-success");
                    divElement.innerText = response['message'];

                    modalInfo.show();

                    loadDataPenjualan();
                }else{
                    var modalInfo = new bootstrap.Modal(document.getElementById("modalFail"));
                    var divElement = document.querySelector(".pesan-fail");
                    divElement.innerText = response['message'];
                    
                    modalInfo.show();
                };
            },
            error: function () {
                alert('Terjadi Kesalahan');
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1:8000/api/pelanggan",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var container = document.getElementById('deletePenjualan');
                var select = container.querySelector('#nama_pelanggan');

                $.each(response['data'], function(index, item) {
                    var option = document.createElement('option');
                    option.value = item.ID_PELANGGAN;
                    option.textContent = item.NAMA;
                    select.appendChild(option);
                });

            }
        });
    });
</script>