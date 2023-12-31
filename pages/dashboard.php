<?php

require_once 'function/models/dashboard.php';
require_once 'function/helper.php';

$total_transaksi = transaksi()['total'];
$total_produk = produk()['total'];
$total_customer = customer()['total'];
$total_pendapatan_hari_ini = totalPendapatanHariIni()['total'];

?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pendapatan Hari Ini</h4>
                    </div>
                    <div class="card-body">
                        <?= format_rupiah($total_pendapatan_hari_ini) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_transaksi ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Produk</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_produk ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Customer</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_customer ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>