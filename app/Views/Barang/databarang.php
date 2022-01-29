<?php
$session = session();
?>

<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Barang</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formbarang') ?>" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModal">Tambah</a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('Pesan')) : ?>
        <script type="text/javascript">
        $(document).ready(function() {
            swal({
                title: "Berhasil !",
                text: "<?= session()->getFlashdata('Pesan'); ?>",
                timer: 1500,
                icon: "success"
            });
        });
        </script>
        <?php endif; ?>
        <table class="table table-striped table-md">
            <tbody>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($barang as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal"
                                        id="btn-edit" data-id-barang="<?= $row['id_barang']; ?>"
                                        data-nama-barang="<?= $row['nama_barang']; ?>">Edit</a>
                                    <a class="dropdown-item delete-btn" href="#"
                                        data-idbarang="<?= $row['id_barang']; ?>">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </div>
            </tbody>
        </table>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/barang/save" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputtext4">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="inputtext4"
                                placeholder="Masukkan Nama Barang">
                        </div>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="actionform" method="post">
                    <input type="text" name="id_barang" id="id-barang" class="form-control" id="inputtext4" value="">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputtext4">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama-barang" class="form-control" id="inputtext4"
                                placeholder="Masukkan Nama Barang" value="">
                        </div>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('idbarang');

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/barang/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    });

});
</script>

<?= $this->endSection(); ?>