<!-- Modal -->
<div class="modal fade" id="tambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahPelangganLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="tambahPelangganLabel">Modal Tambah Pelanggan</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group mb-2">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" class="form-control form-input-dark" id="nama_pelanggan" name="nama_pelanggan" autocomplete="off" required>
                </div>
                <div class="form-group mb-2">
                    <label for="domisili">Domisili</label>
                    <input type="text" class="form-control form-input-dark" id="domisili" name="domisili" autocomplete="off" required>
                </div>
                <div class="form-group mb-2">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-select form-select form-input-dark" aria-label="Large select example" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="PRIA">PRIA</option>
                        <option value="WANITA">WANITA</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" onclick="simpanData()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
    function simpanData(){
        var container = document.getElementById('tambahPelanggan');

        if (container.querySelector('#nama_pelanggan').value == '') {
            return alert('Nama Pelanggan kosong!');
        }
        if (container.querySelector('#domisili').value == '') {
            return alert('Domisili kosong!');
        }
        if (container.querySelector('#jenis_kelamin').value == '') {
            return alert('Jenis Kelamin kosong!');
        }


        const formData = {
            nama: container.querySelector('#nama_pelanggan').value.toUpperCase(),
            domisili: container.querySelector('#domisili').value.toUpperCase(),
            jenis_kelamin: container.querySelector('#jenis_kelamin').value,
        };

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/pelanggan/save",
            data: formData,
            success: function (response) {
                if(response['status'] == 'true'){
                    container.querySelector('#nama_pelanggan').value = '';
                    container.querySelector('#domisili').value = '';
                    container.querySelector('#jenis_kelamin').value = '';

                    $('#tambahPelanggan').modal('hide');

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