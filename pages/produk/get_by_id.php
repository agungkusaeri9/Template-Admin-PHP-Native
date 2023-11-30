<?php
session_start();
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
include '../../function/models/produk.php';
// is_login();


$id_produk = $_GET['id_produk'];
if ($id_produk) {
    $produk = getById($id_produk);

    $json =  json_encode($produk, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    echo $json;
} else {
    return json_encode([
        'status' => false,
        'data' => []
    ]);
}
