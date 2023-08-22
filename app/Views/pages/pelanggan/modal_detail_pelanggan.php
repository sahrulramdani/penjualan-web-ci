<!-- Modal -->
<div class="modal fade" id="detailPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailPelangganLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="detailPelangganLabel">Modal Detail Pelanggan</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" id='formdetailPelanggan' method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group mb-2">
                    <label for="id_pelanggan">ID Pelanggan</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="id_pelanggan" name="id_pelanggan" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="nama_pelanggan" name="nama_pelanggan" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="domisili">Domisili</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="domisili" name="domisili" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-select form-select form-input-dark bg-dark" aria-label="Large select example" id="jenis_kelamin" name="jenis_kelamin" required readonly>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="PRIA">PRIA</option>
                        <option value="WANITA">WANITA</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
