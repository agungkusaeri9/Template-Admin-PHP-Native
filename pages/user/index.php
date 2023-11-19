<?php

require_once 'function/models/user.php';
is_admin();
$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_user']);
    redirectUrl(BASE_URL . '/main.php?page=user&status=success&message=User berhasil dihapus.');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data User</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=user-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['nama'] ?></td>
                                            <td><?= $item['email'] ?></td>
                                            <td><?= $item['level'] ?? '-' ?></td>
                                            <td>
                                                <?php if ($item['id_user'] != $_SESSION['id_user']) : ?>
                                                    <a href="<?= BASE_URL . '/main.php?page=user-edit&id_user=' . $item['id_user'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                    <form action="" method="post" class="d-inline">
                                                        <input type="text" name="id_user" value="<?= $item['id_user'] ?>" hidden>
                                                        <button name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>

                                                <?php else : ?>
                                                    <i>Tidak Ada Akses!</i>
                                                <?php endif; ?>

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