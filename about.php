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
      <li class="active"><a href="#pdevabout">About</a></li>
      <li><a href="#pdevvideos">Online Professional Development</a></li>
      <li><a href="#pdevevent">Offline Professional Development</a></li>
    </ul>
  </div>
</nav>
        


<div id="pdevabout" class="tabcontent">
            <div class="wrapper">
                <div class="left">

                    <p class="colored">
                        <h3>Online - HD Videos</h3>
                        <p>Online videos are available to view for PK-12 professional development. Click on tab for Online Professional Development.</p>


                    <p class="colored">
                        <h3>Onsite - PK-12 Collaborative </h3>    
                                <p> The PK-12 Collaborative at MTSU is a professional development (PD) initiative at MTSU which includes: 1) the ELL Collaborative and 2) the School Counselors Collaborative.   The “collaborative model “ originated in CEM with the ELL Collaborative in 2017, serving educators who work with English Learners.  To date, more than 300 educators from 47 school districts in Tennessee have attended.  The School Counselors Collaborative is the newest Collaborative, developed in 2019-20, supporting school counselors and mental health professionals who work in K-12 schools. </p>            

                </div>
                <div class="right" style="text-align: center;">
                    <div class="slideshow-container">
                        <!-- Full-width images with number and caption text -->
                        <div class="mySlides fade">
                            <img src="assets/pdev/1.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/ell/1.JPG" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/2.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/ell/2.JPG" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/3.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/ell/3.JPG" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/4.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/ell/4.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/5.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/6.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/7.png" class="sm-slideshow">
                        </div>
                        <div class="mySlides fade">
                            <img src="assets/pdev/8.png" class="sm-slideshow">
                        </div>
                    <!-- The dots/circles -->
                    <div>
                      <span class="dot" onclick="currentSlide(1)"></span>
                      <span class="dot" onclick="currentSlide(2)"></span>
                      <span class="dot" onclick="currentSlide(3)"></span>
                      <span class="dot" onclick="currentSlide(4)"></span>
                      <span class="dot" onclick="currentSlide(5)"></span>
                      <span class="dot" onclick="currentSlide(6)"></span>              
                      <span class="dot" onclick="currentSlide(7)"></span>
                      <span class="dot" onclick="currentSlide(8)"></span>
                      <span class="dot" onclick="currentSlide(9)"></span>
                      <span class="dot" onclick="currentSlide(10)"></span>
                      <span class="dot" onclick="currentSlide(11)"></span>
                      <span class="dot" onclick="currentSlide(12)"></span>
                    </div>
                </div>
            </div>
        </div>
          <p style="font-size: 1.2em;">
                                      <!-- If you are having trouble registering or-->
                                      If you would like to be added to the email distribution list for the ELL Collaborative or for the School Counselors Collaborative, <br>
                          please contact Jenny Marsh at <a href="mailto:Jenny.Marsh@mtsu.edu">Jenny.Marsh@mtsu.edu</a> 
          </p>


        </div>
    </div>
</div>
</div>
<?php 
  include "php/footer.php"; 
?>  
</div>
 </body>
</html>