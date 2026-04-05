<?php
include '../../config/app.php';

if (isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $poli = $_POST['poli'];

    mysqli_query($conn, "INSERT INTO dokter (nip, nama, poli)
        VALUES ('$nip', '$nama', '$poli')
    ");

    header("Location: ../data_dokter.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Dokter</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #eef2f7;
    font-family: 'Segoe UI', sans-serif;
}

/* SIDEBAR FIX */
.sidebar {
    position: fixed;
    z-index: 1000;
    width: 260px;
    left: 0;
    top: 0;
}

/* MAIN */
.main {
    margin-left: 260px;
    min-height: 100vh;
    position: relative;
}

/* CENTER */
.edit-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* CARD */
.card {
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    width: 420px;
    position: relative;
    z-index: 2;
    animation: fadeIn 0.4s ease;
}

/* DECOR */
.main::before {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #6c8cff, #4cafef);
    border-radius: 50%;
    top: 60px;
    right: 100px;
    opacity: 0.2;
    z-index: 0;
}

/* TITLE */
h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #2b3674;
}

/* FORM */
.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}

input, select {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
    transition: 0.3s;
}

input:focus, select:focus {
    border-color: #6c8cff;
    box-shadow: 0 0 6px rgba(108,140,255,0.3);
}

/* BUTTON */
.btn {
    background: #6c8cff;
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 10px;
    transition: 0.3s;
}

.btn:hover {
    background: #4cafef;
    transform: translateY(-2px);
}

/* BACK BUTTON */
.back-btn {
    display: inline-block;
    margin-bottom: 15px;
    color: #6c8cff;
    text-decoration: none;
    font-weight: 600;
}

.back-btn:hover {
    text-decoration: underline;
}

/* ANIMATION */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<?php include('../../layout/admin/sidebar.php'); ?>

<!-- MAIN -->
<div class="main">

    <div class="edit-container">

        <div class="card">

            <!-- BACK -->
            <a href="../data_dokter.php" class="back-btn">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

            <h2>Tambah Dokter</h2>

            <form method="POST">

                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="nip" required>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" required>
                </div>

                <div class="form-group">
                    <label>Poli</label>
                    <select name="poli" required>
                        <option value="">-- Pilih Poli --</option>
                        <option value="Poli Umum">Poli Umum</option>
                        <option value="Poli Gigi">Poli Gigi</option>
                        <option value="Poli Anak">Poli Anak</option>
                        <option value="Poli Lansia">Poli Lansia</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn">
                    <i class="fa fa-plus"></i> Tambah Dokter
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>