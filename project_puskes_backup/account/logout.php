<?php
// account/logout.php

session_start();

// 1. Hapus semua variabel session
$_SESSION = [];

// 2. Hancurkan session
session_unset();
session_destroy();

// 3. Hapus Cookie Session (Bawaan PHP)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. PENTING: Hapus Cookie "Remember Me" (id dan key)
// Kita set waktunya ke masa lalu (time() - 3600) agar browser langsung menghapusnya
if (isset($_COOKIE['id'])) {
    setcookie('id', '', time() - 3600, '/');
    setcookie('key', '', time() - 3600, '/');
}

// 5. Lempar balik ke halaman utama (Landing Page Pilihan)
header("Location: ../index.php");
exit;
?>