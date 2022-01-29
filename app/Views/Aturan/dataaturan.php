<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Aturan Cabang</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formaturan') ?>" class="btn btn-primary" data-toggle="modal"
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
                    <th>Bunga</th>
                    <th>Denda</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($aturan as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['bunga']; ?></td>
                        <td><?= $row['denda']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <!-- <a class="dropdown-item" href="/aturan/edit/">Edit</a> -->
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal"
                                        id="btn-edit-aturan" data-id-peraturan="<?= $row['id_peraturan']; ?>"
                                        data-bunga="<?= $row['bunga']; ?>" data-denda="<?= $row['denda']; ?>">Edit</a>
                                    <a class="dropdown-item Pdelete-btn"
                                        data-id-peraturan="<?= $row['id_peraturan']; ?>" href="">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Aturan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/aturan/save" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Bunga</label>
                            <input type="text" name="bunga" class="form-control" id="inputtext4"
                                placeholder="Masukkan Persen Bunga tanpa tanda %">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Denda</label>
                            <input type="text" name="denda" class="form-control" id="inputtext4"
                                placeholder="Masukkan Persen denda tanpa tanda %">
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Aturan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formAturan" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Bunga</label>
                            <input type="text" name="bunga" class="form-control" id="bunga"
                                placeholder="Masukkan Persen Bunga tanpa tanda %">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Denda</label>
                            <input type="text" name="denda" class="form-control" id="denda"
                                placeholder="Masukkan Persen denda tanpa tanda %">
                        </div>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>