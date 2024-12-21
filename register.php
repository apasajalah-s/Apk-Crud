<?php
include_once 'php/Database.php';
include_once 'php/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->username = $_POST['username'];
    $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    if ($user->register()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: Username might already exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</body>

</html>