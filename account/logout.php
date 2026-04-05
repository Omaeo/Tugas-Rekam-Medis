<?php
session_start();
session_destroy();

header("Location: /Tugas-Rekam-Medis/account/loginadmind.php");
exit;
?>