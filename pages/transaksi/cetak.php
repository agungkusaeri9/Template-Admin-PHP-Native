<?php

include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
require_once '../../function/models/transaksi.php';
require '../../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$id_transaksi = $_GET['id_transaksi'];
$item = getById($id_transaksi);
$details = getDetailTransaksi($id_transaksi);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja <?= $item['kode_transaksi'] ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-size: 12px;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            border: 2px solid #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #4285f4;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 1.8em;
        }

        .receipt {
            padding: 20px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .item span {
            flex: 1;
        }

        .total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }

        .total2 {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            border-top: 2px solid #333;
            padding-top: 10px;
        }

        .total2 span {
            font-weight: bold;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">
        <div class="header">
            <h2>Toko ABC</h2>
            <p>Struk Belanjaan</p>
        </div>

        <div class="receipt">
            <?php foreach ($details as $detail) : ?>
                <div class="item">
                    <span><?= $detail['nama_produk'] ?></span>
                    <span><?= format_rupiah($detail['harga']) ?></span>
                    <span><?= $detail['jumlah'] ?></span>
                    <span><?= format_rupiah($detail['total_harga']) ?></span>
                </div>
            <?php endforeach; ?>

            <div class="total">
                <span>Sub Total</span>
                <span><?= format_rupiah($item['sub_total']) ?></span>
            </div>
            <div class="total">
                <span>Diskon</span>
                <span><?= format_rupiah($item['diskon']) ?></span>
            </div>
            <div class="total">
                <span>Tunai</span>
                <span><?= format_rupiah($item['tunai']) ?></span>
            </div>
            <div class="total">
                <span>Kembalian</span>
                <span><?= format_rupiah($item['kembalian']) ?></span>
            </div>
            <div class="total2">
                <span>Total Bayar</span>
                <span><?= format_rupiah($item['total_harga']) ?></span>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>

</body>

</html>