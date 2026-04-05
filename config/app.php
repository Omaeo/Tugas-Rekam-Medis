<?php
include 'connect.php';
function query($query) {
    global $db;
    return mysqli_query($db,$query);
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}