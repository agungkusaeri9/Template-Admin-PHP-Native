<?php

function user()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM user")->fetch_assoc();
    return $item;
}
