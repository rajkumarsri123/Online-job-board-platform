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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Applied Jobs</title>
  <style>
     body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .centered-container {
      padding: 20px;
      max-width: 600px;
      width: 100%;
      margin-top: 10px;
    }

    .record-box {
      margin-bottom: 20px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .record-box p {
      margin: 0;
      padding: 8px 0;
    }

    .record-box a {
      text-decoration: none;
      color: inherit;
    }

    .record-box:hover {
      background-color: rgba(255, 255, 255, 0.9);
    }
  </style>
</head>
<body>

<center>
  <h2>Jobs Applied</h2>
  <div class="centered-container">
    <?php
    // SQL query to retrieve jobid from applications table for the current user
    $sql = "SELECT jobid FROM applications WHERE cusid=" . $_SESSION["id"];
    $result = mysqli_query($conn, $sql);

    // Check if there are results
    if ($result && mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $jobid = $row["jobid"];

            // Query to retrieve job details using jobid
            $sqlDetails = "SELECT jobname, cmpname, cmpadd FROM jobs WHERE jobid=$jobid";
            $resultDetails = mysqli_query($conn, $sqlDetails);

            // Check if there are results for the second query
            if ($resultDetails && mysqli_num_rows($resultDetails) > 0) {
                $jobDetails = mysqli_fetch_assoc($resultDetails);

                // Display each record in a div with a separate box
                echo "<div class='record-box'>";
                echo "<p>Job Name: " . $jobDetails["jobname"] . "</p>";
                echo "<p>Company: " . $jobDetails["cmpname"] . "</p>";
                echo "<p>Company address: " . $jobDetails["cmpadd"] . "</p>";
                echo "</div>";
            } else {
                echo "No results found for jobid $jobid";
            }
        }
    } else {
        echo "No results found";
    }

    // Close connection
    mysqli_close($conn);
    ?>
  </div>
</center>


</body>
</html>
