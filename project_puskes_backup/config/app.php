<?php
include 'connect.php';
function query($query) {
    global $db;
    return mysqli_query($db,$query);
}