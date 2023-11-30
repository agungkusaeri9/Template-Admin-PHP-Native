<?php

require_once 'function/models/transaksi.php';

$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_transaksi']);
    redirectUrl(BASE_URL . '/main.php?page=transaksi&status=success&message=transaksi berhasil dihapus.');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data Transaksi</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=transaksi-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Customer</th>
                                        <th>Kode</th>
                                        <th>Sub Total</th>
                                        <th>Diskon</th>
                                        <th>Tunai</th>
                                        <th>Kembalian</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= format_tanggal($item['tanggal_dibuat'], 'd-m-Y H:i:s') ?></td>
                                            <td><?= $item['nama'] ?></td>
                                            <td><?= $item['kode_transaksi'] ?></td>
                                            <td><?= format_rupiah($item['sub_total']) ?></td>
                                            <td><?= format_rupiah($item['diskon']) ?></td>
                                            <td><?= format_rupiah($item['tunai']) ?></td>
                                            <td><?= format_rupiah($item['kembalian']) ?></td>
                                            <td><?= format_rupiah($item['total_harga']) ?></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/pages/transaksi/cetak.php?id_transaksi=<?= $item['id_transaksi'] ?>" class="btn btn-secondary" target="_blank">Cetak PDF</a>
                                                <a href="<?= BASE_URL ?>/main.php?page=transaksi-detail&&id_transaksi=<?= $item['id_transaksi'] ?>" class="btn btn-info">Detail</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_transaksi" value="<?= $item['id_transaksi'] ?>" hidden>
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