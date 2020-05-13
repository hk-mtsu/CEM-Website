<?php
// start php session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Center for Educational Media | Event Registration</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php 
# nav bar grabbed from php/navbar.php
include "php/navbar.php"; 
?>

<div class="page-content">

<?php
# event registration form grabbed from php/registration_form.php
include "forms/registration_form.php";
?>

</div>

<?php
#footergrabbed from php/footer.php
include "php/footer.php"; 
?>

</body>
</html>

