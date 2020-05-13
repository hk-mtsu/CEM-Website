<?php
// start php session
session_start();

require "php/vars.php";

if ((isset($_SESSION["authenticated"])) && ($_SESSION["authenticated"])) 
{
    header("Location: $site_root/user_panel.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Center for Educational Media | Home</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php 
include "php/navbar.php"; 
?>

<div class="page-content">

<div id="alerts_div">&nbsp;</div>

<!-- Tab links -->
<div class="tabs">
    <button id="loginbtn" class="tablinks" onclick="openTab(event, 'login')">I have an account</button>
    <button id="registerbtn" class="tablinks" onclick="openTab(event, 'register')">I want to make an account</button>
</div>

<!-- Tab content -->
<div id="login" class="tabcontent">
<h2>Login</h2>
<?php
include "forms/login_form.php"; 
?>
</div>

<div id="register" class="tabcontent">
<h2>Register</h2>
<?php
include "forms/user_create_form.php"; 
?>
</div>

<?php
include "php/footer.php"; 



if(isset($_SESSION['alerts']))
{
  $val = $_SESSION['alerts'];
   echo<<<SCRIPT
  <script type="text/javascript">
      document.getElementById("alerts_div").innerHTML =  "$val"
      setTimeout(function(){ document.getElementById("alerts_div").innerHTML = "&nbsp;"; }, 8000);
  </script>
SCRIPT;
}
?>

<script>
<?php 
if(isset($_SESSION['tab']) && $_SESSION['tab'] == 'register')
{
    echo 'document.getElementById("registerbtn").click();'; 
}
else
{
    echo 'document.getElementById("loginbtn").click();';   
}
?>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

</body>
</html>