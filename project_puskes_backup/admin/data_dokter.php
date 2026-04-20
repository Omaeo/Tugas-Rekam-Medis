<?php
session_start();
include '../config/connect.php';

// Proteksi Admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../account/login.php");
    exit;
}

// --- LOGIKA PHP (TAMBAH & UPDATE) ---

// 1. Logika Tambah
if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    $role = $_POST['role'];
    $poli = $_POST['poli'] ?? '-';
    $hari = mysqli_real_escape_string($conn, $_POST['hari']) ?: '-';
    $jam = mysqli_real_escape_string($conn, $_POST['jam']) ?: '-';
    
    $cek_nip = mysqli_query($conn, "SELECT * FROM users WHERE nip = '$nip'");
    if (mysqli_num_rows($cek_nip) > 0) {
        echo "<script>alert('Error: NIP sudah terdaftar!');</script>";
    } else {
        mysqli_begin_transaction($conn);
        try {
            mysqli_query($conn, "INSERT INTO users (nama, nip, password, role) VALUES ('$nama', '$nip', '$password', '$role')");
            if ($role === 'dokter') {
                mysqli_query($conn, "INSERT INTO dokter (nip, nama_dokter, poli_dokter, hari, jam) VALUES ('$nip', '$nama', '$poli', '$hari', '$jam')");
            }
            mysqli_commit($conn);
            echo "<script>alert('Berhasil ditambahkan!'); window.location='data_dokter.php';</script>";
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo "<script>alert('Gagal tambah data!');</script>";
        }
    }
}

// 2. Logika Update
if (isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $nip_lama = $_POST['nip_lama'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip_baru = mysqli_real_escape_string($conn, $_POST['nip']);
    $poli = $_POST['poli'];
    $hari = mysqli_real_escape_string($conn, $_POST['hari']) ?: '-';
    $jam = mysqli_real_escape_string($conn, $_POST['jam']) ?: '-';

    mysqli_begin_transaction($conn);
    try {
        mysqli_query($conn, "UPDATE users SET nama='$nama', nip='$nip_baru' WHERE id_user=$id_user");
        
        $cek_dokter = mysqli_query($conn, "SELECT * FROM dokter WHERE nip='$nip_lama'");
        if (mysqli_num_rows($cek_dokter) > 0) {
            mysqli_query($conn, "UPDATE dokter SET nip='$nip_baru', nama_dokter='$nama', poli_dokter='$poli', hari='$hari', jam='$jam' WHERE nip='$nip_lama'");
        } else {
            mysqli_query($conn, "INSERT INTO dokter (nip, nama_dokter, poli_dokter, hari, jam) VALUES ('$nip_baru', '$nama', '$poli', '$hari', '$jam')");
        }
        mysqli_commit($conn);
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='data_dokter.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Gagal update data!');</script>";
    }
}

