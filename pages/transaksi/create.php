<?php

require_once 'function/models/transaksi.php';

$data_produk = getProduk();
$data_customer = getCustomer();
$kode_baru = generateNewTransactionCode();

if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=transaksi&status=success&message=transaksi berhasil ditambahkan!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=transaksi&status=error&message=transaksi gagal ditambahkan!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Buat Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=transaksi' ?>">Data transaksi</a></div>
            <div class="breadcrumb-item">Buat Transaksi</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-4 col-form-label font-weight-bold">Tanggal</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="tanggal" placeholder="col-form-label" value="<?= format_tanggal(date('d-m-Y H:i:s')) ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kasir" class="col-sm-4 col-form-label font-weight-bold">Kasir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kasir" placeholder="col-form-label" value="<?= $_SESSION['nama'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_customer" class="col-sm-4 col-form-label font-weight-bold">Customer</label>
                                <div class="col-sm">
                                    <select name="id_customer" id="id_customer" class="select2 form-control">
                                        <?php foreach ($data_customer as $customer) : ?>
                                            <option <?php if ($customer['nama'] === 'umum' || $customer['nama'] === 'Umum') : ?> selected <?php endif; ?> value="<?= $customer['id_customer'] ?>"><?= $customer['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row">
                                <label for="id_produk" class="col-sm-3 col-form-label font-weight-bold">Produk</label>
                                <div class="col-sm-9">
                                    <select name="id_produk" id="id_produk" class="select2 form-control">
                                        <option value="" selected>Pilih</option>
                                        <?php foreach ($data_produk as $produk) : ?>
                                            <option value="<?= $produk['id_produk'] ?>"><?= $produk['kode'] . ' - ' . $produk['nama_produk'] . ' - ' . format_rupiah($produk['harga']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlah" placeholder="Jumlah" value="1">
                                </div>
                            </div>
                            <div class="form-group mt-2 float-right">
                                <button class="btn btn-primary px-5 btnTambah">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-right mb-3"><?= $kode_baru ?></h3>
                        <div class="display-4 text-right mt-5 displayTotalHarga">
                            0
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table list_produk">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="sub_total" class="col-sm-4 col-form-label font-weight-bold">Sub Total</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="sub_total" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diskon" class="col-sm-4 col-form-label font-weight-bold">Diskon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="diskon" value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-4 col-form-label font-weight-bold">Total</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="total" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="tunai" class="col-sm-4 col-form-label font-weight-bold">Tunai</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tunai" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kembalian" class="col-sm-4 col-form-label font-weight-bold">Kembalian</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kembalian" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <a href="" class="btn btn-lg btn-danger">
                            Batal
                        </a>
                        <br>
                        <br>
                        <br>
                        <button class="btn btn-lg btn-success btnSimpanTransaksi">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        let table = $('.list_produk').DataTable({
            columnDefs: [{
                targets: -1, // Mengarahkan ke kolom terakhir (kolom aksi)
                data: null,
                defaultContent: "<button class='btn btn-sm btn-danger hapusButton'>Hapus</button>",
            }],
        });
        // $('#id_produk').on('change', function() {
        //     let id_produk = $(this).val();
        //     let jumlah = $('#jumlah').val();

        //     // console.log(data);
        //     // console.log(id_produk);
        // })
        $('.btnTambah').on('click', function() {
            let id_produk = $("#id_produk").val();
            let jumlah = $('#jumlah').val();

            $.ajax({
                url: "<?= BASE_URL . '/pages/produk/get_by_id.php' ?>",
                type: 'GET',
                data: {
                    id_produk
                },
                dataType: 'JSON',
                success: function(data) {
                    let dataArray = [];
                    dataArray.push({
                        id_produk: data.id_produk,
                        kode: data.kode,
                        nama_produk: data.nama_produk,
                        harga: data.harga,
                        jumlah: jumlah,
                        total_harga: (jumlah * data.harga)
                    });

                    tambahDataKeLocalStorage(dataArray);

                    tampilkanData('list_produk');
                },
                error: function(errors) {
                    console.error("AJAX request failed:");
                }
            })
        })

        function formatAngka(angka) {
            if (typeof angka === 'string') {
                return parseInt(angka.replace(/[^0-9]/g, ''), 10);
            }
            return angka;
        }

        function formatRupiah(inputAngka) {
            // let rupiah = new Intl.NumberFormat('id-ID', {
            //     style: 'currency',
            //     currency: 'IDR'
            // }).format(inputAngka);
            return 'Rp ' + inputAngka.toLocaleString('id-ID');

            // function formatRupiah(value) {
            //     return 'Rp ' + value.toLocaleString('id-ID');
            // }
            // return rupiah;
        }


        function hitungTotal() {
            let table = $('.list_produk').DataTable();
            let totalKeseluruhan = 0;

            // Mengakses data dalam DataTable
            table.rows().every(function() {
                let data = this.data();
                let harga = formatAngka(data[3]); // Mengambil harga dari kolom yang sesuai
                let jumlah = parseInt(data[4]);
                let total = harga * jumlah;

                // Menyimpan total pada kolom yang sesuai
                table.cell(this, 5).data(formatRupiah(total));

                totalKeseluruhan += total;
            });

            // Mengatur total keseluruhan pada elemen dengan ID 'totalKeseluruhan'
            $('.displayTotalHarga').text(formatRupiah(totalKeseluruhan));
            $('#sub_total').val(totalKeseluruhan);
            $('#total').val(totalKeseluruhan);
        }

        function tambahDataKeLocalStorage(data) {
            // Mendapatkan data yang sudah ada di localStorage
            var existingData = JSON.parse(localStorage.getItem('list_produk')) || [];
            // Menambahkan data baru ke array existingData
            existingData.push(data);
            // Menyimpan data ke localStorage
            localStorage.setItem('list_produk', JSON.stringify(existingData));
        }

        function tambahDataKeTabel(data) {
            var table = $('.list_produk').DataTable();
            table.row.add([
                table.rows().count() + 1,
                data[0].kode,
                data[0].nama_produk,
                formatRupiah(data[0].harga),
                data[0].jumlah,
                formatRupiah(data[0].total_harga)
            ]).draw();

            hitungTotal();
        }


        function tampilkanData(key) {
            try {
                let storedData = localStorage.getItem(key);

                if (storedData) {
                    let retrievedData = JSON.parse(storedData);
                    // Inisialisasi DataTable
                    table.clear();

                    if (retrievedData.length > 0) {
                        // Jika ada data, tambahkan data ke DataTable
                        retrievedData.forEach(function(data) {
                            let data2 = data[0];
                            tambahDataKeTabel(data);
                        });
                    }

                    // hitungTotal();

                } else {
                    // Jika tidak ada data yang disimpan di localStorage, tambahkan baris kosong ke DataTable
                    console.log("Tidak ada data yang disimpan di localStorage.");
                }
            } catch (error) {
                console.error("Terjadi kesalahan:", error);
            }
        }

        function hapusData(data, key) {
            try {
                let storedData = localStorage.getItem(key);

                if (storedData) {
                    let retrievedData = JSON.parse(storedData);
                    // Cari indeks data berdasarkan data yang diklik
                    let index = retrievedData.findIndex(function(d) {
                        // console.log(d[0]);
                        // console.log(data[0]);
                        return d[0].id_produk === data[0];
                    });
                    // console.log(data);
                    if (index === -1) {
                        // Hapus data dari array
                        retrievedData.splice(index, 1);
                        localStorage.setItem(key, JSON.stringify(retrievedData));
                        table.clear().draw();
                        hitungTotal();
                    } else {
                        console.log("Data tidak ditemukan.");
                    }

                    // Tampilkan data terbaru
                    tampilkanData(key);
                } else {
                    console.log("Tidak ada data yang disimpan di localStorage.");
                }
            } catch (error) {
                console.error("Terjadi kesalahan:", error);
            }
        }

        $('.list_produk tbody').on('click', 'button.hapusButton', function() {
            let data = $('.list_produk').DataTable().row($(this).parents('tr')).data();
            hapusData(data, "list_produk");
        });

        // diskon
        $('#diskon').on('input', function() {
            let sub_total = $('#sub_total').val();
            let diskon = $(this).val();
            let total = sub_total - diskon;
            $('#total').val(total);
            console.log(diskon);
        })

        // tunai dan kembalian
        $('#tunai').on('input', function() {
            let tunai = $(this).val();
            let total = $('#total').val();
            let kembalian = tunai - total;
            $('#kembalian').val(kembalian);
        })

        // tombol simpan transaksi
        $('.btnSimpanTransaksi').on('click', function() {
            let storedData = localStorage.getItem('list_produk');
            let data = JSON.parse(storedData);
            let sub_total = $("#sub_total").val();
            let total = $("#total").val();
            let tunai = $('#tunai').val();
            let kembalian = $('#kembalian').val();
            let id_customer = $('#id_customer').val();
            let diskon = $('#diskon').val();

            $.ajax({
                url: '<?= BASE_URL ?>' + '/pages/transaksi/proses_tambah.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    data: data,
                    sub_total,
                    total,
                    tunai,
                    kembalian,
                    id_customer,
                    diskon
                },
                success: function(response) {
                    if (response.status) {
                        // hapus localstorage
                        localStorage.removeItem('list_produk');
                        window.location.href = '<?= BASE_URL . '/main.php?page=transaksi&&status=success&&message=Transaksi berhasil ditambahkan.'; ?>'
                    } else {
                        console.log(response);
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            })
        })

        tampilkanData('list_produk');
        hitungTotal();
    })
</script>