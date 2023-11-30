<?php

function transaksi()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM transaksi")->fetch_assoc();
    return $item;
}

function customer()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM customer")->fetch_assoc();
    return $item;
}

function produk()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM produk")->fetch_assoc();
    return $item;
}

function totalPendapatanHariIni()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT SUM(total_harga) as total FROM transaksi")->fetch_assoc();
    return $item;
}
