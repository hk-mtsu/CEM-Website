<?php
// start php session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<!-- nav bar -->
    <div id="div1">
        <?php 
          include "php/navbar.php"; 
        ?>
    </div>
  <div class="container ">
    <div class="page-content">
      <div class="row content">
        <div id="pdevcontent">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                </div>
                <ul class="nav navbar-nav">
                  <li class="active"><a href="about.php">About</a></li>
                  <li><a href="#pdevvideos">Online Professional Development</a></li>
                  <li><a href="#pdevevent">Offline Professional Development</a></li>
                </ul>
              </div>
            </nav>
            
            <div id="pdevevent" class="tabcontent">
                <h1> Upcoming Events Registration </h1>
                    <div class="wrapper">
                        <?php include "forms/registration_form.php" ; ?>
                    <div class="right" class="outline">
                        <div id="browse_videos"></div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php 
  include "php/footer.php"; 
?> 
<body>
</html>