<?php
// start php session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Center for Educational Media | Events</title>
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
  include "php/vars.php";
  include "php/navbar.php"; 
?>
<div class="container">
<div class="page-content">

<?php
echo <<<HTML

<!-- check if there is currently a registeration open...  if not, do not show link.-->
<p style="font-size: 1.5em;">
Please click <a href="$site_root/register.php" style="color: red;">here</a> to register for one of our events.
</p>

<p style="font-size: 1.5em;">
If you are having trouble registering or would like to be added to the e-mail distribution list for all ELL Collaboratives, please contact Jenny Marsh at <a href="mailto:Jenny.Marsh@mtsu.edu">Jenny.Marsh@mtsu.edu</a> 
</p>

<p >We’re starting our third year of the ELL Collaborative @ MTSU, offering professional development for educators who work with English Learners – ESL teachers, general education teachers, administrators, coordinators, directors in schools and districts in Tennessee.  The ELL Collaborative is part of a broader professional development initiative known as the PK-12 Collaborative @ MTSU. It is sponsored by the Center for Educational Media and Professional Development in MTSU’s College of Education. We hold Collaborative meetings during the school year, as well as a summer conference, the ELL Collaborative Summer Academy.  We schedule our school year sessions to consider school schedules, holidays and testing.  To date, more than 300 educators from 40+ school districts in Tennessee have participated in the ELL Collaborative meetings and summer conferences.
</p>

<h3>The ELL Collaborative</h3>
<ul>
    <li>Is participant-driven, with educators identifying the topics of sessions based on their needs</li>
    <li>Is collaborative with participants serving as presenters to share strategies, materials, programs, technology that have been successful for them</li>
    <li>Is especially beneficial for districts with fewer resources and staff to support English Learners</li>
    <li>Promotes professional support networks and individual contacts across districts which is beneficial for districts with a small staff of ELL educators</li>
    <li>Offers multiple sessions throughout the school year to address topics and apply PD immediately in the classroom settings</li>
    <li>Is available at no charge to the participants (other than providing your own lunch that day!)</li>
</ul>
</div>

HTML;

  include "php/footer.php"; 
?>
</div>
</body>
</html>
