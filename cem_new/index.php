<?php
// start php session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Center for Educational Media | Home</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<body>
    
<div class="container-fluid">
    <div id="div1">
  
    <?php 
      include "php/navbar.php"; 
    ?>
    </div>
  <div class="page-content">
   <br/>
    <div class="row content">
        
        <div class = "co1-sm-1 col-md-1 sidenav">
        </div>
         
        <div class="col-sm-3 col-md-3 sidebar" style="text-align: center; font-size: 15px; background-color:white;">
            <div class="well">
            <fieldset>
                    <legend>Contacts</legend>
            <ul class="nav nav-sidebar">   
                <li style="color:black;" class="active"><a href="#">Overview</a></li>
                <li style="color:black;"><a href="#">Reports</a></li>
                <li style="color:black;"><a href="#">Analytics</a></li>
                <li style="color:black;"><a href="#">Export</a></li>
                <li style="color:black;" class="active"><a href="#">Overview</a></li>
                <li style="color:black;"><a href="#">Reports</a></li>
                <li style="color:black;"><a href="#">Analytics</a></li>
                <li style="color:black;"><a href="#">Export</a></li>
            </ul>
          </fieldset>
            </div>
        </div>
        <div class = "col-sm-4 text-left">
            <p class="information">
                The Center for Educational Media serves MTSU and the College of Education through outreach to the education community with Professional Development and partnerships. Through HD Video Production, our educational services begin with the local community and extend globally via distribution through satellite, cable and the web.
            </p>
            <!-------------------------------------------------------- Slideshow container ---------------------------------------------------------------->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- The dots/circles -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="3" class="active"></li>
            </ol>
                
                
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <img src="assets/home/1.png" style="width:100%;">
                <div class="text">Our new Professional Development Center hosting events for MTSU's College of Education</div>
              </div>

              <div class="item">
                <img src="assets/home/2.png" style="width:100%;">
                <div class="text">Videos produced for the classroom</div>
              </div>

              <div class="item">
                <img src="assets/home/3.png" style="width:100%;">
                <div class="text">Audio/Visual Services (Video Production division) help provide videos bringing content areas to life</div>
              </div>
              <div class="item">
                <img src="assets/home/4.png" style="width:100%;">
                <div class="text">Sharing Professional Development topics and pedagogy for new and established teachers throughout Tennessee</div>
              </div>
            </div>
              
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
         </div>
         <div class="col-sm-3 col-md-3 text-left" style="text-align: center;">
             <div class="well">
            <fieldset>
                <legend>Quick Link</legend>
                    <ul class="nav nav-sidebar">   
                        <li class="active"><a href="#">Overview</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Analytics</a></li>
                        <li><a href="#">Export</a></li>
                    </ul>
                </fieldset>
             </div>
                 <div class="well">
                <fieldset>
                     <legend>Highlighted Videos</legend>
                        <ul class="nav nav-sidebar">   
                        <li class="active"><a href="#">Overview</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Analytics</a></li>
                        <li><a href="#">Export</a></li>
                    </ul>
            </fieldset>
          </div>
        </div>
       
    </div>
  </div>
</div>
   
<?php 
            include "php/footer.php"; 
 ?>   
</body>
</html>
