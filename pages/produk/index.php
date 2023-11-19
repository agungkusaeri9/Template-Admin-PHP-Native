<?php

require_once 'function/models/produk.php';

$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_produk']);
    redirectUrl(BASE_URL . '/main.php?page=produk&status=success&message=produk berhasil dihapus.');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data Produk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=produk-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Nama produk</th>
                                        <th>Kode</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <img src="<?= BASE_URL . '/uploads/produk/' . $item['gambar'] ?>" alt="" class="img-fluid" style="max-height:60px">
                                            </td>
                                            <td><?= $item['nama_produk'] ?></td>
                                            <td><?= $item['kode'] ?></td>
                                            <td><?= $item['nama_satuan'] ?></td>
                                            <td><?= format_rupiah($item['harga']) ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=produk-edit&id_produk=' . $item['id_produk'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_produk" value="<?= $item['id_produk'] ?>" hidden>
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