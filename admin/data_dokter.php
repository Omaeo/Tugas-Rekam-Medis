<?php
include '../config/app.php';

$query = mysqli_query($conn, "SELECT * FROM dokter");
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

.container {
    display: flex;
    height: 100vh;
}

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

.main {
    flex: 1;
    display: flex;
    flex-direction: column;
}

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

.content {
    padding: 25px;
}

.table-container {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    overflow-x: auto;
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

.badge {
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: bold;
    font-size: 12px;
}

.badge.done { background: #e6f7d4; color: #52c41a; }
.badge.wait { background: #fffbe6; color: #faad14; }
.badge.cancel { background: #fff1f0; color: #f5222d; }

.styled-table tbody tr:hover {
    background-color: #fcfdfe;
}

.fab {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #6c8cff;
    color: white;
    font-size: 30px;
    border-radius: 50%;
    text-align: center;
    line-height: 60px;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: 0.3s;
}

.fab:hover {
    background: #4cafef;
    transform: scale(1.1);
}
</style>
</head>
<body>

<div class="container">

<?php include('../layout/admin/sidebar.php'); ?>

<div class="main" style="margin-left: 260px; padding: 20px;">

<div class="navbar">
    <h2 id="title">Dokter</h2>
    <i class="fa fa-bell"></i>
</div>

<div class="content">

<div class="card-row" style="margin-bottom: 25px;">
    <div class="card" style="text-align: left; padding: 15px 25px; display: flex; align-items: center; gap: 20px;">
        <i class="fa fa-users" style="font-size: 30px; color: #6c8cff;"></i>
        <div>
            <h2 style="color: #2b3674;">Daftar Dokter Puskes</h2>
        </div>
    </div>
</div>

<div class="table-container">
<table class="styled-table">
<thead>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIP</th>
    <th>Poli</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php 
$no = 1;
while($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['nama']; ?></td>
    <td><?= $data['nip']; ?></td>
    <td><?= $data['poli']; ?></td>
    <td>
        <a href="CRUD/edit_dokter.php?nip=<?= $data['nip']; ?>" style="color:blue;">Edit</a> |
        <a href="CRUD/hapus_dokter.php?nip=<?= $data['nip']; ?>" 
        onclick="return confirm('Yakin hapus?')" 
        style="color:red;">
        Hapus
        </a>
    </td>
</tr>

<?php } ?>

</tbody>
</table>
</div>

</div>
</div>

</div>

<a href="CRUD/tambah_dokter.php" class="fab">+</a>

</body>
</html>