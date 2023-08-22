<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col d-inline-flex align-items-center justify-content-between mb-4">
        <h5 class="text-light">Halaman Data Penjualan</h5>
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#tambahPenjualan">
        Tambah Data
        </button>
    </div>
    
    <div class="table-content overflow-y-auto">
        <table id="tablePenjualan" class="table table-dark" style="width:100%">
            <thead>
                <tr>
                    <th>NOTA</th>
                    <th>NAMA PELANGGAN</th>
                    <th>TANGGAL TRANSAKSI</th>
                    <th>TOTAL TRANSAKSI</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?= $this->include('pages/penjualan/modal_add_penjualan') ?>
<?= $this->include('pages/penjualan/modal_edit_penjualan') ?>
<?= $this->include('pages/penjualan/modal_detail_penjualan') ?>
<?= $this->include('pages/penjualan/modal_delete_penjualan') ?>

<script>    
    function editData($id){
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/api/penjualan/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("editPenjualan"));
                    modalInfo.show();

                    var container = document.getElementById('editPenjualan');
                    container.querySelector('#id_nota').value = response['data']['ID_NOTA'];
                    container.querySelector('#nama_pelanggan').value = response['data']['KODE_PELANGGAN'];
                    container.querySelector('#tanggal_transaksi').value = response['data']['TGL'];
                    container.querySelector('#total_transaksi').value = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(response['data']['SUB_TOTAL']);
                    listBarang = response['data']['item_penjualan'];

                    var tableBody = container.querySelector("#table-body-barang");
                    tableBody.innerHTML = ''
                    totalTransaksi = 0;

                    for (var i = 0; i < listBarang.length; i++) {
                        var row = tableBody.insertRow();
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);

                        cell1.innerHTML = (i + 1);
                        cell2.innerHTML = listBarang[i].KODE;
                        cell3.innerHTML = listBarang[i].NAMA;
                        cell4.innerHTML = listBarang[i].Qty;
                        cell5.innerHTML = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(listBarang[i].Qty * listBarang[i].HARGA);

                        var button = document.createElement("button");
                        button.className = "btn btn-danger list-barang";
                        button.innerText = "Hapus";
                        button.type = "button";
                        button.value = listBarang[i].KODE;

                        button.addEventListener("click", function() {
                            var row = this.parentNode.parentNode;
                            var id = row.querySelector('.list-barang').value;
                            
                            listBarang = listBarang.filter(function(barang) {
                                return barang.KODE !== id;
                            });

                            getTableListEdit();
                        });

                        cell6.appendChild(button);
                    }
          
                }
            },
            error: function () {
                alert('Terjadi Kesalahan');
            }
        });
    }

    function detailData($id){
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/api/penjualan/" + $id,
            success: function (response) {

                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("detailPenjualan"));
                    modalInfo.show();

                    var container = document.getElementById('detailPenjualan');
                    container.querySelector('#id_nota').value = response['data']['ID_NOTA'];
                    container.querySelector('#nama_pelanggan').value = response['data']['KODE_PELANGGAN'];
                    container.querySelector('#tanggal_transaksi').value = response['data']['TGL'];
                    container.querySelector('#total_transaksi').value = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(response['data']['SUB_TOTAL']);
                    listBarang = response['data']['item_penjualan'];

                    var tableBody = container.querySelector("#table-body-barang");
                    tableBody.innerHTML = ''
                    totalTransaksi = 0;

                    for (var i = 0; i < listBarang.length; i++) {
                        var row = tableBody.insertRow();
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);

                        cell1.innerHTML = (i + 1);
                        cell2.innerHTML = listBarang[i].KODE;
                        cell3.innerHTML = listBarang[i].NAMA;
                        cell4.innerHTML = listBarang[i].Qty;
                        cell5.innerHTML = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(listBarang[i].Qty * listBarang[i].HARGA);
                    }
          
                }
            },
            error: function () {
                alert('Terjadi Kesalahan');
            }
        });
    }

    function deleteData($id){
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/api/penjualan/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("deletePenjualan"));
                    modalInfo.show();

                    var container = document.getElementById('deletePenjualan');
                    container.querySelector('#id_nota').value = response['data']['ID_NOTA'];
                    container.querySelector('#nama_pelanggan').value = response['data']['KODE_PELANGGAN'];
                }
            },
            error: function () {
                alert('Terjadi Kesalahan');
            }
        });
    }

    function loadDataPenjualan() {
        $('#tablePenjualan').DataTable().destroy();
        $('#tablePenjualan').DataTable({
            "ajax" : "http://127.0.0.1:8000/api/penjualan",
            "columns" : [
                {data: "ID_NOTA"},
                {data: "NAMA"},
                {
                    data: "TGL",
                    render : function(data, type, row){
                        var formatted = moment(data).format('DD-MM-YYYY');
                        return formatted;
                    }
                },
                {
                    data: "SUB_TOTAL",
                    render : function(data,type,row){
                        var formatted = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(data);

                        return formatted;
                    }
                },
                {
                    data: "ID_NOTA",
                    render : function(data,type,row){
                        // return '<a href="#" class="btn btn-primary float-end"><i class="fa fa-pencil"></i></a>';
                        return `
                        <div class="col d-flex align-items-center">
                            <button onclick="detailData('${data}')" title="Detail Data" class="btn btn-warning float-end me-2"><i class="fa fa-eye"></i></button>
                            <button onclick="editData('${data}')" title="Edit Data" class="btn btn-primary float-end me-2"><i class="fa fa-pencil"></i></button>
                            <button onclick="deleteData('${data}')" title="Delete Data" class="btn btn-danger float-end me-2"><i class="fa fa-trash"></i></button>
                        </div>`
                    }
                },
            ]
        });
    };


    $(document).ready(function() {
        loadDataPenjualan();
    });
</script>

<?= $this->endSection(); ?>