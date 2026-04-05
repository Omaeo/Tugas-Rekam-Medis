<?php
include '../config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST['nama']);
    $nip = trim($_POST['nip']);
    $password = trim($_POST['password']);

    // cek admin sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE nip='$nip'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIP sudah digunakan!');</script>";
    } else {

        $query = "INSERT INTO users (nama, nip, password) 
                  VALUES ('$nama', '$nip', '$password')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Register admin berhasil!'); window.location='loginadmind.php';</script>";
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
    <title>Daftar Admin Puskes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-light: #d1e3ff;
            --blue-primary: #89b4f5;
            --dark-blue: #2c5282;
            --text-gray: #718096;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* overflow: hidden; */
            position: relative;
            padding: 20px 0;
        }

        /* Ornamen Lingkaran sesuai desain */
        .circle { position: absolute; border-radius: 50%; background: #2c5282; z-index: 0; }
        .c1 { width: 350px; height: 350px; top: -80px; left: -60px; opacity: 0.4; }
        .c2 { width: 120px; height: 120px; top: 150px; right: 20px; opacity: 0.3; }
        .c3 { width: 180px; height: 180px; bottom: -40px; left: 10%; opacity: 0.2; }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 35px 30px;
            border-radius: 25px;
            width: 100%;
            max-width: 380px;
            z-index: 1;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 { 
            color: #4c6ef5; 
            margin: 0; 
            font-size: 2.8rem; 
            font-weight: 700;
        }

        .subtitle { 
            color: var(--dark-blue); 
            font-size: 0.85rem; 
            margin-bottom: 25px; 
            font-weight: 600; 
        }

        /* Form Styling */
        .form-group { text-align: left; margin-bottom: 15px; }
        
        label { 
            display: block; 
            font-weight: 700; 
            margin-bottom: 6px; 
            color: #1a202c; 
            font-size: 0.95rem;
        }
        
        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #edf2f7;
            border-radius: 10px;
            background-color: #f8fafc;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--blue-primary);
            box-shadow: 0 0 0 3px rgba(137, 180, 245, 0.2);
        }

        /* Button */
        .btn-daftar {
            width: 100%;
            padding: 14px;
            background-color: var(--blue-primary);
            border: none;
            border-radius: 12px;
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-daftar:hover {
            background-color: #76a3e6;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer { 
            margin-top: 25px; 
            font-size: 0.9rem; 
            font-weight: 600;
            color: #1a202c;
        }

        .footer a { 
            color: #0056ff; 
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <div class="circle c1"></div>
    <div class="circle c2"></div>
    <div class="circle c3"></div>

    <div class="card">
        <h1>Daftar</h1>
        <p class="subtitle">Daftar Untuk mengunjungi Admin Puskes</p>

        <form action="#" method="POST">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama" required>
            </div>

            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" placeholder="Masukkan Nomor NIP" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" required>
            </div>

            <button type="submit" class="btn-daftar">daftar</button>
            <p class="footer-text">
                Sudah punya akun? <a href="loginadmind.php">Login Sekarang</a>
            </p>
        </form>
    </div>
</body>
</html>