<?php

require_once 'function/models/produk.php';

$data_satuan = getSatuan();

if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=produk&status=success&message=produk berhasil ditambahkan!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=produk&status=error&message=Produk gagal ditambahkan!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=produk' ?>">Data Produk</a></div>
            <div class="breadcrumb-item">Tambah Produk</div>
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
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar" value="" id="gambar" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" value="" id="nama_produk" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" name="harga" value="" id="harga" required>
                            </div>
                            <div class="form-group">
                                <label for="id_satuan">Satuan</label>
                                <select name="id_satuan" id="id_satuan" class="form-control" required>
                                    <option value="">Pilih Satuan</option>
                                    <?php foreach ($data_satuan as $satuan) : ?>
                                        <option value="<?= $satuan['id_satuan'] ?>"><?= $satuan['nama_satuan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
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