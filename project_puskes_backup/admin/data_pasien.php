<?php
session_start();
include '../config/connect.php';

// Proteksi Admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../account/login.php");
    exit;
}

// 1. Ambil data rujukan
$query = "SELECT * FROM rujukan ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

// 2. Hitung total pasien rujukan hari ini
$hari_ini = date('Y-m-d');
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM rujukan WHERE tanggal = '$hari_ini'");
$total_data = mysqli_fetch_assoc($total_query);
$total_pasien = $total_data['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pasien | PuskesCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .badge { padding: 5px 12px; border-radius: 6px; font-weight: bold; font-size: 11px; text-transform: uppercase; }
        .badge.diterima { background: #e6f7d4; color: #52c41a; }
        .badge.dikirim { background: #fffbe6; color: #faad14; }
        .badge.ditolak { background: #fff1f0; color: #f5222d; }
    </style>
</head>
<body class="bg-slate-100 flex">

    <?php include '../layout/admin/sidebar.php' ?>

    <div class="flex-1 p-10">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Data Rujukan Pasien</h1>
                <p class="text-slate-500 text-sm">Monitoring rujukan pasien ke Rumah Sakit tujuan.</p>
            </div>
            
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fa fa-users text-blue-500"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Rujukan Hari Ini</p>
                    <h2 class="text-lg font-bold text-slate-800"><?= $total_pasien; ?> Pasien</h2>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase">No. Rujukan</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase">Nama Pasien</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase text-center">No. BPJS</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase">RS Tujuan</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase">Keluhan</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase text-center">Tanggal</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (mysqli_num_rows($result) > 0) : ?>
                            <?php while($row = mysqli_fetch_assoc($result)) : ?>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-mono text-sm text-blue-600 font-bold"><?= $row['no_rujukan']; ?></td>
                                <td class="p-4 font-semibold text-slate-800"><?= $row['nama_pasien']; ?></td>
                                <td class="p-4 text-center text-sm text-slate-600"><?= $row['no_bpjs']; ?></td>
                                <td class="p-4 text-sm text-slate-700"><?= $row['rs_tujuan']; ?></td>
                                <td class="p-4 text-sm text-slate-500 max-w-xs truncate italic">"<?= $row['keluhan']; ?>"</td>
                                <td class="p-4 text-center text-sm text-slate-600"><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                <td class="p-4 text-center">
                                    <?php $statusClass = strtolower($row['status']); ?>
                                    <span class="badge <?= $statusClass; ?>"><?= $row['status']; ?></span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="p-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-folder-open text-slate-200 text-4xl mb-3"></i>
                                        <p class="text-slate-400 italic text-sm">Belum ada data rujukan pasien.</p>
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