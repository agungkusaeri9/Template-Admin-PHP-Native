<?php

require_once 'function/models/user.php';
is_admin();
$id_user = $_GET['id_user'];

$item = getById($id_user);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=user');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=user&status=success&message=User berhasil diupdate.');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=user&status=errpr&message=User gagal diupdate.');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=user' ?>">Data User</a></div>
            <div class="breadcrumb-item">Edit User</div>
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

                        <form action="" method="post" id="form">
                            <input type="text" name="id_user" value="<?= $item['id_user'] ?>" hidden>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $item['nama'] ?>" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $item['email'] ?>" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="" id="password">
                            </div>
                            <div class="form-group">
                                <button name="update" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {

        let getBlokByKomplek = function(id_komplek) {
            let data;
            $.ajax({
                url: '<?= BASE_URL . '/pages/blok/get-by-komplek.php' ?>',
                async: false,
                type: 'GET',
                data: {
                    id_komplek
                },
                dataType: 'JSON',
                success: function(response) {
                    data = response;
                },
                error: function(err) {
                    console.log(err);
                }
            })

            return data;
        }

        $('#form #level').on('change', function() {
            let level = $(this).val();
            if (level === 'admin') {
                $('.d-warga').addClass('d-none');
            } else {
                $('.d-warga').removeClass('d-none');
            }
        })


        // get blok by komplek
        $('#form #id_komplek').on('change', function() {
            let id_komplek = $(this).val();

            let data_blok = getBlokByKomplek(id_komplek);
            $('#form #id_blok').empty();
            $('#form #id_blok').append(`<option value="">Pilih Blok</option>`)
            data_blok.forEach(blok => {
                $('#form #id_blok').append(`
                    <option value="${blok.id_blok}">${blok.nama_blok}</option>
                `)
            })
        })

        let id_komplek = <?= $komplek2['id_komplek'] ?>;
        let id_blok = <?= $item['id_blok'] ?>;
        let data_blok2 = getBlokByKomplek(id_komplek);
        $('#form #id_blok').empty();
        $('#form #id_blok').append(`<option value="">Pilih Blok</option>`)
        data_blok2.forEach(blok => {
            let selected = blok.id_blok == id_blok ? 'selected' : '';

            $('#form #id_blok').append(`
                    <option ${selected} value="${blok.id_blok}">${blok.nama_blok}</option>
                `)
        })
    })
</script>