// Ambil Data untuk Tabel
$result = mysqli_query($conn, "SELECT users.*, dokter.poli_dokter, dokter.hari, dokter.jam FROM users LEFT JOIN dokter ON users.nip = dokter.nip WHERE users.role = 'dokter'");
// Cek apakah ada kata kunci pencarian
$keyword = "";
if (isset($_GET['search'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT users.*, dokter.poli_dokter, dokter.hari, dokter.jam 
              FROM users 
              LEFT JOIN dokter ON users.nip = dokter.nip 
              WHERE users.role = 'dokter' 
              AND (users.nama LIKE '%$keyword%' OR users.nip LIKE '%$keyword%' OR dokter.poli_dokter LIKE '%$keyword%')";
} else {
    $query = "SELECT users.*, dokter.poli_dokter, dokter.hari, dokter.jam 
              FROM users 
              LEFT JOIN dokter ON users.nip = dokter.nip 
              WHERE users.role = 'dokter'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Dokter | AdminPanel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex">
    <?php include '../layout/admin/sidebar.php'?>

    <div class="flex-1 p-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Manajemen Data Dokter</h1>
            <button onclick="resetModalForTambah(); toggleModal();" class="bg-blue-600 text-white px-5 py-2 rounded-xl font-bold hover:bg-blue-700 shadow-lg transition">
                <i class="fas fa-plus mr-2"></i> Tambah Dokter
            </button>
        </div>
        <div class="mb-6 flex justify-end">
            <form action="" method="GET" class="relative">
                <input type="text" name="search" value="<?= $keyword ?>" placeholder="Cari nama, NIP, atau poli..." 
                    class="bg-white border border-slate-200 pl-10 pr-4 py-2 rounded-xl text-sm focus:ring-2 focus:ring-blue-400 outline-none w-64 transition-all">
                <i class="fas fa-search absolute left-3 top-2.5 text-slate-400"></i>
                <?php if($keyword !== ""): ?>
                    <a href="data_dokter.php" class="ml-2 text-xs text-red-500 hover:underline">Reset</a>
                <?php endif; ?>
            </form>
        </div>
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="p-4 text-center">No</th>
                        <th class="p-4">NIP</th>
                        <th class="p-4">Nama Dokter</th>
                        <th class="p-4">Spesialis Poli</th>
                        <th class="p-4">Jadwal</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while($row = mysqli_fetch_assoc($result)) : ?>
                    <tr class="border-b hover:bg-slate-50 transition">
                        <td class="p-4 text-center"><?= $no++; ?></td>
                        <td class="p-4 font-mono text-sm text-slate-600"><?= $row['nip']; ?></td>
                        <td class="p-4 font-semibold text-slate-800"><?= $row['nama']; ?></td>
                        <td class="p-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold border border-blue-200">
                                <?= $row['poli_dokter'] ?? 'Belum Diset'; ?>
                            </span>
                        </td>
                        <td class="p-4 text-sm text-slate-700">
                            <i class="fas fa-clock text-blue-400 mr-1"></i> <?= $row['hari']; ?> (<?= $row['jam']; ?>)
                        </td>
                        <td class="p-4 text-center">
                            <button onclick='editDokter(<?= json_encode($row); ?>)' class="text-emerald-600 hover:text-emerald-800 mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="hapus_dokter.php?id=<?= $row['id_user']; ?>" onclick="return confirm('Hapus data ini?')" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalUtama" class="hidden fixed inset-0 z-50 overflow-auto bg-slate-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-full max-w-md mx-auto rounded-2xl shadow-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modalTitle" class="text-2xl font-bold text-slate-800">Tambah Petugas</h2>
                <button onclick="toggleModal()" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
            </div>

            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="id_user" id="edit_id">
                <input type="hidden" name="nip_lama" id="edit_nip_lama">
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" id="form_nama" class="w-full border p-2.5 rounded-xl bg-slate-50 outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">NIP</label>
                    <input type="text" name="nip" id="form_nip" class="w-full border p-2.5 rounded-xl bg-slate-50 outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div id="passBox">
                    <label class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="form_pass" class="w-full border p-2.5 rounded-xl bg-slate-50 outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Role</label>
                    <select name="role" id="roleSelect" onchange="togglePoli()" class="w-full border p-2.5 rounded-xl bg-slate-50 outline-none">
                        <option value="admin">Admin</option>
                        <option value="dokter">Dokter</option>
                    </select>
                </div>

                <div id="poliBox" class="hidden space-y-4 border-l-4 border-blue-500 pl-4 py-1 bg-blue-50/30 rounded-r-xl">
                    <select name="poli" id="form_poli" class="w-full border p-2.5 rounded-xl bg-white outline-none">
                        <option value="Poli Umum">Poli Umum</option>
                        <option value="Poli Gigi">Poli Gigi</option>
                        <option value="Poli Anak">Poli Anak</option>
                    </select>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="hari" id="form_hari" class="w-full border p-2.5 rounded-xl bg-white" placeholder="Hari (Sen-Jum)">
                        <input type="text" name="jam" id="form_jam" class="w-full border p-2.5 rounded-xl bg-white" placeholder="Jam (08-14)">
                    </div>
                </div>
                
                <div class="flex justify-end pt-4 gap-3">
                    <button type="button" onclick="toggleModal()" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl font-bold">Batal</button>
                    <button type="submit" id="btnSubmit" name="tambah" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('modalUtama');
            modal.classList.toggle('hidden');
        }

        function togglePoli() {
            const role = document.getElementById('roleSelect').value;
            const poliBox = document.getElementById('poliBox');
            role === 'dokter' ? poliBox.classList.remove('hidden') : poliBox.classList.add('hidden');
        }

        function editDokter(data) {
            document.getElementById('modalTitle').innerText = "Edit Data Dokter";
            document.getElementById('btnSubmit').name = "update";
            document.getElementById('btnSubmit').innerText = "Simpan Perubahan";
            document.getElementById('btnSubmit').className = "px-6 py-2 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700";
            
            // Isi form
            document.getElementById('edit_id').value = data.id_user;
            document.getElementById('edit_nip_lama').value = data.nip;
            document.getElementById('form_nama').value = data.nama;
            document.getElementById('form_nip').value = data.nip;
            document.getElementById('roleSelect').value = data.role;
            document.getElementById('form_poli').value = data.poli_dokter || 'Poli Umum';
            document.getElementById('form_hari').value = data.hari || '';
            document.getElementById('form_jam').value = data.jam || '';
            
            document.getElementById('passBox').classList.add('hidden');
            togglePoli();
            toggleModal();
        }

        function resetModalForTambah() {
            document.getElementById('modalTitle').innerText = "Tambah Petugas";
            document.getElementById('btnSubmit').name = "tambah";
            document.getElementById('btnSubmit').innerText = "Simpan";
            document.getElementById('btnSubmit').className = "px-6 py-2 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700";
            document.getElementById('passBox').classList.remove('hidden');
            document.querySelector('form').reset();
            togglePoli();
        }
    </script>
</body>
</html>