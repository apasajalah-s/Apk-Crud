<?php

class User {
private $conn;
public $username;
public $password;

public function __construct($db) {
$this->conn = $db;
}

public function login() {
// Query untuk memeriksa apakah username dan password cocok
$query = "SELECT * FROM users WHERE username = :username AND password = :password";

// Siapkan pernyataan
$stmt = $this->conn->prepare($query);

// Bind parameter
$stmt->bindParam(":username", $this->username);
$stmt->bindParam(":password", $this->password); // Jangan lupa hash password di sini untuk keamanan

// Eksekusi pernyataan
$stmt->execute();

// Jika ditemukan hasil, berarti login berhasil
if($stmt->rowCount() > 0) {
return true;
}
return false;
}
}


