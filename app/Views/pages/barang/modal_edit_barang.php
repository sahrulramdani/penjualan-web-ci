<!-- Modal -->
<div class="modal fade" id="editBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBarangLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="editBarangLabel">Modal Edit Barang</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" id='formEditBarang' method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group mb-2">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="kode_barang" name="kode_barang" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control form-input-dark" id="nama_barang" name="nama_barang" autocomplete="off" required>
                </div>
                <div class="form-group mb-2">
                    <label for="kategori">Kategori</label>
                    <select class="form-select form-select form-input-dark" aria-label="Large select example" id="kategori" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="ATK">ATK</option>
                        <option value="MASAK">MASAK</option>
                        <option value="RT">RT</option>
                        <option value="ELEKTRONIK">ELEKTRONIK</option>
                        <option value="PERKAKAS">PERKAKAS</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control form-input-dark myFormat" id="harga" name="harga" autocomplete="off" required>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" onclick="updateData()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
    function updateData(){
        var container = document.getElementById('editBarang');

        if (container.querySelector('#nama_barang').value == '') {
            return alert('Nama Barang kosong!');
        }
        if (container.querySelector('#kategori').value == '') {
            return alert('Kategori kosong!');
        }
        if (container.querySelector('#harga').value == '') {
            return alert('Harga kosong!');
        }


        const formData = {
            id: container.querySelector('#kode_barang').value,
            nama: container.querySelector('#nama_barang').value.toUpperCase(),
            kategori: container.querySelector('#kategori').value,
            harga: container.querySelector('#harga').value.toString().replaceAll(',',''),
        };

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/barang/update",
            data: formData,
            success: function (response) {
                if(response['status'] == 'true'){
                    container.querySelector('#kode_barang').value  = '';
                    container.querySelector('#nama_barang').value  = '';
                    container.querySelector('#kategori').value  = '';
                    container.querySelector('#harga').value  = '';

                    $('#editBarang').modal('hide');

                    var modalInfo = new bootstrap.Modal(document.getElementById("modalSuccess"));
                    var divElement = document.querySelector(".pesan-success");
                    divElement.innerText = response['message'];

                    modalInfo.show();

                    loadDataBarang();
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