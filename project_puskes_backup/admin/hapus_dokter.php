<?php
include '../config/connect.php';

$id = $_GET['id'];

// Ambil NIP dulu sebelum dihapus dari users
$user = mysqli_query($conn, "SELECT nip FROM users WHERE id_user = $id");
$data = mysqli_fetch_assoc($user);
$nip = $data['nip'];

mysqli_begin_transaction($conn);
try {
    // 1. Hapus dari tabel dokter dulu (karena ada relasi)
    mysqli_query($conn, "DELETE FROM dokter WHERE nip = '$nip'");
    
    // 2. Baru hapus dari tabel users
    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");

    mysqli_commit($conn);
    echo "<script>alert('Data Terhapus!'); window.location='data_dokter.php';</script>";
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "<script>alert('Gagal Hapus Data!'); window.location='data_dokter.php';</script>";
}
?>