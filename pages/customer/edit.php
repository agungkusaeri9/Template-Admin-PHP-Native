<?php

require_once 'function/models/customer.php';

$id_customer = $_GET['id_customer'];

$item = getById($id_customer);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=customer');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=customer&status=success&message=customer berhasil diupdate.');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=customer&status=errpr&message=customer gagal diupdate.');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit customer</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=customer' ?>">Data customer</a></div>
            <div class="breadcrumb-item">Edit customer</div>
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
                            <input type="text" name="id_customer" value="<?= $item['id_customer'] ?>" hidden>
                            <div class="form-group">
                                <label for="nama">Nama Customer</label>
                                <input type="text" class="form-control" name="nama" value="<?= $item['nama'] ?>" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input type="text" class="form-control" name="nomor_hp" value="<?= $item['nomor_hp'] ?>" id="nomor_hp">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option <?php if ($item['jenis_kelamin'] === 'L') : ?> selected <?php endif; ?> value="L">Laki-laki</option>
                                    <option <?php if ($item['jenis_kelamin'] === 'P') : ?> selected <?php endif; ?> value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"><?= $item['alamat'] ?></textarea>
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