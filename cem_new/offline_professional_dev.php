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
  <div class="container-fluid ">
    <div class="page-content">
      <div class="row content">
        <nav class="navbar navbar-default">
           <div class="container">
             <div class="navbar-header">
              </div>
              <ul class="nav navbar-nav">
                <li class="active"><a href="professional_dev.php">About</a></li>
                <li><a href="online_professional_dev.php"> Online Professional Development</a></li>
                <li><a href="offline_professional_dev.php">Offline Professional Development</a></li>
              </ul>
            </div>
        </nav>
        <div class="container">
            <h2 style="font-family: Georgia"> Online Professional Development </h2> <br>
        </div> 
        <div class = "co1-sm-1 col-md-1 sidenav">
        </div>
        <div class="col-sm-3 col-md-3 sidebar" style="text-align: center; font-size: 15px; background-color:white;">
            <div class="well">
              <fieldset>
                <legend>Online - HD Videos</legend>
                <p>Online videos are available to view for PK-12 professional development. Click on tab for Online Professional Development.</p>
              </fieldset>
            </div>
        </div>
        <div class="col-sm-6 text-" style="text-align: left; font-size: 15px; background-color:white;">
            <div class="well">
            <fieldset>
                <legend style="font-family: Georgia"> Upcoming Events Registration </legend>
                <div class="well">
                    <?php include "forms/registration_form.php" ; ?>
                </div>
            </fieldset>
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