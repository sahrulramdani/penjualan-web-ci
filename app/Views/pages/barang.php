<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col d-inline-flex align-items-center justify-content-between mb-4">
        <h5 class="text-light">Halaman Data Barang</h5>
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#tambahBarang">
        Tambah Data
        </button>
    </div>
    
    <div class="table-content overflow-y-auto">
        <table id="tableBarang" class="table table-dark" style="width:100%">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA BARANG</th>
                    <th>KATEGORI</th>
                    <th>HARGA</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?= $this->include('pages/barang/modal_add_barang') ?>
<?= $this->include('pages/barang/modal_edit_barang') ?>
<?= $this->include('pages/barang/modal_detail_barang') ?>
<?= $this->include('pages/barang/modal_delete_barang') ?>

<script>    
    function editData($id){
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/api/barang/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("editBarang"));
                    modalInfo.show();

                    var container = document.getElementById('editBarang');
                    container.querySelector('#kode_barang').value = response['data']['KODE'];
                    container.querySelector('#nama_barang').value = response['data']['NAMA'];
                    container.querySelector('#kategori').value = response['data']['KATEGORI'];
                    container.querySelector('#harga').value = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(response['data']['HARGA']);

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
            url: "http://127.0.0.1:8000/api/barang/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("detailBarang"));
                    modalInfo.show();

                    var container = document.getElementById('detailBarang');
                    container.querySelector('#kode_barang').value = response['data']['KODE'];
                    container.querySelector('#nama_barang').value = response['data']['NAMA'];
                    container.querySelector('#kategori').value = response['data']['KATEGORI'];
                    container.querySelector('#harga').value = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(response['data']['HARGA']);

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
            url: "http://127.0.0.1:8000/api/barang/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("deleteBarang"));
                    modalInfo.show();

                    var container = document.getElementById('deleteBarang');
                    container.querySelector('#kode_barang').value = response['data']['KODE'];
                    container.querySelector('#nama_barang').value = response['data']['NAMA'];

                }
            },
            error: function () {
                alert('Terjadi Kesalahan');
            }
        });
    }

    function loadDataBarang() {
        $('#tableBarang').DataTable().destroy();
        $('#tableBarang').DataTable({
            "ajax" : "http://127.0.0.1:8000/api/barang",
            "columns" : [
                {data: "KODE"},
                {data: "NAMA"},
                {data: "KATEGORI"},
                {
                    data: "HARGA",
                    render : function(data,type,row){
                        var formatted = new Intl.NumberFormat('en-US', {
                            style: 'decimal',
                        }).format(data);

                        return formatted;
                    }
                },
                {
                    data: "KODE",
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
        loadDataBarang();
    });
</script>

<?= $this->endSection(); ?>