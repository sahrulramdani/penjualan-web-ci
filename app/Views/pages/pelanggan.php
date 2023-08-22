<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col d-inline-flex align-items-center justify-content-between mb-4">
        <h5 class="text-light">Halaman Data Pelanggan</h5>
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#tambahPelanggan">
        Tambah Data
        </button>
    </div>
    
    <div class="table-content overflow-y-auto">
        <table id="tablePelanggan" class="table table-dark" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA PELANGGAN</th>
                    <th>DOMISILI</th>
                    <th>JENIS KELAMIN</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?= $this->include('pages/pelanggan/modal_add_pelanggan') ?>
<?= $this->include('pages/pelanggan/modal_edit_pelanggan') ?>
<?= $this->include('pages/pelanggan/modal_detail_pelanggan') ?>
<?= $this->include('pages/pelanggan/modal_delete_pelanggan') ?>

<script>    
    function editData($id){
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/api/pelanggan/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("editPelanggan"));
                    modalInfo.show();

                    var container = document.getElementById('editPelanggan');
                    container.querySelector('#id_pelanggan').value = response['data']['ID_PELANGGAN'];
                    container.querySelector('#nama_pelanggan').value = response['data']['NAMA'];
                    container.querySelector('#domisili').value = response['data']['DOMISILI'];
                    container.querySelector('#jenis_kelamin').value = response['data']['JENIS_KELAMIN'];

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
            url: "http://127.0.0.1:8000/api/pelanggan/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("detailPelanggan"));
                    modalInfo.show();

                    var container = document.getElementById('detailPelanggan');
                    container.querySelector('#id_pelanggan').value = response['data']['ID_PELANGGAN'];
                    container.querySelector('#nama_pelanggan').value = response['data']['NAMA'];
                    container.querySelector('#domisili').value = response['data']['DOMISILI'];
                    container.querySelector('#jenis_kelamin').value = response['data']['JENIS_KELAMIN'];
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
            url: "http://127.0.0.1:8000/api/pelanggan/" + $id,
            success: function (response) {
                if(response){
                    const modalInfo = new bootstrap.Modal(document.getElementById("deletePelanggan"));
                    modalInfo.show();

                    var container = document.getElementById('deletePelanggan');
                    container.querySelector('#id_pelanggan').value = response['data']['ID_PELANGGAN'];
                    container.querySelector('#nama_pelanggan').value = response['data']['NAMA'];

                }
            },
            error: function () {
                alert('Terjadi Kesalahan');
            }
        });
    }

    function loadDataPelanggan() {
        $('#tablePelanggan').DataTable().destroy();
        $('#tablePelanggan').DataTable({
            "ajax" : "http://127.0.0.1:8000/api/pelanggan",
            "columns" : [
                {data: "ID_PELANGGAN"},
                {data: "NAMA"},
                {data: "DOMISILI"},
                {data: "JENIS_KELAMIN"},
                {
                    data: "ID_PELANGGAN",
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
        loadDataPelanggan();
    });
</script>

<?= $this->endSection(); ?>