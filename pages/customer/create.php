<?php

require_once 'function/models/customer.php';
if (isset($_POST['tambah'])) {
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=customer&status=success&message=customer berhasil ditambahkan!');
    } else {
        $error = '
        <div class="alert alert-danger">
         customer gagal ditambahkan.
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Customer</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=customer' ?>">Data customer</a></div>
            <div class="breadcrumb-item">Tambah Customer</div>
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
                                <label for="nama">Nama Customer</label>
                                <input type="text" class="form-control" name="nama" value="" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input type="text" class="form-control" name="nomor_hp" value="" id="nomor_hp">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
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