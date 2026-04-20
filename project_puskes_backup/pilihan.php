<?php
session_start();
include 'config/connect.php';

// Pastikan user sudah login dan punya BPJS di session
if (!isset($_SESSION['login']) || !isset($_SESSION['bpjs'])) {
    header("Location: account/login.php");
    exit;
}

$bpjs = $_SESSION['bpjs'];
$poli = $_GET['poli'] ?? 'Umum';
$tanggal_hari_ini = date('Y-m-d');

// 1. Ambil nomor antrian terakhir
$query_check = mysqli_query($conn, "SELECT MAX(nomor_antrian) as max_no FROM antrian 
                                    WHERE poli_tujuan='$poli' AND tanggal='$tanggal_hari_ini'");
$data_antrian = mysqli_fetch_assoc($query_check);
$nomorAntrian = ($data_antrian['max_no'] ?? 0) + 1;

// 2. Simpan ke database
$query_insert = "INSERT INTO antrian (nomor_bpjs, poli_tujuan, nomor_antrian, tanggal) 
                 VALUES ('$bpjs', '$poli', '$nomorAntrian', '$tanggal_hari_ini')";

// 3. Ambil data lengkap (Nama & Alamat) lewat JOIN untuk ditampilkan di bawah
if (mysqli_query($conn, $query_insert)) {
    // Kita panggil nama_pasien dari tabel pasien berdasarkan nomor_bpjs yang login
    $query_join = mysqli_query($conn, "SELECT antrian.*, pasien.nama_pasien, pasien.alamat 
                                       FROM antrian 
                                       INNER JOIN pasien ON antrian.nomor_bpjs = pasien.nomor_bpjs 
                                       WHERE antrian.nomor_bpjs = '$bpjs' 
                                       ORDER BY antrian.id_antrian DESC LIMIT 1");
    $data_lengkap = mysqli_fetch_assoc($query_join);
    
    // Simpan ke variabel agar mudah dipanggil di HTML
    $tampil_nama = $data_lengkap['nama_pasien'] ?? 'Tidak ditemukan';
    $tampil_alamat = $data_lengkap['alamat'] ?? '-';
} else {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md text-center">
        <h1 class="text-2xl font-bold text-blue-800 mb-6">Nomor Antrian Anda</h1>
        
        <div class="bg-blue-50 p-6 rounded-xl mb-6 text-left space-y-2">
            <p><strong>No BPJS:</strong> <?= htmlspecialchars($bpjs) ?></p>
            <p><strong>Nama:</strong> <?= htmlspecialchars($tampil_nama) ?></p>
            <p><strong>Alamat:</strong> <?= htmlspecialchars($tampil_alamat) ?></p>
            <p><strong>Poli:</strong> <?= htmlspecialchars(ucfirst($poli)) ?></p>
            <p><strong>Tanggal:</strong> <?= date('d-m-Y') ?></p>
        </div>

        <div class="text-7xl font-black text-blue-700 mb-8">
            <?= str_pad($nomorAntrian, 3, "0", STR_PAD_LEFT); ?>
        </div>

        <a href="home.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold px-8 py-3 rounded-full shadow-lg transition">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>