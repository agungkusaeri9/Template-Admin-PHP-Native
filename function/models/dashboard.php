<?php

function user()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM user")->fetch_assoc();
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
