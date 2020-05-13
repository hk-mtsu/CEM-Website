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
<div class="container-fluid">
<div class="page-content">
  <div class="row content">
        

<div id="pdevcontent">
   
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
        <div><h2 style="font-family: Georgia"> Online Professional Development </h2> <br></div>
</div>

        <div id="pdevvideos" class="tabcontent">
             <div class="wrapper">
                 <div class="left">
                 <table id="t01">
                     <tr>
                       <td>
                           <div class="col-sm-6 col-md-4 sidebar" style="text-align: center; font-size: 15px; background-color:white;">
                                <div class="well">
                                    <?php include "forms/browse_video_form.php"; ?>
                                </div>
                               </div>
                       </td>
                       <td valign="top"> <div class ="vidFrame"> <iframe src="https://player.vimeo.com/video/195305381" width="260" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> </div></td>
                       <td valign="top"> <div class ="vidFrame"> <iframe src="https://player.vimeo.com/video/195305381" width="260" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> </div></td>
                     </tr>
                     </table>
                 </div>
               </div>
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