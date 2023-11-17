<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM satuan");
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
    $nama_satuan = htmlspecialchars($post['nama_satuan']);
    $insertId = $koneksi->query("INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES (NULL, '$nama_satuan')");
    return $insertId;
}

function getById($id_satuan)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM satuan WHERE id_satuan=$id_satuan")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;

    // cek apakah admin atau warga
    $nama_satuan = htmlspecialchars($post['nama_satuan']);
    $id_satuan = htmlspecialchars($post['id_satuan']);

    $koneksi->query("UPDATE `satuan` SET `nama_satuan` = '$nama_satuan' WHERE `satuan`.`id_satuan` = $id_satuan");
    return true;
}

function deleteData($id_satuan)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM satuan WHERE id_satuan=$id_satuan");
}


function validasiTambah($post)
{
    global $koneksi;
    // cek apakah ada email di database
    $ceksatuan = $koneksi->query("SELECT * FROM satuan WHERE nama_satuan = '$post[nama_satuan]'")->fetch_assoc();

    if ($ceksatuan) {
        redirectUrl(BASE_URL . '/main.php?page=satuan-create&status=error&message=satuan sudah ada di database.');
        exit;
    } else {
        if (!$post['nama_satuan']) {

            redirectUrl(BASE_URL . '/main.php?page=satuan-create&status=error&message=Nama Satuan tidak boleh kosong.');
            exit;
        }
    }
}


function validasiEdit($post)
{
    global $koneksi;
    // cek apakah ada nama_satuan di database
    $ceksatuan = $koneksi->query("SELECT * FROM satuan WHERE nama_satuan = '$post[nama_satuan]' AND id_satuan!=$post[id_satuan]")->fetch_assoc();

    if ($ceksatuan) {
        redirectUrl(BASE_URL . '/main.php?page=satuan-edit&id_satuan=' . $post['id_satuan'] . '&status=error&message=satuan tersebut sudah ada di database.');
        exit;
    } else {
        if (!$post['nama_satuan']) {

            redirectUrl(BASE_URL . '/main.php?page=satuan-edit&id_satuan=' . $post['id_satuan'] . '&status=error&message=Nama Satuan tidak boleh kosong.');
            exit;
        }
    }
}
