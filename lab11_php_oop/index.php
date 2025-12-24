<?php
session_start();

include "config.php";
include "class/database.php";
include "class/form.php";

// ================= ROUTING =================
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/artikel/index';
$segments = explode('/', trim($path, '/'));

$mod  = $segments[0] ?? 'artikel';
$page = $segments[1] ?? 'index';

// ================= PROTEKSI LOGIN =================
// halaman yang boleh diakses tanpa login
$public_pages = ['user'];

if (!in_array($mod, $public_pages)) {
    if (!isset($_SESSION['is_login'])) {
        header("Location: /lab11_php_oop/user/login");
        exit;
    }
}

// ================= LOAD FILE =================
$file = "module/$mod/$page.php";

// header
include "template/header.php";

// konten
if (file_exists($file)) {
    include $file;
} else {
    echo "<p>Modul tidak ditemukan: $mod/$page</p>";
}

// footer
include "template/footer.php";
