<?php
session_start();
include 'Database.php';

if (!isset($_SESSION['username'])) {
    header("Location: login_form.html");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login_form.html");
}