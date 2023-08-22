<!-- Modal -->
<div class="modal fade" id="detailBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailBarangLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="detailBarangLabel">Modal Detail Barang</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" id='formdetailBarang' method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group mb-2">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="kode_barang" name="kode_barang" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control form-input-dark bg-dark" id="nama_barang" name="nama_barang" autocomplete="off" required readonly>
                </div>
                <div class="form-group mb-2">
                    <label for="kategori">Kategori</label>
                    <select class="form-select form-select form-input-dark bg-dark" aria-label="Large select example" id="kategori" name="kategori" required disabled>
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
                    <input type="text" class="form-control form-input-dark myFormat bg-dark" id="harga" name="harga" autocomplete="off" required readonly>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>