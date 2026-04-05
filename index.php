<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskes - Selamat Datang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-blue: #d1e3ff;
            --dark-blue: #1a3a5f;
            --text-blue: #2c5282;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-blue);
            /* Kalau punya gambar wave, ganti url di bawah */
            background-image: linear-gradient(135deg, #e0eaff 0%, #bbd2ff 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            text-align: center;
            z-index: 2;
        }

        .logo-area img {
            width: 80px; /* Sesuaikan ukuran logo hati */
            margin-bottom: 10px;
        }

        h1 {
            color: var(--dark-blue);
            font-size: 3rem;
            margin: 0;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        .subtitle {
            color: var(--text-blue);
            font-weight: 600;
            margin-bottom: 40px;
        }

        .subtitle span {
            color: #5a67d8;
        }

        /* Card Pilihan */
        .selection-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 25px;
            padding: 40px;
            display: flex;
            gap: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .role-option {
            text-decoration: none;
            color: var(--text-blue);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 150px;
        }

        .role-option:hover {
            transform: translateY(-10px);
        }

        .role-option img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
            object-fit: contain;
        }

        .role-option p {
            font-weight: 700;
            font-size: 0.9rem;
            line-height: 1.2;
        }

        /* Hiasan Lingkaran biar mirip desain */
        .circle {
            position: absolute;
            background: rgba(44, 82, 130, 0.1);
            border-radius: 50%;
            z-index: 1;
        }
        .c1 { width: 400px; height: 400px; top: -80px; left: 80px; }
        .c2 { width: 200px; height: 200px; bottom: -50px; right: 10%; }
        .c3 {width: 100px; height: 100px; }
    </style>
</head>
<body>
    <div class="circle c1"></div>
    <div class="circle c2"></div>
    <div class="circle c3"></div>

    <div class="container">
        <div class="logo-area">
            <i class="fas fa-heart-pulse" style="font-size: 60px; color: #5a67d8; margin-bottom: 15px;"></i>
        </div>
        <h1>Puskes</h1>
        <p class="subtitle">Melayani dengan <span>Sepenuh Hati</span></p>

        <div class="selection-card">
            <a href="account/login_admin.php" class="role-option">
                <img src="https://cdn-icons-png.flaticon.com/512/2328/2328966.png" alt="Admin">
                <p>Masuk Sebagai Admin</p>
            </a>

            <a href="account/login.php" class="role-option">
                <img src="https://cdn-icons-png.flaticon.com/512/1256/1256650.png" alt="User">
                <p>Masuk Sebagai User</p>
            </a>
        </div>
    </div>
</body>
</html>