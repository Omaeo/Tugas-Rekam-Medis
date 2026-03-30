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
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 99;
    border-bottom: 1px solid #e0e6ed;
}
.nav-items i {
    font-size: 20px;
    color: #6c8cff;
    cursor: pointer;
    transition: 0.3s;
}

.nav-items i:hover {
    color: #4cafef;
}

.navbar h2 {
    font-size: 20px;
}

/* CONTENT */
.content {
    padding: 25px;
}

/* CARDS */
.cards {
    display: flex;
    gap: 20px;
}

.card {
    flex: 1;
    padding: 25px;
    border-radius: 15px;
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    position: relative;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card.poli {
    background: linear-gradient(135deg, #ffffff, #e6f7d4);
}

.card.pasien {
    background: linear-gradient(135deg, #ffffff, #d4f1ff);
    text-align: center;
}

.card h3 {
    margin-bottom: 15px;
}

.status {
    margin: 8px 0;
}

.aktif {
    color: green;
    font-weight: bold;
}

.nonaktif {
    color: red;
    font-weight: bold;
}

.big-icon {
    font-size: 60px;
    margin: 20px 0;
}

.corner {
    position: absolute;
    bottom: 10px;
    right: 10px;
    opacity: 0.4;
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
            <h2 id="title">Dashboard</h2>
        </div>

        <!-- Isi Konten -->
        <div class="content">

            <div class="cards">

                <!-- Card Poliklinik -->
                <div class="card poli">
                    <h3>Poliklinik</h3>

                    <p>Poli Umum : <span class="aktif">Aktif</span></p>
                    <p>Poli Mata : <span class="aktif">Aktif</span></p>
                    <p>Poli Telinga : <span class="aktif">Aktif</span></p>
                    <p>Poli Gigi : <span class="nonaktif">Non-Aktif</span></p>
                </div>

                <!-- Card Pasien -->
                <div class="card pasien">
                    <h3>Pasien Hari Ini</h3>
                    <i class="fa fa-user-group big-icon"></i>
                    <h2>56 Pasien</h2>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>