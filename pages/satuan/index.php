<?php

require_once 'function/models/satuan.php';

$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_satuan']);
    redirectUrl(BASE_URL . '/main.php?page=satuan&status=success&message=satuan berhasil dihapus.');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data satuan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data satuan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=satuan-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['nama_satuan'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=satuan-edit&id_satuan=' . $item['id_satuan'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_satuan" value="<?= $item['id_satuan'] ?>" hidden>
                                                    <button name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>