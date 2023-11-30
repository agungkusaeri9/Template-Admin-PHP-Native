<?php
session_start();
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
is_login();
require_once '../../function/models/transaksi.php';


if (isset($_POST['cetak'])) {
    $dari = $_POST['dari'];
    $sampai = $_POST['sampai'];

    $items = getTransaksiFilter($dari, $sampai);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table#dTable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #dTable th,
        #dTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #dTable th {
            background-color: #f2f2f2;
        }

        #dTable tr:hover {
            background-color: #f5f5f5;
        }

        @media print {
            body {
                font-size: 10pt;
            }

            #dTable table {
                font-size: 10pt;
            }

            #dTable th,
            #dTable td {
                padding: 6px;
            }
        }
    </style>
</head>

<body>
    <h4 style="text-align: center;">Laporan Transaksi</h4>
    <table style="margin-bottom: 20px;">
        <?php if ($dari) : ?>
            <tr>
                <th style="text-align: left;">Dari Tanggal</th>
                <td> : </td>
                <td><?= format_tanggal($dari, 'd-m-Y') ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($sampai) : ?>
            <tr>
                <th style="text-align: left;">Sampai Tanggal</th>
                <td> : </td>
                <td><?= format_tanggal($sampai, 'd-m-Y') ?></td>
            </tr>
        <?php endif; ?>
    </table>

    <table id="dTable">
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
            </tr>
        </thead>
        <tbody>
            <?php if (count($items) > 0) : ?>
                <?php $i = 1;
                $total = 0;
                foreach ($items as $item) : ?>
                    <?php $total += $item['total_harga'] ?>
                    <tr>
                        <td style="text-align: center;"><?= $i++ ?></td>
                        <td><?= format_tanggal($item['tanggal_dibuat'], 'd-m-Y H:i:s') ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['kode_transaksi'] ?></td>
                        <td><?= format_rupiah($item['sub_total']) ?></td>
                        <td><?= format_rupiah($item['diskon']) ?></td>
                        <td><?= format_rupiah($item['tunai']) ?></td>
                        <td><?= format_rupiah($item['kembalian']) ?></td>
                        <td><?= format_rupiah($item['total_harga']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td style="text-align: center;" colspan="9">Tidak Ada Data!</td>
                </tr>
            <?php endif; ?>
            <tr>
                <th colspan="8" style="text-align: center;">Total</th>
                <td><?= format_rupiah($total) ?></td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>