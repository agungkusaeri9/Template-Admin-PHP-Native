<?php

require_once 'function/models/satuan.php';

if (isset($_POST['tambah'])) {
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=satuan&status=success&message=satuan berhasil ditambahkan!');
    } else {
        $error = '
        <div class="alert alert-danger">
         satuan gagal ditambahkan.
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Satuan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=satuan' ?>">Data satuan</a></div>
            <div class="breadcrumb-item">Tambah Satuan</div>
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
                            <div class="form-group">
                                <label for="nama_satuan">Nama Ssatuan</label>
                                <input type="text" class="form-control" name="nama_satuan" value="" id="nama_satuan" required>
                            </div>
                            <div class="form-group">
                                <button name="tambah" class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                                    Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>