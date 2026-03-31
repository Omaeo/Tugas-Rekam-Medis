<?php
$conn = mysqli_connect("localhost", "root", "", "db_rekam_medis");

if (!$conn) {
    die("Koneksi gagal");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bpjs = trim($_POST['Nomorbpjs']);
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $password = trim($_POST['password']);

    // cek user sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE nama='$nama'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Nama sudah digunakan!');</script>";
    } else {

        $query = "INSERT INTO users (bpjs, nama, alamat, password) 
                  VALUES ('$bpjs', '$nama', '$alamat', '$password')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Register berhasil!'); window.location='login.php';</script>";
        } else {
            echo "Register gagal: " . mysqli_error($conn);
        }
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
        :root {
            --primary-blue: #89b4f5;
            --dark-blue: #2c5282;
            --bg-light: #e0e7ff;
            --gray-icon: #a0aec0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Ornamen Lingkaran */
        .circle { position: absolute; border-radius: 50%; background: linear-gradient(135deg, #5c7c9c, #2c5282); z-index: 0; opacity: 0.7; }
        .c1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .c2 { width: 150px; height: 150px; top: 150px; left: 180px; opacity: 0.4; }
        .c3 { width: 200px; height: 200px; bottom: -40px; right: -30px; }

        .login-container { z-index: 1; text-align: center; width: 100%; max-width: 400px; padding: 20px; }
        h1 { color: var(--dark-blue); font-size: 3rem; margin-bottom: 5px; font-weight: 700; }
        p.subtitle { color: var(--dark-blue); font-weight: 600; margin-bottom: 30px; }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-weight: 700; margin-bottom: 8px; color: #000; }

        /* Input Container untuk Ikon */
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i.main-icon {
            position: absolute;
            left: 15px;
            color: var(--gray-icon);
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #eee;
            border-radius: 10px;
            background-color: #fcfcfc;
            box-sizing: border-box;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        /* Ikon Mata (Toggle) */
        .toggle-password {
            position: absolute;
            right: 15px;
            cursor: pointer;
            color: var(--gray-icon);
            transition: color 0.3s;
        }

        .toggle-password:hover { color: var(--dark-blue); }

        input:focus { outline: none; border-color: var(--primary-blue); box-shadow: 0 0 8px rgba(137, 180, 245, 0.4); }

        .btn-login {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-blue);
            border: none;
            border-radius: 12px;
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-login:hover { background-color: #76a3e6; transform: translateY(-2px); }

        .footer-text { margin-top: 30px; font-weight: 600; font-size: 0.9rem; }
        .footer-text a { color: #0056ff; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="circle c1"></div>
    <div class="circle c2"></div>
    <div class="circle c3"></div>

    <div class="login-container">
        <h1>Register</h1>
        <p class="subtitle">Daftar Untuk mengunjungi Website Puskes</p>

        <div class="login-card">
            <form method="POST">

                <div class="form-group">
                    <label>Nomor BPJS</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user main-icon"></i>
                        <input type="text" name="Nomorbpjs" placeholder="Masukkan Nomor BPJS Lengkap" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user main-icon"></i>
                        <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-wrapper">
                        <i class="fas fa-home main-icon"></i>
                        <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap" required>
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

                <button type="submit" class="btn-login">Daftar Sekarang</button>
            </form>

            <p class="footer-text">
                Sudah punya akun? <a href="login.php">Login Sekarang</a>
            </p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');

        toggleIcon.addEventListener('click', function () {
            // Toggle tipe input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle ikon mata
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>