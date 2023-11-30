<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM customer");
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
    $jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
    $nomor_hp = htmlspecialchars($post['nomor_hp']);
    $alamat = htmlspecialchars($post['alamat']);

    $insertId = $koneksi->query("INSERT INTO `customer` (`id_customer`, `nama`, `nomor_hp`, `jenis_kelamin`, `alamat`) VALUES (NULL, '$nama', '$nomor_hp', '$jenis_kelamin', '$alamat')");
    return $insertId;
}

function getById($id_customer)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM customer WHERE id_customer=$id_customer")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;

    // cek apakah admin atau warga
    $id_customer = htmlspecialchars($post['id_customer']);
    $nama = htmlspecialchars($post['nama']);
    $jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
    $nomor_hp = htmlspecialchars($post['nomor_hp']);
    $alamat = htmlspecialchars($post['alamat']);

    $koneksi->query("UPDATE `customer` SET `nama` = '$nama', `nomor_hp` = '$nomor_hp', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat' WHERE `customer`.`id_customer` = $id_customer");
    return true;
}

function deleteData($id_customer)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM customer WHERE id_customer=$id_customer");
}


function validasiTambah($post)
{
    global $koneksi;
    // cek apakah ada email di database
    $cekcustomer = $koneksi->query("SELECT * FROM customer WHERE nomor_hp = '$post[nomor_hp]'")->fetch_assoc();

    if ($cekcustomer) {
        redirectUrl(BASE_URL . '/main.php?page=customer-create&status=error&message=customer sudah ada di database.');
        exit;
    } else {
        if (!$post['nama']) {

            redirectUrl(BASE_URL . '/main.php?page=customer-create&status=error&message=Nama Customer tidak boleh kosong.');
            exit;
        }
    }
}


function validasiEdit($post)
{
    global $koneksi;
    // cek apakah ada nomor_hp di database
    $cekcustomer = $koneksi->query("SELECT * FROM customer WHERE nomor_hp = '$post[nomor_hp]' AND id_customer!=$post[id_customer]")->fetch_assoc();

    if ($cekcustomer) {
        redirectUrl(BASE_URL . '/main.php?page=customer-create&status=error&message=Nomor HP sudah ada di database.');
        exit;
    } else {
        if (!$post['nama']) {

            redirectUrl(BASE_URL . '/main.php?page=customer-create&status=error&message=Nama Customer tidak boleh kosong.');
            exit;
        }
    }
}
