<?php


function is_admin()
{
    // cek admin atau tidak
    if ($_SESSION['level'] !== 'admin') {
        redirectUrl(BASE_URL . '/warga.php?page=dashboard');
    }
}

function is_kasir()
{
    // cek warga atau tidak
    if ($_SESSION['level'] !== 'warga') {
        redirectUrl(BASE_URL . '/main.php?page=dashboard');
    }
}

function is_login()
{
    if (isset($_SESSION['nama']) == NULL) {
        redirectUrl(BASE_URL . '/logout.php?status=error&message=Silahkan Login terlebih dahulu');
    }
}

function format_rupiah($angka)
{
    $rupiah = $angka ? "Rp " . number_format($angka, 0, ',', '.') : $angka = 0;
    return $rupiah;
}

function redirectUrl($url)
{
    echo '<script>window.location.href = "' . $url . '";</script>';
}
