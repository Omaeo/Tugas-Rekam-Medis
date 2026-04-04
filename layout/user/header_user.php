<?php
session_start();
if (!isset($_SESSION['login']))
    header("location:account/login.php");
include __DIR__ . '/../../config/app.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Navbar Puskes</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #e8f1ff;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #e0eaff;
            padding: 15px calc((100% - 1100px) / 2);
            /* box-shadow: 0 2px 5px rgba(0,0,0,0.05); */
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            background-color: transparent; 
            transition: all 0.3s ease-in-out;
        }
        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 50px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        /* Bagian Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            background-color: #000;
            color: #fff;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .logo img { height: 45px; transition: 0.3s; }
        .logo img:hover { transform: scale(1.05); }


        /* Bagian Menu Navigasi */
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links li a {
            text-decoration: none;
            color: #7d8da1;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-links li a.active {
            color: #2c5282;
            border-bottom: 2px solid #2c5282;
            padding-bottom: 5px;
        }

        /* Bagian Kanan (Notif & User) */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .notif-icon {
            font-size: 20px;
            color: #000;
            cursor: pointer;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .avatar {
            width: 35px;
            height: 35px;
            background-color: #c4d9ff;
            border-radius: 50%;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .username {
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .dropdown-icon {
            font-size: 12px;
            color: #4a5568;
        }
        /* Container Notifikasi */
        .notif-wrapper {
            position: relative;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .notif-wrapper:hover {
            transform: scale(1.1);
        }

        /* Badge Merah Notifikasi */
        .notif-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4d4f; /* Warna merah notif */
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 10px;
            border: 2px solid #fff; /* Biar ada garis putih pemisah */
        }

        /* User Profile Styling */
        .user-profile {
            position: relative; /* Penting untuk dropdown */
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 12px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .user-profile:hover {
            background-color: rgba(44, 82, 130, 0.05); /* Efek highlight halus pas dihover */
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-role {
            font-size: 11px;
            color: #a0aec0;
            margin-top: -2px;
        }

        /* Dropdown Menu - Sembunyi secara default */
        .profile-dropdown {
            position: absolute;
            top: 120%;
            right: 0;
            background: white;
            min-width: 180px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: 0.3s;
            z-index: 1100;
        }

        .user-profile:hover .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            text-decoration: none;
            color: #4a5568;
            font-size: 14px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .profile-dropdown a:hover {
            background-color: #f7fafc;
            color: #2c5282;
        }

        .profile-dropdown hr {
            border: 0;
            border-top: 1px solid #edf2f7;
            margin: 8px 0;
        }

        .profile-dropdown a.logout {
            color: #e53e3e;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <a href="home.php"><img src="assets/img/logo_puskes.png" alt="puskes_logo"></a>
        </div>

        <ul class="nav-links">
            <li><a href="home.php" class="active">Beranda</a></li>
            <li><a href="#jadwal">Jadwal Dokter</a></li>
            <li><a href="informasi/informasi.php">informasi</a></li>
        </ul>

        <div class="nav-right">

            <!--
                <div class="notif-wrapper">
                    <i class="fas fa-bell notif-icon"></i>
                    <div class="notif-badge">3</div>
            -->

            <div class="user-profile">
                <div class="avatar">
                    <img src="https://ui-avatars.com/api/?name=Levan&background=c4d9ff&color=2c5282" alt="Profile">
                </div>
                <div class="user-info">
                    <span class="username">
                    <?= isset($_SESSION['nama']) ? $_SESSION['nama'] : ''; ?>
                     </span>
                    <small class="user-role">Pasien</small> </div>
                <i class="fas fa-chevron-down dropdown-icon"></i>
                
                <div class="profile-dropdown">
                    <a href="#"><i class="fas fa-user"></i> Profil Saya</a>
                    <hr>
                    <a href="account/register.php" class="logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                </div>
            </div>
        </div>
    </nav>

</body>
<script>
    // Ambil URL halaman yang sedang aktif
    const currentPath = window.location.pathname;
    
    // Ambil semua link di navbar
    const navLinks = document.querySelectorAll('.nav-links a');

    navLinks.forEach(link => {
        // Hapus dulu class active bawaan (biar bersih)
        link.classList.remove('active');

        // Jika attribute href pada link ada di dalam URL saat ini
        // Contoh: jika URL mengandung 'jadwal_dokter.php'
        if (currentPath.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });

    // Default: Jika di root atau home, pastikan Beranda tetap aktif
    if (currentPath.endsWith('/') || currentPath.includes('home.php')) {
        document.querySelector('a[href="home.php"]').classList.add('active');
    }
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        
        // Jika scroll lebih dari 50px, tambahkan class 'scrolled'
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
</html>