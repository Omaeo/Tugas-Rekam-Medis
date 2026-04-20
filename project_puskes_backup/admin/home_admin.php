<?php
session_start();
include '../config/connect.php';

// Proteksi: Hanya Admin yang boleh masuk
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../account/login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    $role = $_POST['role'];
    $poli = $_POST['poli'] ?? null;

    $cek_nip = mysqli_query($conn, "SELECT * FROM users WHERE nip = '$nip'");
    if (mysqli_num_rows($cek_nip) > 0) {
        echo "<script>alert('Error: NIP sudah terdaftar!');</script>";
    } else {
        $query_user = "INSERT INTO users (nama, nip, password, role) VALUES ('$nama', '$nip', '$password', '$role')";
        if (mysqli_query($conn, $query_user)) {
            if ($role === 'dokter') {
                mysqli_query($conn, "INSERT INTO dokter (nip, nama_dokter, poli_dokter) VALUES ('$nip', '$nama', '$poli')");
            }
            echo "<script>alert('Berhasil ditambahkan!'); window.location='data_dokter.php';</script>";
        }
    }
}

// Ambil Statistik untuk Dashboard
$count_dokter = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokter"));
$count_pasien = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role = 'user'"));
$count_antrian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM antrian WHERE tanggal = CURDATE()"));

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | PuskesCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex">

<?php include '../layout/admin/sidebar.php'?>

    <div class="flex-1 p-10">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Selamat Datang, <?= $_SESSION['nama'] ?>!</h1>
                <p class="text-slate-500 text-sm">Berikut ringkasan operasional puskesmas hari ini.</p>
            </div>
            <div class="bg-white p-3 rounded-xl shadow-sm border border-slate-200">
                <p class="text-sm font-bold text-slate-700 italic"><?= date('l, d F Y') ?></p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-lg text-blue-500 mr-4">
                        <i class="fas fa-user-md fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Dokter</p>
                        <h3 class="text-2xl font-bold text-slate-800"><?= $count_dokter ?></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-emerald-500">
                <div class="flex items-center">
                    <div class="p-3 bg-emerald-50 rounded-lg text-emerald-500 mr-4">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Pasien Terdaftar</p>
                        <h3 class="text-2xl font-bold text-slate-800"><?= $count_pasien ?></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-orange-500">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-50 rounded-lg text-orange-500 mr-4">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Antrian Hari Ini</p>
                        <h3 class="text-2xl font-bold text-slate-800"><?= $count_antrian ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm mb-10">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Aksi Cepat</h2>
            <div class="flex gap-4">
                <a href="tambah_petugas.php" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Dokter/Admin Baru
                </a>
                <a href="cetak_laporan.php" class="bg-slate-800 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-900 transition">
                    <i class="fas fa-print mr-2"></i> Cetak Laporan
                </a>
            </div>
        </div>
    </div>
    <?php
        $query_antrian_today = mysqli_query($conn, "SELECT antrian.*, pasien.nama_pasien 
            FROM antrian 
            JOIN pasien ON antrian.nomor_bpjs = pasien.nomor_bpjs 
            WHERE antrian.tanggal = CURDATE() 
            ORDER BY antrian.nomor_antrian ASC LIMIT 10");
        ?>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-800">Alur Antrian Hari Ini</h2>
                <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full font-bold">LIVE</span>
            </div>

            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                <?php if(mysqli_num_rows($query_antrian_today) > 0) : ?>
                    <?php while($antri = mysqli_fetch_assoc($query_antrian_today)) : ?>
                        
                        <div class="min-w-[200px] bg-slate-50 border border-slate-100 p-4 rounded-xl flex flex-col items-center relative">
                            <div class="w-12 h-12 bg-white shadow-sm rounded-full flex items-center justify-center text-xl font-black text-blue-600 mb-3 border border-blue-100">
                                <?= $antri['nomor_antrian'] ?>
                            </div>
                            
                            <div class="text-center">
                                <p class="text-sm font-bold text-slate-800 truncate w-36"><?= $antri['nama_pasien'] ?></p>
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-3"><?= $antri['poli_tujuan'] ?></p>
                                
                                <?php if($antri['status'] == 'menunggu') : ?>
                                    <span class="text-[10px] bg-amber-100 text-amber-700 px-3 py-1 rounded-full font-bold">MENUNGGU</span>
                                <?php else : ?>
                                    <span class="text-[10px] bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full font-bold">SELESAI</span>
                                <?php endif; ?>
                            </div>

                            <div class="absolute top-1/2 -right-4 translate-y-[-50%] text-slate-300 hidden md:block">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="w-full text-center py-10 text-slate-400 italic text-sm">
                        Belum ada antrian yang masuk.
                    </div>
                <?php endif; ?>
            </div>
        </div>
</body>

</html>