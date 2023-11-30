<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM transaksi INNER JOIN customer ON transaksi.id_customer = customer.id_customer ORDER BY id_transaksi DESC");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getTransaksiFilter($dari = NULL, $sampai = NULL)
{
    global $koneksi;
    if ($dari && $sampai) {
        $items = $koneksi->query("SELECT * FROM transaksi 
    INNER JOIN customer ON transaksi.id_customer = customer.id_customer 
    WHERE tanggal_dibuat BETWEEN '$dari' AND '$sampai'
    ORDER BY id_transaksi DESC");
    } elseif ($dari && !$sampai) {
        $items = $koneksi->query("SELECT * FROM transaksi 
        INNER JOIN customer ON transaksi.id_customer = customer.id_customer 
        WHERE tanggal_dibuat =  '$dari'
        ORDER BY id_transaksi DESC");
    } else {
        $items = $koneksi->query("SELECT * FROM transaksi 
        INNER JOIN customer ON transaksi.id_customer = customer.id_customer 
        ORDER BY id_transaksi DESC");
    }
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getById($id_transaksi)
{
    global $koneksi;
    $data = $koneksi->query("SELECT * FROM transaksi INNER JOIN customer ON transaksi.id_customer=customer.id_customer WHERE id_transaksi=$id_transaksi")->fetch_assoc();
    return $data;
}

function getDetailTransaksi($id_transaksi)
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk WHERE id_transaksi=$id_transaksi");
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



function deleteData($id_transaksi)
{
    global $koneksi;
    $koneksi->query("DELETE FROM transaksi WHERE id_transaksi=$id_transaksi");
}


function getProduk()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM produk INNER JOIN satuan ON produk.id_satuan = satuan.id_satuan");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}


function getCustomer()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM customer");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function generateNewTransactionCode()
{
    global $koneksi;
    // Query untuk mendapatkan kode transaksi terakhir
    $query = "SELECT kode_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        // Kode transaksi terakhir ditemukan
        $row = $result->fetch_assoc();
        $lastCode = $row['kode_transaksi'];

        // Membuat kode transaksi baru
        $newCode = incrementTransactionCode($lastCode);

        return $newCode;
    } else {
        // Tidak ada kode transaksi sebelumnya, mengembalikan kode default
        return 'TRX00001';
    }
}

function incrementTransactionCode($code)
{
    // Mengambil angka dari belakang kode transaksi
    $lastNumber = (int)substr($code, 5);

    // Menambahkan 1 ke angka terakhir
    $newNumber = $lastNumber + 1;

    // Format ulang angka dengan menambahkan 0 di depan jika kurang dari 4 digit
    $newCode = 'TRX' . sprintf('%04d', $newNumber);

    return $newCode;
}
