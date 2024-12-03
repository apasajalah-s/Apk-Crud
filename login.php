<?php
// Sertakan file koneksi dari kelas pengguna
include_once 'php/Database.php';
include_once 'php/User.php';

// Mulai sesi
session_start();

// Inisialisasi koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek pengguna
$user = new User($db);

// Cek jika form login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan validasi input pengguna
    $user->username = trim(htmlspecialchars($_POST['username']));
    $user->password = trim(htmlspecialchars($_POST['password']));

    // Coba login
    if ($user->login()) {
        header("Location: index.html"); // Redirect ke halaman utama setelah login berhasil
        exit;
    } else {
        echo "Username atau password salah.";
    }
}
