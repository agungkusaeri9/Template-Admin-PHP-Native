<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM user");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);
    $level = htmlspecialchars($post['level']);
    $password = password_hash($post['password'], PASSWORD_BCRYPT);
    $insertId = $koneksi->query("INSERT INTO `user` (`id_user`, `nama`, `email`,`level`, `password`) VALUES (NULL, '$nama','$email','$level','$password')");

    return $insertId;
}

function getById($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM user WHERE id_user=$id_user")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;

    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);
    $level = htmlspecialchars($post['level']);

    // update user
    if ($post['password']) {
        $pw_hash = password_hash($post['password'], PASSWORD_BCRYPT);
        $passwordUpdate = ",`password` = " . "'" . $pw_hash . "'";
    } else {
        $passwordUpdate = NULL;
    }
    $koneksi->query("UPDATE `user` SET `nama` = '$nama', `email` = '$email' $passwordUpdate,`level` = '$level' WHERE `user`.`id_user` = $post[id_user]");
    return true;
}

function deleteData($id_user)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM user WHERE id_user=$id_user");
}

function updateProfile($post)
{
    global $koneksi;

    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);

    // update user
    if ($post['password']) {

        $pw_hash = password_hash($post['password'], PASSWORD_BCRYPT);
        $passwordUpdate = ",`password` = " . "'" . $pw_hash . "'";
    } else {
        $passwordUpdate = NULL;
    }
    $user = $koneksi->query("UPDATE `user` SET `nama` = '$nama', `email` = '$email' $passwordUpdate WHERE `user`.`id_user` = $_SESSION[id_user]");

    if ($user) {
        // hapus session
        unset($_SESSION['nama']);
        unset($_SESSION['email']);

        // buat session baru
        $_SESSION['nama'] = $nama;
        $_SESSION['email'] = $email;

        return true;
    } else {
        return false;
    }
}


function validasiTambah($post)
{
    global $koneksi;
    // cek apakah ada email di database
    $cekUser = $koneksi->query("SELECT * FROM user WHERE email = '$post[email]'")->fetch_assoc();

    if ($cekUser) {
        redirectUrl(BASE_URL . '/main.php?page=user-create&status=error&message=User dengan email tersebut sudah terdaftar.');
        exit;
    } else {
        if (!$post['nama'] || !$post['email'] || !$post['level'] || !$post['password']) {

            redirectUrl(BASE_URL . '/main.php?page=user-create&status=error&message=Nama, Email, Level dan Password tidak boleh kosong.');
            exit;
        }
    }
}


function validasiEdit($post)
{
    global $koneksi;
    // cek apakah ada email di database
    $cekUser = $koneksi->query("SELECT * FROM user WHERE email = '$post[email]' AND id_user!=$post[id_user]")->fetch_assoc();

    if ($cekUser) {
        redirectUrl(BASE_URL . '/main.php?page=user-edit&id_user=' . $post['id_user'] . '&status=error&message=User dengan email tersebut sudah terdaftar.');
        exit;
    } else {
        if (!$post['nama'] || !$post['email'] || !$post['level']) {

            redirectUrl(BASE_URL . '/main.php?page=user-edit&id_user=' . $post['id_user'] . '&status=error&message=Nama, Email, Level dan Password tidak boleh kosong.');
            exit;
        }
    }
}
