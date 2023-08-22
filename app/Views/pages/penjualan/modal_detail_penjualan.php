<!-- Modal -->
<div class="modal fade" id="detailPenjualan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailPenjualanLabel" aria-hidden="true">
  <div class="modal-dialog modal-width-custom">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="detailPenjualanLabel">Modal Detail Penjualan</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="col d-flex mb-2">
                    <div class="col-lg-5 form-group">
                        <label for="id_nota">ID Nota</label>
                        <input type="text" class="form-control form-input-dark bg-dark" id="id_nota" name="id_nota" autocomplete="off" readonly>
                    </div>
                    <div class="col-lg-5 form-group ms-2">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <select class="form-select form-select form-input-dark bg-dark" aria-label="Small select example" id="nama_pelanggan" name="nama_pelanggan" required disabled>
                            <option value="">Pilih Pelanggan</option>
                        </select>
                    </div>
                </div>
                <div class="col d-flex mb-2">
                    <div class="col-lg-3 form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="date" class="form-control form-input-dark" id="tanggal_transaksi" name="tanggal_transaksi" autocomplete="off" required>
                    </div>
                    <div class="col-lg-3 form-group ms-2">
                        <label for="total_transaksi">Total Transaksi</label>
                        <input type="text" value='0' class="form-control form-input-dark bg-dark myFormat" id="total_transaksi" name="total_transaksi" autocomplete="off" readonly>
                    </div>
                </div>
                <hr style="color: white; height : 2px">
                <div class="col d-flex mb-2 overflow-y-auto" style="height: 40vh;">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-barang">
                        </tbody>
                    </table>
                </div>
                
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>

<script>
    var listBarang = [];

    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1:8000/api/pelanggan",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var container = document.getElementById('detailPenjualan');
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