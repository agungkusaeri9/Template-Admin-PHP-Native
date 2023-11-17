<?php

require_once 'function/models/satuan.php';

$id_satuan = $_GET['id_satuan'];

$item = getById($id_satuan);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=satuan');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=satuan&status=success&message=satuan berhasil diupdate.');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=satuan&status=errpr&message=satuan gagal diupdate.');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Satuan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=satuan' ?>">Data satuan</a></div>
            <div class="breadcrumb-item">Edit Satuan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <?= $error ?>
                        <?php endif; ?>

                        <form action="" method="post" id="form">
                            <input type="text" name="id_satuan" value="<?= $item['id_satuan'] ?>" hidden>
                            <div class="form-group">
                                <label for="nama_satuan">Nama Satuan</label>
                                <input type="text" class="form-control" name="nama_satuan" value="<?= $item['nama_satuan'] ?>" id="nama_satuan" required>
                            </div>
                            <div class="form-group">
                                <button name="update" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>