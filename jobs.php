<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-size: cover;
            background-image: url("Motivational-Computer-Wallpaper-625-03.png");
            background-attachment: fixed;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        nav {
            overflow: hidden;
            display: flex;
            background-color: none;
            z-index: 100;
            width: 100%;
            position: sticky;
            top: 0;
        }

        nav a {
            flex: 1;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #555;
        }

        .centered-container {
            padding: 20px;
            max-width: 600px;
            width: 100%;
            margin-top: 60px;
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

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 0px;
            font-family: Arial, sans-serif;
            background-color: black;
        }

        .sidenav a {
            display: block;
            padding: 20px 8px 20px 32px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
            margin-left: 40px;
        }

        .sidenav a:hover {
            color: lightblue;
        }
    </style>
</head>
<body>
    <?php session_start(); ?>

    <nav>
    <a href="home_page.php">HOME</a>
    <a href="jobs.php">JOBS</a>
    <a href="jobs1.php">POST JOBS</a>
    <a href="#" id="profileLink">PROFILE</a>
   
  </nav>

  <div class="sidenav" id="sideNav">
  <a href="javascript:void(0)" class="closenav" onclick="closeNav()" style="margin-left:10px;margin-top:10px;padding-bottom:5px;"><h1>×</h1></a>
  <div id="sub" class="mysub">
  <img src="Unknown_person.jpg" alt="Trulli" width="100" height="100" style="border-radius: 200px; margin-left:60px;" >
  </div>
    <?php echo "<h2 style='margin-left:80px;display:block;color:white;'>".$_SESSION["username"]."</h2>";
     
     echo "<h2 style='margin-left:60px;display:block;color:white'>".$_SESSION["email"]."</h2>"; ?>
     
    <a href="jobs_applied.php">Jobs Applied</a>
    <a href="jobs_posted.php">Jobs Posted</a>

  </div>

  <script>
   document.addEventListener("DOMContentLoaded", function () {
      const profileLink = document.getElementById("profileLink");
      const sideNav = document.getElementById("sideNav");

      profileLink.addEventListener("click", function () {
        sideNav.style.width = "300px";
      });

      // Function to close the side panel
      window.closeNav = function() {
        sideNav.style.width = "0";
      };

      // Close the side panel when clicking outside of it
      window.onclick = function(event) {
        if (event.target === sideNav) {
          sideNav.style.width = "0";
        }
      };
    });
  </script>
    

    <div class="centered-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT jobid, empid, jobname, cmpname, cmpadd FROM jobs";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='record-box'>";
                echo "<a href='apply.php?jobid=" . urlencode($row["jobid"]) . "&empid=" . urlencode($row["empid"]) . "&jobname=" . urlencode($row["jobname"]) . "'>";
                echo "<p>Job Name: " . $row["jobname"] . "</p>";
                echo "<p>Company: " . $row["cmpname"] . "</p>";
                echo "<p>Company address: " . $row["cmpadd"] . "</p>";
                echo "</a>";
                echo "</div>";
            }
        } else {
           echo" <center>";
            echo "<h2 style='color:white;'>No Jobs</h2>";
            echo" </center>";
        }

        mysqli_close($conn);
        ?>
    </div>
    

</body>
</html>
