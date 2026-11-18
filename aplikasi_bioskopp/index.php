<?php
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['id_user'])) {
    header("Location: view/v_home.php");
    exit();
}

// Jika sudah login, arahkan sesuai role-nya
if ($_SESSION['role'] == 'admin') {
    header("Location: view/v_home_admin.php");
} else {
    header("Location: view/v_home_user.php");
}
exit();
