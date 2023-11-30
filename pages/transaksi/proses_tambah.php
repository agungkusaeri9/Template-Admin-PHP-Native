<?php
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
include '../../function/models/transaksi.php';



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    global $koneksi;

    $data_produk = $_POST['data'];
    $sub_total = $_POST['sub_total'];
    $total = $_POST['total'];
    $tunai = $_POST['tunai'];
    $kembalian = $_POST['kembalian'];
    $id_customer = $_POST['id_customer'];
    $diskon = $_POST['diskon'];
    $kode_baru = generateNewTransactionCode();
    try {
        // Mulai transaksi
        $koneksi->begin_transaction();

        // create transaksi
        $sql_transaksi = "INSERT INTO `transaksi` (`kode_transaksi`, `sub_total`, `diskon`, `total_harga`, `tunai`, `kembalian`, `id_customer`, `tanggal_dibuat`) VALUES ('$kode_baru', $sub_total, $diskon, $total, $tunai, $kembalian, $id_customer, CURRENT_TIMESTAMP)";
        $result_transaksi = $koneksi->query($sql_transaksi);

        if ($result_transaksi) {
            $id_transaksi = $koneksi->insert_id; // Mendapatkan ID transaksi yang baru saja dibuat

            // create detail transaksi  
            foreach ($data_produk as $produk) {
                $id_produk = $produk[0]['id_produk'];
                $harga = $produk[0]['harga'];
                $jumlah = $produk[0]['jumlah'];
                $total_harga = $produk[0]['total_harga'];
                $sql_detail_transaksi = "INSERT INTO `detail_transaksi` (`id_transaksi`, `id_produk`, `harga`, `jumlah`, `total_harga`) VALUES ($id_transaksi, $id_produk, $harga, $jumlah, $total_harga)";
                $koneksi->query($sql_detail_transaksi);
            }

            // Commit transaksi
            $koneksi->commit();

            echo json_encode([
                'status' => true,
                'message' => 'Transaksi Berhasil disimpan'
            ]);
        } else {
            // Rollback transaksi jika ada kesalahan
            $koneksi->rollback();

            echo json_encode([
                'status' => false,
                'message' => 'Transaksi Gagal disimpan'
            ]);
        }
    } catch (Exception $e) {
        // Tangkap kesalahan jika terjadi dan rollback transaksi
        $koneksi->rollback();

        echo json_encode([
            'status' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
} else {
    // Request bukan dari AJAX
    echo 'Ini bukan request AJAX!';
    exit;
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
