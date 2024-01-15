<!DOCTYPE html>
<html lang="en" >
<head>
    <title>Apply Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .login-container {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
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
    <?php
        session_start();
        $jobid = urldecode($_GET['jobid']);
        $empid = urldecode($_GET['empid']);
        $jobname = urldecode($_GET['jobname']);
    ?>
    <div class="login-container">
        <h2>Application-Form</h2>
        <?php
            echo "<form id='apply-form' action='applications.php?jobid=" . urlencode($jobid) . "&empid=" . urlencode($empid) . "&jobname=" . urlencode($jobname) . "' method='post' enctype='multipart/form-data'>";
        ?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>

            <label for="fn">First Name:</label>
            <input type="text" id="fn" name="Fn" required>

            <label for="ln">Last Name:</label>
            <input type="text" id="ln" name="Ln" required>

            <label for="ge">Gender:</label>
            <select name="Ge" id="ge" required>
                <option value="" style="display:none;"></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="resume">Resume:</label>
            <input type="file" id="resume" name="Resume" required>

            <button type="submit">Submit</button>
        </form>
    </div>
   

</body>
</html>
