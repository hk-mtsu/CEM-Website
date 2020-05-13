<?php
// start php session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Center for Educational Media | A/V Services</title>
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
  <div class="page-header">
<div class="page-content">

<h1>Audio/Visual Services</h1>
<p>
	For over three decades Audio/Visual Services has supplied the University community, and state partners, with access to multimedia equipment and expertise.  Services offered include television production, program duplication, consultation on facility design and equipment purchases, installation services, and a full service repair shop for maintenance and supplies. 
</p>
 
<hr>

<a href="equipment_checkout.php" class="av-services-link">
	<h1>Engineering Services and Equipment Checkout</h1>
	<img src="assets/avservices/engineering-services.png">
</a>
<p>
	Our experts can supply the right audio and visual tools to enhance your curriculum, research or grant.
</p>

<hr>

<a href="video_production.php" class="av-services-link">
	<h1>Video Production</h1>
	<img src="assets/avservices/video-production.png">
</a>
<p>
	Partner with Television Production on your project with full studio, editing and on-location capabilities.
</p>

<hr>

<a href="http://avs.mtsu.edu/" class="av-services-link">
	<h1>Client Review and Broadcast Outlet Webpage</h1>
	<img src="assets/avservices/broadcast-outlet.png">
</a>
<p>
	Visit our site to review and download video resources and collaborate on current projects.
</p>

<hr>

<a href="https://www.youtube.com/playlist?list=PLsJ4ZEMqDTNkyzrMbHDs8zdcYahdSda1I" class="av-services-link" target="blank">
	<h1>Out of the Blue</h1>
	<img src="assets/avservices/out-of-the-blue.png">
</a>
<p>
	View our electronic magazine news show, co-produced with the MTSU's Office of Marketing and Communications.
</p>

<hr>

<p>
Audio/Visual Services provided production, engineering and checkout services to over 80 MTSU Departments last year.  In the last two years, over 8000 K-12 teachers and students from 117 TN school districts have participated in CEM broadcasts/webcasts engineered and produced by AVS.  AVS was instrumental in producing the "Blue Tie Gala" Centennial video celebrating MTSU's 100th year, as well as videos for MTSU ad campaigns and TV commercials.
</p>

<hr>

</div>

</div>


<?php 
  include "php/footer.php"; 
?>
</div>

</body>
</html>
