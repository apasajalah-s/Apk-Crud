<?php
//koneksi ke database 
include_once 'php/Database.php';
include_once 'php/User.php';

session_start();
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()){
        header("Location: login_form.html");
    } else {
        echo "Invalid username or password";
    }
}