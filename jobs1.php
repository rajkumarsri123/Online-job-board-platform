<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post Jobs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .login-container {
            max-width: 400px;
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
        select{
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

        .p:hover {
            background-color: #45a049;
        }

        .p {
            padding: 8px;
            background-color: #4caf50;
            border-radius: 5px;
        }

        .p a {
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Post Job</h2>
        <form id="job-form" action="jobs2.php" method="post">
            <label for="jobname">Job name:</label>
            <input type="text" id="jobname" name="Jobname" required>
            <label for="cmpname">Company name:</label>
            <input type="text" id="cmpname" name="Cmpname" required>
            <label for="cmpadd">Company address:</label>
            <input type="address" id="cmpadd" name="Cmpadd" required>
            <label for="date">Date:</label>
            <input type="date" id="date" name="Date" required>
            <br>
            <label for="exp">Experience:</label>
            <select name="Exp" id="exp" >
            <option value="" style="display:none;"></option>
    <option value="Internship">Internship</option>
    <option value="Entry level">Entry level</option>
    <option value="Associate">Associate</option>
    <option value="Mid-senior level">Mid-senior level</option>
    <option value="Director">Director</option>
    <option value="Executive">Executive</option>
  </select>
  <br><br>
            <label for="jobtype">Type of Job:</label>
            <select name="Jobtype" id="jobtype" required>
            <option value="" style="display:none;"></option>
    <option value="Full-time">Full-time</option>
    <option value="Entry level">Part-time</option>
    <option value="Associate">Contract</option>
    <option value="Mid-senior level">Temporary</option>
    <option value="Director">Volunteer</option>
    <option value="Executive">Internship</option>
  </select>
  <br><br>
  <label for="pw">Place of work:</label>
            <select name="Pw" id="pw" required>
            <option value="" style="display:none;"></option>
    <option value="On-site">On-site</option>
    <option value="Hybrid">Hybrid</option>
    <option value="Remote">Remote</option>
    
  </select>
  <br><br>
            
            <label for="cmpname">About Job:</label>
            <textarea id="about" name="About" rows="4" cols="50" required></textarea>
            <label for="skills">Required Qualifications:</label>
            <textarea id="skills" name="Skills" rows="4" cols="50" required></textarea>
            <br><br>
           
            <button type="submit">Post</button>
        </form>
        

   </div>
   

</body>

</html>