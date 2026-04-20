<?php
session_start();
include '../config/connect.php';

// A. CEK COOKIE (Login Otomatis)
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['nama'])) {
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['alamat'] = $row['alamat'];
    }
}

// B. CEK SESSION (Jika sudah login, lempar ke halaman yang sesuai)
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
    } elseif ($_SESSION['role'] === 'dokter') {
        header("Location: ../dokter/dashboard.php");
    } else {
        header("Location: ../home.php");
    }
    exit;
}

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = mysqli_real_escape_string($conn, $_POST['nama']); // Input bisa Nama/NIP/BPJS
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan Nama OR NIP OR BPJS
    $query = "SELECT * FROM users WHERE nama = ? OR nip = ? OR bpjs = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $identifier, $identifier, $identifier);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if ($password === $user['password']) {
            // Set Session
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['bpjs'] = $user['bpjs']; 
            $_SESSION['nip'] = $user['nip'];
            $_SESSION['alamat'] = $user['alamat'];


            // C. LOGIKA REMEMBER ME
            if (isset($_POST['remember'])) {
                setcookie('id', $user['id_user'], time() + (60 * 60 * 24 * 7), '/');
                setcookie('key', hash('sha256', $user['nama']), time() + (60 * 60 * 24 * 7), '/');
            }

            // D. REDIRECT BERDASARKAN ROLE
            if ($user['role'] === 'admin') {
                header("Location: ../admin/home_admin.php");
            } elseif ($user['role'] === 'dokter') {
                header("Location: ../dokter/dashboard.php");
            } else {
                header("Location: ../home.php");
            }
            exit;
        } else {
            $error_msg = "Password salah!";
        }
    } else {
        $error_msg = "Akun tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Website Puskes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #89b4f5; --dark-blue: #2c5282; --bg-light: #e0e7ff; --gray-icon: #a0aec0; }
        body { margin: 0; padding: 0; font-family: 'Poppins', sans-serif; background: var(--bg-light); min-height: 100vh; display: flex; justify-content: center; align-items: center; position: relative; padding: 20px 0; }
        .circle { position: absolute; border-radius: 50%; background: linear-gradient(135deg, #5c7c9c, #2c5282); z-index: 0; opacity: 0.7; }
        .c1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .c2 { width: 150px; height: 150px; top: 150px; left: 180px; opacity: 0.4; }
        .c3 { width: 200px; height: 200px; bottom: -40px; right: -30px; }
        .login-container { z-index: 1; text-align: center; width: 100%; max-width: 400px; padding: 20px; }
        h1 { color: var(--dark-blue); font-size: 3rem; margin-bottom: 5px; font-weight: 700; }
        p.subtitle { color: var(--dark-blue); font-weight: 600; margin-bottom: 30px; }
        .login-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px 30px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); }
        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-weight: 700; margin-bottom: 8px; color: #000; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper i.main-icon { position: absolute; left: 15px; color: var(--gray-icon); }
        .input-wrapper input { width: 100%; padding: 12px 15px 12px 45px; border: 1px solid #eee; border-radius: 10px; background-color: #fcfcfc; box-sizing: border-box; font-family: inherit; transition: all 0.3s ease; }
        .toggle-password { position: absolute; right: 15px; cursor: pointer; color: var(--gray-icon); transition: color 0.3s; }
        input:focus { outline: none; border-color: var(--primary-blue); box-shadow: 0 0 8px rgba(137, 180, 245, 0.4); }
        .btn-login { width: 100%; padding: 15px; background-color: var(--primary-blue); border: none; border-radius: 12px; color: var(--dark-blue); font-weight: 700; font-size: 1.1rem; cursor: pointer; margin-top: 20px; transition: all 0.3s ease; }
        .btn-login:hover { background-color: #76a3e6; transform: translateY(-2px); }
        .footer-text { margin-top: 30px; font-weight: 600; font-size: 0.9rem; }
        .footer-text a { color: #0056ff; text-decoration: underline; }
        .alert-error { background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; font-weight: 600; border: 1px solid #f87171; }
    </style>
</head>
<body>

    <div class="circle c1"></div>
    <div class="circle c2"></div>
    <div class="circle c3"></div>

    <div class="login-container">
        <h1>Login</h1>
        <p class="subtitle">Masuk Untuk mengunjungi Website Puskes</p>

        <div class="login-card">
            <?php if ($error_msg != ""): ?>
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama / NIP / BPJS</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user main-icon"></i>
                        <input type="text" name="nama" placeholder="Masukkan Nama, NIP, atau BPJS" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock main-icon"></i>
                        <input type="password" name="password" id="passwordInput" placeholder="Masukkan Password" required>
                        <i class="fas fa-eye toggle-password" id="toggleIcon"></i>
                    </div>
                </div>
                
                <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="remember" id="remember" style="width: auto;">
                    <label for="remember" style="margin-bottom: 0; cursor: pointer; font-size: 0.85rem;">Ingat Saya</label>
                </div>
                
                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <p class="footer-text">
                Belum punya akun? <a href="register.php">Register Sekarang</a>
            </p>
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