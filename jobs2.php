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

$sql = "CREATE TABLE IF NOT EXISTS jobs (
    jobid int(6) AUTO_INCREMENT PRIMARY KEY,
    empid int(6) NOT NULL,
    jobname VARCHAR(20) NOT NULL,
    cmpname VARCHAR(20) NOT NULL,
    cmpadd VARCHAR(100) NOT NULL,
    Datep DATE NOT NULL,
    exp VARCHAR(50) NOT NULL,
    jobtype VARCHAR(50) NOT NULL,
    pw VARCHAR(50) NOT NULL,
    about nvarchar(2000) NOT NULL,
    skills nvarchar(1000) NOT NULL
)";
if (!mysqli_query($conn, $sql)) {
    die("Table creation failed: " . mysqli_error($conn));
}

$insertstmt = mysqli_prepare($conn, "INSERT INTO jobs (empid, jobname, cmpname, cmpadd, Datep,exp, jobtype,pw, about, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");

// Check if specific form fields are set in the POST data

    $empid = mysqli_real_escape_string($conn, $_SESSION["id"]);
    $jobname = mysqli_real_escape_string($conn, $_POST["Jobname"]);
    $cmpname = mysqli_real_escape_string($conn, $_POST["Cmpname"]);
    $cmpadd = mysqli_real_escape_string($conn, $_POST["Cmpadd"]);
    $datep = mysqli_real_escape_string($conn, $_POST["Date"]);
    $exp=mysqli_real_escape_string($conn, $_POST["Exp"]);
    $jobtype = mysqli_real_escape_string($conn, $_POST["Jobtype"]);
    $pw=mysqli_real_escape_string($conn, $_POST["Pw"]);
    $about = mysqli_real_escape_string($conn, $_POST["About"]);
    $skills = mysqli_real_escape_string($conn, $_POST["Skills"]);

    mysqli_stmt_bind_param($insertstmt, "isssssssss", $empid, $jobname, $cmpname, $cmpadd, $datep,$exp, $jobtype,$pw, $about, $skills);
    mysqli_stmt_execute($insertstmt);

    echo "<script>window.location.href='home_page.php';</script>";

mysqli_stmt_close($insertstmt);
mysqli_close($conn);
?>
