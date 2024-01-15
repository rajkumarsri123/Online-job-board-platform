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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM signup WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        
        if (password_verify($password, $row['passwrd'])) {
            $_SESSION["username"]=$row['username'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["email"]=$row['email'];
            
            echo "<script>window.location.href='home_page.php';</script>";
            exit();
        } else {
            echo "<script>window.location.href='login.html';</script>";
            exit();
        }
    }
}

mysqli_close($conn);
?>
