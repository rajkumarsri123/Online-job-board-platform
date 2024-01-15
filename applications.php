<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the applications table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jobid INT NOT NULL,
    empid INT NOT NULL,
    cusid INT NOT NULL,
    jobname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    fn VARCHAR(50) NOT NULL,
    ln VARCHAR(50) NOT NULL,
    ge VARCHAR(10) NOT NULL,
    Res VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
    die("Table creation failed: " . mysqli_error($conn));
}

// Prepare the insert statement
$insertstmt = mysqli_prepare($conn, "INSERT INTO applications (jobid, empid, cusid, jobname, email, fn, ln, ge, Res) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
mysqli_stmt_bind_param($insertstmt, "iiissssss", $jobid, $empid, $cusid, $jobname, $email, $fn, $ln, $ge, $Resume);

// Retrieve parameters from the URL
$jobid = isset($_GET["jobid"]) ? intval($_GET["jobid"]) : 0;
$empid = isset($_GET["empid"]) ? intval($_GET["empid"]) : 0;
$cusid = $_SESSION["id"];
$jobname = urldecode($_GET["jobname"]);

// Check if form fields are set in the POST data
if (isset($_POST["Email"], $_POST["Fn"], $_POST["Ln"], $_POST["Ge"], $_FILES['Resume']['name'])) {
    // Sanitize and extract values from POST data
    $email = $_POST["Email"];
    $fn = $_POST["Fn"];
    $ln = $_POST["Ln"];
    $ge = $_POST["Ge"];
    $Resume = $_FILES['Resume']['name'];

    // Move the uploaded resume file to the "uploads/" directory
    $targetPath = "uploads/" . basename($Resume);
    move_uploaded_file($_FILES['Resume']['tmp_name'], $targetPath);

    // Execute the prepared statement
    if (mysqli_stmt_execute($insertstmt)) {
        // Redirect to the home page after successful submission
        header('Location: home_page.php');
        exit();
    } else {
        echo "Error: " . mysqli_stmt_error($insertstmt);
    }
} else {
    echo "Form fields are not set.";
}

// Close connections
mysqli_stmt_close($insertstmt);
mysqli_close($conn);
?>
