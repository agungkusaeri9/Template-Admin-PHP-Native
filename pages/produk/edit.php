<?php

require_once 'function/models/produk.php';

$id_produk = $_GET['id_produk'];
$data_satuan = getSatuan();
$item = getById($id_produk);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=produk');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=produk&status=success&message=produk berhasil diupdate.');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=produk&status=error&message=produk gagal diupdate.');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=produk' ?>">Data Produk</a></div>
            <div class="breadcrumb-item">Edit Produk</div>
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

                        <form action="" method="post" id="form" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $item['id_produk'] ?>" name="id_produk">
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar" value="" id="gambar">
                            </div>
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" value="<?= $item['nama_produk'] ?>" id="nama_produk" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" name="harga" value="<?= $item['harga'] ?>" id="harga" required>
                            </div>
                            <div class="form-group">
                                <label for="id_satuan">Satuan</label>
                                <select name="id_satuan" id="id_satuan" class="form-control" required>
                                    <option value="">Pilih Satuan</option>
                                    <?php foreach ($data_satuan as $satuan) : ?>
                                        <option <?php if ($satuan['id_satuan'] == $item['id_satuan']) : ?> selected <?php endif; ?> value="<?= $satuan['id_satuan'] ?>"><?= $satuan['nama_satuan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"><?= $item['deskripsi'] ?></textarea>
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