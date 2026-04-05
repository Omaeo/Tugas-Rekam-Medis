<?php
$conn = mysqli_connect("localhost", "root", "", "db_rekam_medis");

// tanggal hari ini
$today = date('Y-m-d');

// total pasien hari ini
$queryTotal = mysqli_query($conn, "SELECT COUNT(*) as total FROM pasien WHERE tanggal='$today'");
$dataTotal = mysqli_fetch_assoc($queryTotal);
$totalPasien = $dataTotal['total'];

// ambil data pasien untuk tabel
$query = mysqli_query($conn, "SELECT * FROM pasien ORDER BY tanggal DESC");

// cek error query
if (!$query) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Puskes</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #eef2f7;
}

/* LAYOUT */
.container {
    display: flex;
    height: 100vh;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    background: linear-gradient(180deg, #6c8cff, #4cafef);
    color: white;
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.logo {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 30px;
}

/* MENU */
.menu {
    list-style: none;
    flex: 1;
}

.menu li {
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.menu li:hover,
.menu li.active {
    background: rgba(255,255,255,0.2);
}

.menu i {
    margin-right: 10px;
}

/* PROFILE */
.profile-box {
    background: rgba(255,255,255,0.15);
    padding: 15px;
    border-radius: 12px;
    text-align: center;
    margin-top: 20px;
}

.profile-box i {
    font-size: 45px;
    margin-bottom: 8px;
}

.profile-box p {
    font-weight: bold;
}

/* LOGOUT */
.logout {
    margin-top: 20px;
    background: #ff4d4d;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.logout:hover {
    background: #e60000;
}

/* MAIN */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* NAVBAR ATAS */
.navbar {
    background: white;
    padding: 15px 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar h2 {
    font-size: 20px;
}

/* CONTENT */
.content {
    padding: 25px;
}

/* CARDS */
.table-container {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow-x: auto; /* Agar tabel bisa di-scroll jika layar kecil */
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        text-align: left;
    }

    .styled-table thead tr {
        border-bottom: 2px solid #eef2f7;
    }

    .styled-table th {
        padding: 15px 10px;
        color: #888;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
    }

    .styled-table td {
        padding: 15px 10px;
        border-bottom: 1px solid #f8f9fa;
        color: #333;
    }

    /* Warna Status Badge */
    .badge {
        padding: 5px 12px;
        border-radius: 6px;
        font-weight: bold;
        font-size: 12px;
    }

    .badge.diterima { background: #e6f7d4; color: #52c41a; }
    .badge.dikirim { background: #fffbe6; color: #faad14; }
    .badge.ditolak { background: #fff1f0; color: #f5222d; }

    /* Efek baris saat di-hover */
    .styled-table tbody tr:hover {
        background-color: #fcfdfe;
    }
</style>
</head>
<body>

<div class="container">

     <!-- sidebar -->
     <?php include('../layout/admin/sidebar.php'); ?>


    <!-- ===== BAGIAN UTAMA ===== -->
    <div class="main" style="margin-left: 260px; padding: 20px;">

        <!-- Navbar Atas -->
        <div class="navbar">
            <h2 id="title">Pasien</h2>
            <i class="fa fa-bell"></i>
        </div>

        <!-- Isi Konten -->
        <div class="content">

                <div class="card-row" style="margin-bottom: 25px;">
                    <div class="card" style="text-align: left; padding: 15px 25px; display: flex; align-items: center; gap: 20px;">
                        <i class="fa fa-users" style="font-size: 30px; color: #6c8cff;"></i>
                        <div>
                            <h4 style="color: #888; font-size: 14px;">Total Pasien Hari Ini</h4>
                        <?php
                        $total = mysqli_num_rows($query);
                        ?>
                       <h2 style="color: #2b3674;"><?= $totalPasien ?> Pasien</h2>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>No. Rujukan</th>
                                <th>Nama</th>
                                <th>No. BPJS</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                            <td><?= str_pad($row['nomor'], 6, "0", STR_PAD_LEFT); ?></td>
                            <td><b><?= $row['nama']; ?></b></td>
                            <td><?= $row['bpjs']; ?></td>
                            <td><?= $row['poli']; ?></td>
                            <td><?= $row['tanggal']; ?></td>
                        <td><span class="badge diterima">Masuk</span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>

            </div>
    </div>

</div>

</body>
</html>