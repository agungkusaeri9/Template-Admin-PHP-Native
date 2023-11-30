<?php



?>
<section class="section">
    <div class="section-header">
        <h1>Lpoaran Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Lpoaran Transaksi</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= BASE_URL ?>/pages/laporan/transaksi-print.php" method="post" target="_blank">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="">Dari</label>
                                        </div>
                                        <div class="col-md">
                                            <input type="date" name="dari" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="">Sampai</label>
                                        </div>
                                        <div class="col-md">
                                            <input type="date" name="sampai" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" name="cetak">Cetak Laporan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>