<?php

require_once 'function/models/transaksi.php';

$id_transaksi = $_GET['id_transaksi'];
$item = getById($id_transaksi);
$details = getDetailTransaksi($id_transaksi);
?>
<section class="section">
    <div class="section-header">
        <h1>Detail Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Transaksi</div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Transaksi</h6>
                        <table class="table">
                            <tr>
                                <th class="pl-0">Kode Transaksi</th>
                                <td style="width:10px"> : </td>
                                <td><?= $item['kode_transaksi'] ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Sub Total</th>
                                <td style="width:10px"> : </td>
                                <td><?= format_rupiah($item['sub_total']) ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Diskon</th>
                                <td style="width:10px"> : </td>
                                <td><?= format_rupiah($item['diskon']) ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Total Harga</th>
                                <td style="width:10px"> : </td>
                                <td><?= format_rupiah($item['total_harga']) ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Tunai</th>
                                <td style="width:10px"> : </td>
                                <td><?= format_rupiah($item['tunai']) ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Kembalian</th>
                                <td style="width:10px"> : </td>
                                <td><?= format_rupiah($item['kembalian']) ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Customer</th>
                                <td style="width:10px"> : </td>
                                <td><?= $item['nama'] ?></td>
                            </tr>
                            <tr>
                                <th class="pl-0">Tanggal Dibuat</th>
                                <td style="width:10px"> : </td>
                                <td><?= format_tanggal($item['tanggal_dibuat'], 'd-m-Y H:i:s') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h6>Produk</h6>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($details as $detail) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $detail['nama_produk'] ?></td>
                                            <td><?= $detail['harga'] ?></td>
                                            <td><?= $detail['jumlah'] ?></td>
                                            <td><?= format_rupiah($detail['total_harga']) ?></td>
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