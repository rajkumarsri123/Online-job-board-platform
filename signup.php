<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Debugging


$sql = "CREATE TABLE IF NOT EXISTS signup (
    id int(6) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    email VARCHAR(25) UNIQUE NOT NULL,
    passwrd CHAR(255) NOT NULL
)";
mysqli_query($conn, $sql);

$insertstmt = mysqli_prepare($conn, "INSERT INTO signup (username, email, passwrd) VALUES (?, ?, ?)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $password = mysqli_real_escape_string($conn, $_POST["Password"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($insertstmt, "sss", $username, $email, $hashedPassword);
    mysqli_stmt_execute($insertstmt);
    $sql="SELECT id FROM signup WHERE email=$email";
    $id=mysqli_query($conn, $sql);
    $_SESSION["username"]=$username;
    $_SESSION["id"]=$id;
    $_SESSION["email"]=$email;
}

mysqli_stmt_close($insertstmt);
mysqli_close($conn);
?>
