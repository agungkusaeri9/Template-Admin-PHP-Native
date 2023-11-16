<?php

require_once 'function/models/user.php';
$data_komplek = getKomplek();

if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=user&status=success&message=User berhasil ditambahkan!');
    } else {
        $error = '
        <div class="alert alert-danger">
         User gagal ditambahkan.
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=user' ?>">Data User</a></div>
            <div class="breadcrumb-item">Tambah User</div>
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
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">Pilih Level</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="" id="password" required>
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
