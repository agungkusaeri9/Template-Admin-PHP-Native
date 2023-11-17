<?php

require_once 'function/models/customer.php';

$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_customer']);
    redirectUrl(BASE_URL . '/main.php?page=customer&status=success&message=customer berhasil dihapus.');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Customer</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data Customer</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=customer-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama customer</th>
                                        <th>Nomor Hp</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['nama'] ?></td>
                                            <td><?= $item['nomor_hp'] ?></td>
                                            <td><?= $item['jenis_kelamin'] ?></td>
                                            <td><?= $item['alamat'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=customer-edit&id_customer=' . $item['id_customer'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_customer" value="<?= $item['id_customer'] ?>" hidden>
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