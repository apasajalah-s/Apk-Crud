<?php
// Mulai sesi
session_start();

//hapus semua data sesi
session_unset();
session_destroy();

//redirect ke halaman login
header("Location: login_form.html");
exit;
?>