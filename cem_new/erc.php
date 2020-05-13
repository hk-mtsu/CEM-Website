<?php
// start php session
session_start();
?>
<!DOCTYPE html>
<html>
<head>

<title>Center for Educational Media | ERC</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>
<!-- nav bar -->
<?php 
  include "php/navbar.php"; 
?>
<div class="container">
    <div class="row">
<div class="page-content">
    
	<h2 style="font-family: Georgia"> Education Resource Channel</h2>
	<hr>
    <div class="content" >
        <iframe src="https://videoplayer.telvue.com/player/h5VycNXH7bgkAv6afvGOOsaDDk8g7wPw?fullscreen=false&showtabssearch=true&autostart=false" width="1100" height="1000" frameborder="0" allowfullscreen></iframe>
    </div>
    <hr>

</div>
    </div>
</div>
<?php 
  include "php/footer.php"; 
?>

</body>
</html>
