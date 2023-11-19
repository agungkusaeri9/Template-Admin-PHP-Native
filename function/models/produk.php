<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM produk INNER JOIN satuan ON produk.id_satuan = satuan.id_satuan");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getSatuan()
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
    $nama_produk = htmlspecialchars($post['nama_produk']);
    $kode = getKodeBaru();
    $harga = htmlspecialchars($post['harga']);
    $id_satuan = htmlspecialchars($post['id_satuan']);
    $deskripsi = htmlspecialchars($post['deskripsi']);

    // Proses unggah gambar
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika unggah gambar berhasil
    if ($error === 0) {
        // Contoh ekstensi file yang diizinkan (ganti sesuai kebutuhan)
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        // Cek ekstensi file
        if (in_array($ekstensiGambar, $ekstensiGambarValid)) {
            // Cek ukuran file (contoh, maksimal 5MB)
            if ($ukuranFile <= 5000000) {
                $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
                move_uploaded_file($tmpName, 'uploads/produk/' . $namaFileBaru);
                // Query untuk menambahkan data ke database
                $insertId = $koneksi->query("INSERT INTO `produk` (`id_produk`, `nama_produk`, `kode`, `harga`, `id_satuan`, `deskripsi`, `gambar`) VALUES (NULL, '$nama_produk', '$kode', '$harga', '$id_satuan', '$deskripsi', '$namaFileBaru')");

                return $insertId;
            } else {
                // Ukuran file terlalu besar
                return false;
                exit;
            }
        } else {
            // Ekstensi file tidak diizinkan
            return false;
            exit;
        }
    } else {
        // Jika unggah gambar gagal
        return false;
        exit;
    }
}

function getKodeTerakhir()
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 1")->fetch_assoc();
    return $item['kode'];
}

function getKodeBaru()
{
    $kodeTerakhir = getKodeTerakhir();

    if ($kodeTerakhir) {
        $angkaKodeTerakhir = intval(substr($kodeTerakhir, 3));
        $angkaBaru = $angkaKodeTerakhir + 1;
        $angkaFormatBaru = sprintf('%03d', $angkaBaru);
        $kodeBaru = 'BRG' . $angkaFormatBaru;
    } else {
        $kodeBaru = 'BRG001';
    }

    return $kodeBaru;
}

function getById($id_produk)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id_produk")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_produk = htmlspecialchars($post['id_produk']);
    $nama_produk = htmlspecialchars($post['nama_produk']);
    $harga = htmlspecialchars($post['harga']);
    $id_satuan = htmlspecialchars($post['id_satuan']);
    $deskripsi = htmlspecialchars($post['deskripsi']);

    // Proses unggah gambar
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika unggah gambar berhasil
    if ($namaFile && $error === 0) {
        // Contoh ekstensi file yang diizinkan (ganti sesuai kebutuhan)
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        // Cek ekstensi file
        if (in_array($ekstensiGambar, $ekstensiGambarValid)) {
            // Cek ukuran file (contoh, maksimal 5MB)
            if ($ukuranFile <= 5000000) {
                $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
                move_uploaded_file($tmpName, 'uploads/produk/' . $namaFileBaru);
                // Query untuk menambahkan data ke database
                $koneksi->query("UPDATE `produk` SET `nama_produk` = '$nama_produk', `harga` = '$harga', `id_satuan` = '$id_satuan', `deskripsi` = '$deskripsi', `gambar` = '$namaFileBaru' WHERE `produk`.`id_produk` = $id_produk");

                return true;
            } else {
                // Ukuran file terlalu besar
                return true;
                exit;
            }
        } else {
            // Ekstensi file tidak diizinkan
            return true;
            exit;
        }
    } else {
        $koneksi->query("UPDATE `produk` SET `nama_produk` = '$nama_produk', `harga` = '$harga', `id_satuan` = '$id_satuan', `deskripsi` = '$deskripsi' WHERE `produk`.`id_produk` = $id_produk");
        return true;
    }
}

function deleteData($id_produk)
{
    global $koneksi;
    $koneksi->query("DELETE FROM produk WHERE id_produk=$id_produk");
}


function validasiTambah($post)
{

    if (!$post['nama_produk'] || !$post['harga'] || !$post['id_satuan'] || !$post['deskripsi']) {

        redirectUrl(BASE_URL . '/main.php?page=produk-create&status=error&message=Inputan tidak boleh kosong.');
        exit;
    }
}


function validasiEdit($post)
{
    if (!$post['nama_produk'] || !$post['harga'] || !$post['id_satuan'] || !$post['deskripsi']) {

        redirectUrl(BASE_URL . '/main.php?page=produk-create&status=error&message=Inputan tidak boleh kosong.');
        exit;
    }
}
