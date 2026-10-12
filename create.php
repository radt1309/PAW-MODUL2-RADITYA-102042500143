<?php
require 'functions.php';
require 'connect.php';

$mobil = [
    'kode_mobil' => '', 'nama_mobil' => '', 'brand_mobil' => '',
    'warna_mobil' => '', 'tipe_mobil' => '', 'harga_mobil' => '',
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobil  = data_form();
    $errors = validasi_mobil($conn, $mobil);

    if (count($errors) === 0) {
        // TODO 2 (CREATE)
        // Simpan isi $mobil sebagai baris baru di tabel showroom_mobil.
        // Kolom id dan created_at terisi otomatis, jadi tidak perlu ikut di-INSERT.
        // Ubah $berhasil menjadi true kalau query-nya sukses dijalankan.
        $query = "INSERT INTO showroom_mobil (kode_mobil, nama_mobil, brand_mobil, warna_mobil, tipe_mobil, harga_mobil) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssssss", $mobil['kode_mobil'], $mobil['nama_mobil'], $mobil['brand_mobil'], $mobil['warna_mobil'], $mobil['tipe_mobil'], $mobil['harga_mobil']);
    $berhasil = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} else {
    $berhasil = false;
}

if ($berhasil) {
    pindah_halaman('index.php', 'Data mobil berhasil ditambahkan.');
} else {
    $errors['umum'] = 'Data belum tersimpan. Cek lagi pengerjaan TODO 2 di create.php.';
}
        $berhasil = false;

        if ($berhasil) {
            pindah_halaman('index.php', 'Data mobil berhasil ditambahkan.');
        }
        $errors['umum'] = 'Data belum tersimpan. Cek lagi pengerjaan TODO 2 di create.php.';
    }
}

$judul = 'Tambah mobil';
require 'header.php';
?>
<h1>Tambah mobil</h1>

<?php if (count($errors) > 0): ?>
    <p class="notice notice-error"><?= h($errors['umum'] ?? 'Data belum tersimpan. Perbaiki kolom yang ditandai.') ?></p>
<?php endif ?>

<form class="card form" method="post" action="create.php">
    <?php require 'form_mobil.php'; ?>
    <div class="actions">
        <button class="btn" type="submit">Simpan mobil</button>
        <a class="btn btn-ghost" href="index.php">Batal</a>
    </div>
</form>
<?php require 'footer.php'; ?>
