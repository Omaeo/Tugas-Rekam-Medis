<?php
session_start();
include '../config/connect.php';

// Proteksi Halaman
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'dokter') {
    header("Location: ../account/login.php");
    exit;
}

$nip = $_SESSION['nip'];

// 1. Ambil data poli dokter
$query_poli = mysqli_query($conn, "SELECT poli_dokter FROM dokter WHERE nip = '$nip'");
$data_dokter = mysqli_fetch_assoc($query_poli);
$poli = $data_dokter['poli_dokter'] ?? 'Poli Belum Diset';

// 2. Ambil data pasien yang statusnya 'selesai' khusus di poli dokter tersebut
$query_riwayat = mysqli_query($conn, "SELECT antrian.*, pasien.nama_pasien, pasien.jenis_kelamin 
                                      FROM antrian 
                                      JOIN pasien ON antrian.nomor_bpjs = pasien.nomor_bpjs 
                                      WHERE antrian.poli_tujuan = '$poli' 
                                      AND antrian.status = 'selesai'
                                      ORDER BY antrian.tanggal DESC, antrian.nomor_antrian DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pasien | PuskesCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex">

    <?php include '../layout/dokter/sidebar.php' ?>

    <div class="flex-1 p-10 ml-[260px]">
        <header class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <a href="dokter_dashboard.php" class="text-slate-400 hover:text-blue-600 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Archive</span>
            </div>
            <h1 class="text-3xl font-bold text-slate-800">Riwayat Pemeriksaan</h1>
            <p class="text-slate-500">Daftar seluruh pasien yang telah selesai dilayani di <span class="font-bold text-blue-600"><?= $poli ?></span>.</p>
        </header>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h2 class="font-bold text-slate-800 tracking-tight">Data Rekam Antrian Selesai</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="p-5 font-bold">Tanggal</th>
                            <th class="p-5 font-bold">No. Antri</th>
                            <th class="p-5 font-bold">Nama Pasien</th>
                            <th class="p-5 font-bold">No. BPJS</th>
                            <th class="p-5 font-bold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (mysqli_num_rows($query_riwayat) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($query_riwayat)) : ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-5">
                                    <p class="text-sm font-bold text-slate-700"><?= date('d M Y', strtotime($row['tanggal'])) ?></p>
                                    <p class="text-[10px] text-slate-400 uppercase"><?= date('H:i', strtotime($row['tanggal'])) ?> WIB</p>
                                </td>
                                <td class="p-5">
                                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg font-mono font-bold">
                                        #<?= str_pad($row['nomor_antrian'], 2, "0", STR_PAD_LEFT) ?>
                                    </span>
                                </td>
                                <td class="p-5">
                                    <p class="font-bold text-slate-800"><?= htmlspecialchars($row['nama_pasien']) ?></p>
                                    <p class="text-xs text-slate-400"><?= $row['jenis_kelamin'] ?></p>
                                </td>
                                <td class="p-5 text-sm font-mono text-slate-500"><?= htmlspecialchars($row['nomor_bpjs']) ?></td>
                                <td class="p-5 text-center">
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase border border-blue-100">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                    </span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-history text-slate-200 text-6xl mb-4"></i>
                                        <p class="text-slate-400 font-medium">Belum ada riwayat pasien yang selesai diperiksa.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>