<?php
session_start();
include '../config/connect.php';

// Proteksi: Hanya Admin yang bisa akses
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../account/login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Masih teks biasa untuk testing
    $role = $_POST['role'];
    $poli = $_POST['poli'] ?? null;

    // 1. Cek apakah NIP sudah terdaftar di tabel users
    $cek_nip = mysqli_query($conn, "SELECT * FROM users WHERE nip = '$nip'");
    if (mysqli_num_rows($cek_nip) > 0) {
        $error = "NIP sudah digunakan oleh petugas lain!";
    } else {
        // 2. Masukkan ke tabel users
        $query_user = "INSERT INTO users (nama, nip, password, role) VALUES ('$nama', '$nip', '$password', '$role')";
        
        if (mysqli_query($conn, $query_user)) {
            // 3. Jika rolenya Dokter, masukkan juga datanya ke tabel dokter
            if ($role === 'dokter') {
                mysqli_query($conn, "INSERT INTO dokter (nip, nama_dokter, poli_dokter) VALUES ('$nip', '$nama', '$poli')");
            }
            echo "<script>alert('Petugas berhasil ditambahkan!'); window.location='data_dokter.php';</script>";
        } else {
            $error = "Gagal menambah data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Petugas | AdminPanel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex">

    <?php include '../layout/admin/sidebar.php'?>

    <div class="flex-1 p-10">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-2xl font-bold text-slate-800 mb-6"><i class="fas fa-user-plus text-blue-500 mr-2"></i> Tambah Petugas Baru</h2>

            <?php if (isset($error)) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: dr. Ahmad" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">NIP Petugas</label>
                    <input type="text" name="nip" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan NIP Unik" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password Login</label>
                    <input type="text" name="password" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tentukan Password" required>
                    <p class="text-xs text-slate-400 mt-1">*Sementara menggunakan teks biasa (plain text).</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Role Petugas</label>
                    <select name="role" id="roleSelect" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-blue-400" onchange="togglePoli()" required>
                        <option value="admin">Administrator</option>
                        <option value="dokter">Dokter</option>
                    </select>
                </div>

                <div id="poliWrapper" class="hidden">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Spesialis Poli</label>
                    <select name="poli" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="Poli Umum">Poli Umum</option>
                        <option value="Poli Gigi">Poli Gigi</option>
                        <option value="Poli Anak">Poli Anak</option>
                        <option value="Poli Mata">Poli Mata</option>
                    </select>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" name="tambah" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                        Simpan Petugas
                    </button>
                    <a href="data_dokter.php" class="px-6 py-3 bg-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-300 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi JS untuk memunculkan pilihan Poli hanya jika Role adalah Dokter
        function togglePoli() {
            const role = document.getElementById('roleSelect').value;
            const poliWrapper = document.getElementById('poliWrapper');
            if (role === 'dokter') {
                poliWrapper.classList.remove('hidden');
            } else {
                poliWrapper.classList.add('hidden');
            }
        }
    </script>
</body>
</html>