<!-- Modal -->
<div class="modal fade" id="deletePelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletePelangganLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="deletePelangganLabel">Modal Delete Pelanggan</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3 mb-1">
                    Yakin Menghapus Pelanggan ! : 
                </div>
                <div class="form-group mb-2">
                    <label for="id_pelanggan">ID Pelanggan</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="id_pelanggan" name="id_pelanggan" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="nama_pelanggan" name="nama_pelanggan" autocomplete="off" required readonly>
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
        var container = document.getElementById('deletePelanggan');
        var id = container.querySelector('#id_pelanggan').value;
        $.ajax({
            type: "DELETE",
            url: "http://127.0.0.1:8000/api/pelanggan/delete/" + id,
            success: function (response) {
                if(response['status'] == 'true'){
                    container.querySelector('#id_pelanggan').value  = '';
                    container.querySelector('#nama_pelanggan').value  = '';


                    $('#deletePelanggan').modal('hide');

                    var modalInfo = new bootstrap.Modal(document.getElementById("modalSuccess"));
                    var divElement = document.querySelector(".pesan-success");
                    divElement.innerText = response['message'];

                    modalInfo.show();

                    loadDataPelanggan();
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
</script>