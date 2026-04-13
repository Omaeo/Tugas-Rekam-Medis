<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_rekam_medis", 3307);

// Validasi login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data dari session
$nama = $_SESSION['nama'];
$bpjs = $_SESSION['bpjs'];
$alamat = $_SESSION['alamat'];

// Ambil poli dari URL
$poli = $_GET['poli'] ?? 'Umum';

// Tanggal hari ini
$tanggal = date('Y-m-d');

// Cek apakah user sudah ambil antrian hari ini
$cek = mysqli_query($conn, "SELECT * FROM antrian 
                           WHERE nomor_bpjs='$bpjs' 
                           AND poli_tujuan='$poli' 
                           AND tanggal='$tanggal'");

if (mysqli_num_rows($cek) > 0) {

    // Kalau sudah ada → ambil nomor lama
    $data = mysqli_fetch_assoc($cek);
    $nomorAntrian = $data['nomor_antrian'];

} else {

    // Ambil nomor terakhir
    $result = mysqli_query($conn, "SELECT MAX(nomor_antrian) as last 
                                  FROM antrian
                                  WHERE poli_tujuan='$poli' AND tanggal='$tanggal'");

    $data = mysqli_fetch_assoc($result);

    $nomorAntrian = ($data['last'] ?? 0) + 1;

    // Simpan ke database
    mysqli_query($conn, "INSERT INTO pasien 
        (nama, nomor_bpjs, alamat, poli)
        VALUES 
        ('$nama', '$bpjs', '$alamat', '$poli')");
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
<body class="bg-blue-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-xl text-center">

    <h1 class="text-2xl font-bold text-blue-800 mb-6">
        Nomor Antrian Anda
    </h1>

    <div class="bg-blue-50 p-6 rounded-xl mb-6">

        <p><strong>Nama:</strong> <?= $_SESSION['nama'] ?: '-' ?></p>
        <p><strong>No BPJS:</strong> <?= $_SESSION['bpjs'] ?: '-' ?></p>
        <p><strong>Alamat:</strong> <?= $_SESSION['alamat'] ?: '-' ?></p>
        <p class="mb-2"><strong>Poli:</strong> <?= htmlspecialchars($poli) ?></p>

    </div>

    <div class="text-6xl font-bold text-blue-700 mb-6">
        <?= str_pad($nomorAntrian, 3, "0", STR_PAD_LEFT); ?>
    </div>

    <a href="home.php"
       class="bg-blue-700 hover:bg-blue-900 text-white px-6 py-3 rounded-full shadow-md transition">
        Kembali ke Beranda
    </a>

</div>

</body>
</html>


