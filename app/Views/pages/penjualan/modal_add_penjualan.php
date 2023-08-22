<!-- Modal -->
<div class="modal fade" id="tambahPenjualan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahPenjualanLabel" aria-hidden="true">
  <div class="modal-dialog modal-width-custom">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="tambahPenjualanLabel">Modal Tambah Penjualan</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="col d-flex mb-2">
                    <div class="col-lg-5 form-group mb-2">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <select class="form-select form-select form-input-dark" aria-label="Small select example" id="nama_pelanggan" name="nama_pelanggan" required>
                            <option value="">Pilih Pelanggan</option>
                        </select>
                    </div>
                    <div class="col-lg-3 form-group ms-2">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="date" class="form-control form-input-dark" id="tanggal_transaksi" name="tanggal_transaksi" autocomplete="off" required>
                    </div>
                    <div class="col-lg-3 form-group ms-2">
                        <label for="total_transaksi">Total Transaksi</label>
                        <input type="text" value='0' class="form-control form-input-dark bg-dark myFormat" id="total_transaksi" name="total_transaksi" autocomplete="off" readonly>
                    </div>
                </div>
                <hr style="color: white; height : 2px">
                <div class="col d-flex mb-2">
                    <div class="col-lg-6 form-group mb-2">
                        <label for="nama_barang">Nama Barang</label>
                            <select class="form-select form-select form-input-dark" aria-label="Small select example" id="nama_barang" name="nama_barang" onchange="getSubtotalAdd()">
                            <option value="" data-price="">Pilih Barang</option>
                        </select>
                    </div>
                    <div class="col-lg-1 form-group ms-2">
                        <label for="qty">Quantity</label>
                        <input type="number" value="0" class="form-control form-input-dark" id="qty" name="qty" autocomplete="off" min="1" onkeyup="getSubtotalAdd()" onchange="getSubtotalAdd()">
                    </div>
                    <div class="col-lg-3 form-group ms-2">
                        <label for="subtotal">Subtotal</label>
                        <input type="text" value='0' class="form-control form-input-dark bg-dark myFormat" id="subtotal" name="subtotal" autocomplete="off" readonly>
                    </div>
                    <div class="col-lg-3 form-group ms-2 d-flex align-items-center pt-3">
                        <button type="button" class="btn btn-success float-end" onclick="tambahDataAdd()">
                            Tambah
                        </button>
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
                                <th scope="col">Action</th>
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
        <button type="button" class="btn btn-primary" onclick="simpanData()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
    var hargaBarang = 0;
    var quantityBarang = 0;
    var totalTransaksi = 0;
    var listBarang = [];

    function getSubtotalAdd(){
        var container = document.getElementById('tambahPenjualan');
        var selectOpsi = container.querySelector('#nama_barang');
        var selectedOption = selectOpsi.options[selectOpsi.selectedIndex];
        var price = selectedOption.getAttribute("data-price");


        hargaBarang = price == '' ? 0 : price; 

        var container = document.getElementById('tambahPenjualan');
        var qty = container.querySelector('#qty').value;

        quantityBarang = qty == '' ? 0 : qty;
        var subTotal = (hargaBarang * qty);


        container.querySelector('#subtotal').value = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(subTotal);
    }

    function tambahDataAdd(){
        var container = document.getElementById('tambahPenjualan');

        if (container.querySelector('#nama_barang').value == '') {
            return alert('Nama Barang Kosong');
        }
        if (container.querySelector('#subtotal').value <= 0) {
            return alert('Subtotal 0');
        }


        var selectOpsi = container.querySelector('#nama_barang');

        var namaBarang = selectOpsi.options[selectOpsi.selectedIndex].textContent;

        kode = container.querySelector('#nama_barang').value;
        nama = namaBarang;
        qty = container.querySelector('#qty').value;
        subtotal = container.querySelector('#subtotal').value;

        listBarang.push({
            KODE : kode,
            NAMA_BRG : nama,
            QTY : qty,
            SUBTOTAL : subtotal,
        });

        container.querySelector('#nama_barang').value = '';
        container.querySelector('#qty').value = '0';
        container.querySelector('#subtotal').value = '0';

        getTableListAdd();
    }

    function getTableListAdd(){
        var container = document.getElementById('tambahPenjualan');
        var tableBody = container.querySelector("#table-body-barang");
        tableBody.innerHTML = ''
        totalTransaksi = 0;

        for (var i = 0; i < listBarang.length; i++) {
            totalTransaksi += parseInt(listBarang[i].SUBTOTAL.replaceAll(',',''));

            var row = tableBody.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            cell1.innerHTML = (i + 1);
            cell2.innerHTML = listBarang[i].KODE;
            cell3.innerHTML = listBarang[i].NAMA_BRG;
            cell4.innerHTML = listBarang[i].QTY;
            cell5.innerHTML = listBarang[i].SUBTOTAL;
            
            var button = document.createElement("button");
            button.className = "btn btn-danger list-barang";
            button.innerText = "Hapus";
            button.type = "button";
            button.value = i;

            button.addEventListener("click", function() {
                var row = this.parentNode.parentNode;
                var id = row.querySelector('.list-barang').value;
                
                listBarang = listBarang.filter(function(barang) {
                    return barang.KODE !== id;
                });

                getTableListAdd();
            });

            cell6.appendChild(button);
        }

        container.querySelector('#total_transaksi').value = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(totalTransaksi);
    }

    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1:8000/api/pelanggan",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var container = document.getElementById('tambahPenjualan');
                var select = container.querySelector('#nama_pelanggan');
                $.each(response['data'], function(index, item) {
                    var option = document.createElement('option');
                    option.value = item.ID_PELANGGAN;
                    option.textContent = item.NAMA;
                    select.appendChild(option);
                });

            }
        });

        $.ajax({
            url: "http://127.0.0.1:8000/api/barang",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var container = document.getElementById('tambahPenjualan');
                var select = container.querySelector('#nama_barang');
                $.each(response['data'], function(index, item) {
                    var option = document.createElement('option');
                    option.value = item.KODE;
                    option.textContent = item.NAMA;
                    option.setAttribute('data-price', item.HARGA)
                    select.appendChild(option);
                });
            }
        });
    });

    function simpanData(){
        var container = document.getElementById('tambahPenjualan');

        if (container.querySelector('#nama_pelanggan').value == '') {
            return alert('Nama Pelanggan kosong!');
        }
        if (container.querySelector('#tanggal_transaksi').value == '') {
            return alert('Tanggal kosong!');
        }
        if (listBarang.length <= 0) {
            return alert('Tidak ada Barang!');
        }


        const formData = {
            nama: container.querySelector('#nama_pelanggan').value,
            tanggal: moment(container.querySelector('#tanggal_transaksi').value).format('YYYY-MM-DD'),
            subtotal: container.querySelector('#total_transaksi').value.replaceAll(',',''),
            listItem: JSON.parse(JSON.stringify(listBarang)),
        };

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/penjualan/save",
            data: formData,
            success: function (response) {
                if(response['status'] == 'true'){
                    container.querySelector('#nama_pelanggan').value = '';
                    container.querySelector('#tanggal_transaksi').value = '';
                    container.querySelector('#total_transaksi').value = '0';

                    $('#tambahPenjualan').modal('hide');

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
            error: function (response) {
                alert('Terjadi Kesalahan');
            }
        });
    }
</script>