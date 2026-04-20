<?php
include '../config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil data dari form
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $bpjs = mysqli_real_escape_string($conn, $_POST['Nomorbpjs']);
    
    // 2. Hash Password (Keamanan Standar)
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // 3. Logika Role (Default adalah user/pasien)
    $role = 'user'; 

    // 4. Proses Simpan ke Database
    // Gunakan transaksi agar data masuk ke tabel users dan pasien sekaligus
    mysqli_begin_transaction($conn);

    try {
        // Simpan ke tabel users
        $queryUser = "INSERT INTO users (nama, password, role, bpjs, alamat) VALUES (?, ?, ?, ?, ?)";
        $stmt1 = mysqli_prepare($conn, $queryUser);
        mysqli_stmt_bind_param($stmt1, "sssss", $nama, $password, $role, $bpjs, $alamat);
        mysqli_stmt_execute($stmt1);

        // Simpan ke tabel pasien (agar terdaftar di sistem medis)
        $queryPasien = "INSERT INTO pasien (nomor_bpjs, nama_pasien, alamat) VALUES (?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $queryPasien);
        mysqli_stmt_bind_param($stmt2, "sss", $bpjs, $nama, $alamat);
        mysqli_stmt_execute($stmt2);

        mysqli_commit($conn);
        echo "<script>alert('Berhasil mendaftar sebagai Pasien!'); window.location='login.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Website Puskes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Pakai style kamu yang tadi di sini */
        :root { --primary-blue: #89b4f5; --dark-blue: #2c5282; --bg-light: #e0e7ff; --gray-icon: #a0aec0; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: var(--bg-light); min-height: 100vh; display: flex; justify-content: center; align-items: center; }
        .circle { position: absolute; border-radius: 50%; background: linear-gradient(135deg, #5c7c9c, #2c5282); z-index: 0; opacity: 0.7; }
        .c1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .c2 { width: 150px; height: 150px; top: 150px; left: 180px; opacity: 0.4; }
        .c3 { width: 200px; height: 200px; bottom: -40px; right: -30px; }
        .login-container { z-index: 1; text-align: center; width: 100%; max-width: 400px; padding: 20px; }
        h1 { color: var(--dark-blue); font-size: 3rem; margin-bottom: 5px; font-weight: 700; }
        .login-card { background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 40px 30px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); }
        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-weight: 700; margin-bottom: 8px; color: #000; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper i.main-icon { position: absolute; left: 15px; color: var(--gray-icon); }
        .input-wrapper input { width: 100%; padding: 12px 15px 12px 45px; border: 1px solid #eee; border-radius: 10px; background-color: #fcfcfc; box-sizing: border-box; }
        .toggle-password { position: absolute; right: 15px; cursor: pointer; color: var(--gray-icon); }
        .btn-login { width: 100%; padding: 15px; background-color: var(--primary-blue); border: none; border-radius: 12px; color: var(--dark-blue); font-weight: 700; cursor: pointer; margin-top: 20px; }
        .footer-text { margin-top: 30px; font-weight: 600; }
        .footer-text a { color: #0056ff; }
    </style>
</head>
<body>
    <div class="circle c1"></div><div class="circle c2"></div><div class="circle c3"></div>

    <div class="login-container">
        <h1>Register</h1>
        <div class="login-card">
            <form method="POST">
                <div class="form-group">
                    <label>Nomor BPJS</label>
                    <div class="input-wrapper">
                        <i class="fas fa-id-card main-icon"></i>
                        <input type="text" name="Nomorbpjs" placeholder="Contoh: 000123456" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user main-icon"></i>
                        <input type="text" name="nama" placeholder="Masukkan Nama" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-wrapper">
                        <i class="fas fa-home main-icon"></i>
                        <input type="text" name="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock main-icon"></i>
                        <input type="password" name="password" id="passwordInput" placeholder="Minimal 8 Karakter" required>
                        <i class="fas fa-eye toggle-password" id="toggleIcon"></i>
                    </div>
                </div>
                <button type="submit" class="btn-login">Daftar Sekarang</button>
            </form>
            <p class="footer-text">Sudah punya akun? <a href="login.php">Login Sekarang</a></p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');
        toggleIcon.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>