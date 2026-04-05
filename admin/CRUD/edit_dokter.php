<?php
include '../../config/app.php';

$nip = $_GET['nip'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM dokter WHERE nip='$nip'"));

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $poli = $_POST['poli'];

    mysqli_query($conn, "UPDATE dokter SET 
        nama='$nama',
        password='$password',
        poli='$poli'
        WHERE nip='$nip'
    ");

    header("Location: ../data_dokter.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Dokter</title>

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

/* MAIN AREA */
.main {
    margin-left: 260px;
    min-height: 100vh;
    position: relative;
}

/* CENTER CONTAINER */
.edit-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* CARD (OVERLAY PANEL) */
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

/* BACKGROUND DECOR */
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

<!-- MAIN CONTENT -->
<div class="main">

    <div class="edit-container">

        <div class="card">

            <!-- BACK BUTTON -->
            <a href="../data_dokter.php" class="back-btn">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

            <h2>Edit Dokter</h2>

            <form method="POST">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" value="<?= $data['password']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Poli</label>
                    <select name="poli" required>
                        <option value="Poli Umum" <?= ($data['poli']=='Poli Umum')?'selected':''; ?>>Poli Umum</option>
                        <option value="Poli Gigi" <?= ($data['poli']=='Poli Gigi')?'selected':''; ?>>Poli Gigi</option>
                        <option value="Poli Anak" <?= ($data['poli']=='Poli Anak')?'selected':''; ?>>Poli Anak</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn">Update</button>

            </form>

        </div>

    </div>

</div>

</body>
</html>