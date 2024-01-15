<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .centered-container {
            margin-left: 350px;
            margin-right: 350px;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            padding-left: 50px;
            padding-right: 20px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 20%;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

    <div class="centered-container">
        <?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve jobid from the URL
        if (isset($_GET['jobid'])) {
            $jobid = urldecode($_GET['jobid']);
            $empid = urldecode($_GET['empid']);
            $jobname = urldecode($_GET['jobname']);

            // SQL query to retrieve detailed information about the selected job
            $sql = "SELECT * FROM jobs WHERE jobid = $jobid";
            $result = mysqli_query($conn, $sql);

            // Check if there are results
            if (mysqli_num_rows($result) > 0) {
                // Output detailed information
                $row = mysqli_fetch_assoc($result);
                ?>

                <h2>Job Details</h2>
                <h3><?php echo $row["jobname"]; ?></h3>
                <h4><?php echo $row["cmpname"]; ?></h4>
                <h4><?php echo $row["cmpadd"]; ?></h4>
                <h4><?php echo $row["Datep"]; ?></h4>
                <h4><?php echo $row["pw"] . " . " . $row["jobtype"] . " . " . $row["exp"]; ?></h4>
                <h3>About job:</h3>
                <p><?php echo $row["about"]; ?></p>
                <h3>Required qualifications:</h3>
                <p><?php echo $row["skills"]; ?></p>

                <!-- Apply button within a form for better HTML semantics -->
                <form action="apply2.php" method="get">
                    <input type="hidden" name="jobid" value="<?php echo urlencode($jobid); ?>">
                    <input type="hidden" name="empid" value="<?php echo urlencode($empid); ?>">
                    <input type="hidden" name="jobname" value="<?php echo urlencode($jobname); ?>">
                    <button type="submit">Apply</button>
                </form>

                <?php
            } else {
                echo "No details found for the selected job";
            }
        } else {
            echo "Invalid request. Please select a valid job.";
        }

        // Close connection
        mysqli_close($conn);
        ?>

    </div>
   

</body>
</html>
