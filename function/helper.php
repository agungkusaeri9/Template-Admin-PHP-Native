<?php


function is_admin()
{
    // cek admin atau tidak
    if ($_SESSION['level'] !== 'admin') {
      redirectUrl(BASE_URL . '/warga.php?page=dashboard');
    }
}

function is_warga()
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

function getMonthName($monthNumber)
{
    switch ($monthNumber) {
        case 1:
            return 'Januari';
        case 2:
            return 'Februari';
        case 3:
            return 'Maret';
        case 4:
            return 'April';
        case 5:
            return 'Mei';
        case 6:
            return 'Juni';
        case 7:
            return 'Juli';
        case 8:
            return 'Augustus';
        case 9:
            return 'September';
        case 10:
            return 'Oktober';
        case 11:
            return 'November';
        case 12:
            return 'Desember';
        default:
            return 'Invalid month number';
    }
}

function getMonth()
{
    $bulan = array(
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    );

    return $bulan;
}

function redirectUrl($url)
{
    echo '<script>window.location.href = "'.$url.'";</script>';
}