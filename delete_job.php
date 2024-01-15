<!DOCTYPE html>
<html>
    <body>
        <?php
        // delete_job.php

        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET['jobid'])) {
            $jobId = mysqli_real_escape_string($conn, $_GET['jobid']);

            // Perform deletion query (adjust table and column names as needed)
            $sqlDelete = "DELETE FROM jobs WHERE jobid = $jobId AND empid = " . $_SESSION["id"];
            $resultDelete = mysqli_query($conn, $sqlDelete);

            if ($resultDelete) {
                echo "<script>window.location.href='jobs_posted.php';</script>";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }

        // Close connection
        mysqli_close($conn);
        ?>
       

    </body>
</html>
