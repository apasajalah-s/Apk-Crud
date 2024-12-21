<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password = 'pw123456';
    public $hashed_password;

    //Constructor untuk menginisialisasi koneksi database
    public function __construct($db) {
        $this->conn = $db;

        $this->password = 'pw123456';
        $this->hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    //Fungsi untuk login pengguna
    public function login() {
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));

        $stmt->bindParam(':username', $this->username);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                return true;
            }
        }
        return false;
    }
}
?>