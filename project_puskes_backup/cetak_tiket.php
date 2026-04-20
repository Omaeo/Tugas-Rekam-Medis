<?php
session_start();
include 'config/connect.php';

// Ambil BPJS dari session
$bpjs = $_SESSION['bpjs'];

// Query JOIN yang kamu buat tadi
$sql = "SELECT antrian.*, pasien.nama_pasien 
        FROM antrian 
        INNER JOIN pasien ON antrian.nomor_bpjs = pasien.nomor_bpjs 
        WHERE antrian.nomor_bpjs = '$bpjs' 
        ORDER BY antrian.id_antrian DESC LIMIT 1";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>

<div class="card-tiket">
    <?php if ($data): ?>
        <h2>Tiket Antrian Anda</h2>
        <p>Nama: <?= $data['nama_pasien']; ?></p>
        <h1 style="font-size: 3rem;"><?= $data['nomor_antrian']; ?></h1>
        <p>Poli: <?= $data['poli_tujuan']; ?></p>
        <p>Tanggal: <?= $data['tanggal']; ?></p>
    <?php else: ?>
        <p>Belum ada antrian.</p>
    <?php endif; ?>
</div>