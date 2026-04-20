<?php
session_start();
include '../config/connect.php';

// Proteksi Halaman
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'dokter') {
    header("Location: ../account/login.php");
    exit;
}

$nip = $_SESSION['nip'];

// Ambil data dokter terbaru
$query = mysqli_query($conn, "SELECT * FROM dokter WHERE nip = '$nip'");
$data = mysqli_fetch_assoc($query);

// Proses Update Profil
if (isset($_POST['update_profile'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $poli = mysqli_real_escape_string($conn, $_POST['poli']);
    $hari = mysqli_real_escape_string($conn, $_POST['hari']);
    $jam  = mysqli_real_escape_string($conn, $_POST['jam']);

    $update = mysqli_query($conn, "UPDATE dokter SET 
                nama_dokter = '$nama', 
                poli_dokter = '$poli', 
                hari = '$hari', 
                jam = '$jam' 
                WHERE nip = '$nip'");

    if ($update) {
        $_SESSION['nama'] = $nama; // Update session nama biar di sidebar berubah
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='profil_dokter.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya | PuskesCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex">

    <?php include '../layout/dokter/sidebar.php' ?>

    <div class="flex-1 p-10 ml-[260px]">
        <header class="mb-10">
            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Settings</span>
            <h1 class="text-3xl font-bold text-slate-800 mt-2">Profil Profesional</h1>
            <p class="text-slate-500">Kelola informasi identitas dan jadwal praktek Anda.</p>
        </header>

        <div class="max-w-4xl bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/3 bg-slate-50 p-10 border-r border-slate-100 flex flex-col items-center justify-center">
                    <div class="w-32 h-32 bg-blue-600 rounded-3xl flex items-center justify-center shadow-xl shadow-blue-100 mb-6 text-white text-4xl font-black">
                        <?= substr($data['nama_dokter'], 0, 2) ?>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 text-center"><?= htmlspecialchars($data['nama_dokter']) ?></h2>
                    <p class="text-blue-600 font-medium text-sm"><?= htmlspecialchars($data['poli_dokter']) ?></p>
                    <div class="mt-6 w-full space-y-3">
                        <div class="flex items-center gap-3 text-xs text-slate-500 bg-white p-3 rounded-xl border border-slate-100">
                            <i class="fas fa-id-badge text-blue-500"></i>
                            <span>NIP: <?= $nip ?></span>
                        </div>
                    </div>
                </div>

                <div class="md:w-2/3 p-10">
                    <form action="" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase ml-1">Nama Lengkap</label>
                                <input type="text" name="nama" value="<?= $data['nama_dokter'] ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" required>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase ml-1">NIP (Identitas Utama)</label>
                                <div class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-slate-500 flex items-center gap-2">
                                    <i class="fas fa-lock text-[10px]"></i>
                                    <span class="font-medium"><?= $nip ?></span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase ml-1">Unit Penempatan</label>
                                <div class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-slate-500 flex items-center gap-2">
                                    <i class="fas fa-hospital-user text-[10px]"></i>
                                    <span class="font-medium"><?= $data['poli_dokter'] ?></span>
                                </div>
                                <input type="hidden" name="poli" value="<?= $data['poli_dokter'] ?>">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase ml-1">Hari Praktek</label>
                                <input type="text" name="hari" value="<?= $data['hari'] ?>" placeholder="Contoh: Senin - Jumat" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 transition">
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-bold text-slate-400 uppercase ml-1">Jam Operasional</label>
                                <input type="text" name="jam" value="<?= $data['jam'] ?>" placeholder="Contoh: 08:00 - 14:00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 transition">
                            </div>
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button type="submit" name="update_profile" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i> Simpan Profil
                            </button>
                            <a href="dokter_dashboard.php" class="px-6 py-3 border border-slate-200 rounded-xl font-bold text-slate-500 hover:bg-slate-50 transition text-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>