<?php
session_start();


$conn = mysqli_connect("localhost", "root", "", "db_rekam_medis");

$nama = $_SESSION['nama'] ?? '';

$query = mysqli_query($conn, "SELECT * FROM users WHERE nama='$nama'");
$user = mysqli_fetch_assoc($query);


// Ambil poli dari URL
$poli = $_GET['poli'] ?? 'Umum';

// Buat nomor antrian naik otomatis per poli
if (!isset($_SESSION['antrian'][$poli])) {
    $_SESSION['antrian'][$poli] = 1;
} else {
    $_SESSION['antrian'][$poli]++;
}

$nomorAntrian = $_SESSION['antrian'][$poli];
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


