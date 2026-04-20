<?php
session_start();
include '../config/connect.php';

// Proteksi Halaman: Hanya Dokter yang boleh masuk
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'dokter') {
    header("Location: ../account/login.php");
    exit;
}

$nip = $_SESSION['nip'];
$nama_dokter = $_SESSION['nama'];

// 1. Ambil data poli si dokter
$query_poli = mysqli_query($conn, "SELECT poli_dokter, hari, jam FROM dokter WHERE nip = '$nip'");
$data_dokter = mysqli_fetch_assoc($query_poli);
$poli = $data_dokter['poli_dokter'] ?? 'Poli Belum Diset';
$hari_praktek = $data_dokter['hari'] ?? '-';
$jam_praktek = $data_dokter['jam'] ?? '-';

// 2. Ambil daftar antrian untuk poli ini hari ini
$tanggal_sekarang = date('Y-m-d');
$query_antrian = mysqli_query($conn, "SELECT antrian.*, pasien.nama_pasien 
                                      FROM antrian 
                                      JOIN pasien ON antrian.nomor_bpjs = pasien.nomor_bpjs 
                                      WHERE antrian.poli_tujuan = '$poli' 
                                      AND antrian.tanggal = '$tanggal_sekarang'
                                      ORDER BY antrian.status DESC, antrian.nomor_antrian ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter | PuskesCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex">

    <?php include '../layout/dokter/sidebar.php' ?>

    <div class="flex-1 p-10 ml-[260px]">
        <header class="flex justify-between items-start mb-10">
            <div>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Medical Staff Panel</span>
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Halo, dr. <?= htmlspecialchars($nama_dokter) ?></h1>
                <p class="text-slate-500 mt-1">Selamat bertugas di <span class="font-bold text-blue-600"><?= $poli ?></span></p>
            </div>

            <div class="flex gap-4">
                <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                        <i class="fas fa-calendar-day text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Jadwal Praktek</p>
                        <p class="text-sm font-bold text-slate-800"><?= $hari_praktek ?></p>
                        <p class="text-xs text-slate-500"><?= $jam_praktek ?> WIB</p>
                    </div>
                </div>

                <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-200 text-right min-w-[150px]">
                    <p class="text-[10px] text-blue-500 font-bold uppercase tracking-widest mb-1"><?= date('l') ?></p>
                    <p class="text-lg font-black text-slate-800"><?= date('d F Y') ?></p>
                    <p class="text-xs text-slate-400">PuskesCare Digital</p>
                </div>
            </div>
        </header>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-slate-800 italic">Daftar Pasien Hari Ini</h2>
                <div class="flex gap-4">
                    <div class="flex items-center text-xs text-slate-500 font-medium">
                        <span class="w-3 h-3 bg-amber-400 rounded-full mr-2"></span> Menunggu
                    </div>
                    <div class="flex items-center text-xs text-slate-500 font-medium">
                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span> Selesai
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="p-5 font-bold text-center w-24">No. Antri</th>
                            <th class="p-5 font-bold">Informasi Pasien</th>
                            <th class="p-5 font-bold text-center">Status Pelayanan</th>
                            <th class="p-5 font-bold text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (mysqli_num_rows($query_antrian) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($query_antrian)) : ?>
                            <tr class="<?= $row['status'] == 'selesai' ? 'bg-slate-50/50' : 'hover:bg-blue-50/30' ?> transition">
                                <td class="p-5 text-center">
                                    <span class="inline-block w-12 h-12 leading-[48px] rounded-2xl font-black text-xl shadow-inner border 
                                        <?= $row['status'] == 'selesai' ? 'bg-slate-200 text-slate-400 border-slate-300' : 'bg-blue-600 text-white border-blue-500 shadow-blue-100' ?>">
                                        <?= str_pad($row['nomor_antrian'], 2, "0", STR_PAD_LEFT) ?>
                                    </span>
                                </td>
                                <td class="p-5">
                                    <p class="font-bold text-lg <?= $row['status'] == 'selesai' ? 'text-slate-400 line-through' : 'text-slate-800' ?>">
                                        <?= htmlspecialchars($row['nama_pasien']) ?>
                                    </p>
                                    <p class="text-xs font-mono text-slate-400 mt-1">BPJS: <?= htmlspecialchars($row['nomor_bpjs']) ?></p>
                                </td>
                                <td class="p-5 text-center">
                                    <?php if ($row['status'] == 'menunggu') : ?>
                                        <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase animate-pulse">
                                            Menunggu Antrian
                                        </span>
                                    <?php else : ?>
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-black uppercase">
                                            Sudah Diperiksa
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-5 text-center">
                                    <?php if ($row['status'] == 'menunggu') : ?>
                                        <a href="update_status.php?id=<?= $row['id_antrian'] ?>&status=selesai" 
                                           onclick="return confirm('Selesaikan pemeriksaan pasien ini?')"
                                           class="inline-flex items-center bg-blue-600 text-white px-5 py-2 rounded-xl font-bold text-xs hover:bg-blue-700 shadow-lg shadow-blue-100 transition">
                                            <i class="fas fa-notes-medical mr-2"></i> Periksa Selesai
                                        </a>
                                    <?php else : ?>
                                        <span class="text-slate-300"><i class="fas fa-check-circle fa-lg"></i></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="p-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-calendar-check text-slate-200 text-6xl mb-4"></i>
                                        <p class="text-slate-400 font-medium">Belum ada pasien yang terdaftar di poli Anda.</p>
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