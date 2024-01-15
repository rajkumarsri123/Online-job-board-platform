<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website</title>

  <style>
    body {
  background-size: cover;
  background-image: url("Motivational-Computer-Wallpaper-625-03.png");
  margin:0;
}
    

    nav {
      
      overflow: hidden;
      display: flex;
      position: sticky;
      
      /* Adjust as needed based on the header height */
     
    }

    nav a {

      flex: 1;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 0;
      text-decoration: none;
      transition: background-color 0.3s;
      
    }

    nav a:hover {
      background-color: #555;
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
      display:block;
      padding: 20px 8px 20px 32px;
      text-decoration: none;
      font-size: 18px;
      color:white;
      display: block;
      transition: 0.3s;
      margin-left:40px;
    }

    .sidenav a:hover {
      color:lightblue;
    }

   
  </style>
</head>
<body>

  

  <nav>
    <a href="#home">HOME</a>
    <a href="jobs.php">JOBS</a>
    <a href="jobs1.php">POST JOBS</a>
    <a href="#" id="profileLink">PROFILE</a>
   
  </nav>

  <div class="sidenav" id="sideNav">
  <a href="javascript:void(0)" class="closenav" onclick="closeNav()" style="margin-left:10px;padding-top:0px;padding-bottom:5px;"><h1>×</h1></a>
  <div id="sub" class="mysub">
  <img src="Unknown_person.jpg" alt="Trulli" width="100" height="100" style="border-radius: 200px; margin-left:60px;" >
  </div>
    <?php echo "<h2 style='margin-left:80px;display:block;color:white;'>".$_SESSION["username"]."</h2>";
     
     echo "<h2 style='margin-left:60px;display:block;color:white;'>".$_SESSION["email"]."</h2>"; ?>
     
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
  
  

  </body>
  </html>