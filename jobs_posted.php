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

// Query to retrieve job details using jobid
$sqlDetails = "SELECT jobid,jobname, cmpname, cmpadd FROM jobs WHERE empid=" . $_SESSION["id"];
$resultDetails = mysqli_query($conn, $sqlDetails);
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
    .delete-btn {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover{
        background-color: #45a049;
        }
  </style>
</head>
<body>

<center>
  <h2>Jobs Posted</h2>
  <div class="centered-container">
    <?php
    // Check if there are results for the query
    if ($resultDetails && mysqli_num_rows($resultDetails) > 0) {
        // Display each record in a div with a separate box
        while ($jobDetails = mysqli_fetch_assoc($resultDetails)) {
            echo "<div class='record-box'>";
            echo "<p>Job Name: " . $jobDetails["jobname"] . "</p>";
            echo "<p>Company: " . $jobDetails["cmpname"] . "</p>";
            echo "<p>Company address: " . $jobDetails["cmpadd"] . "</p>";

            echo "<a href='delete_job.php?jobid=" . $jobDetails["jobid"] . "' class='delete-btn'>Delete</a>";


            echo "</div>";
        }
    } else {
        echo "No results found";
    }
    ?>
  </div>
</center>

<script>
   
    function confirmDelete(jobId) {
        var confirmDelete = confirm("Are you sure you want to delete this record?");
        if (confirmDelete) {
           
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_job.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    
                    location.reload();
                }
            };
            xhr.send("jobid=" + jobId);
        }
    }
</script>


</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
