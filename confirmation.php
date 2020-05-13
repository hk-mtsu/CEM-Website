<?php
// start php session
session_start();
require "php/vars.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Center for Educational Media | Confirmation</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php 
include "php/navbar.php"; 
?>

<div class="page-content">

<?php 
if (isset($_SESSION['Event']))
{
$event_name = $_SESSION['Event'];
echo<<<HTML
<h1 style="text-align: center">Thank you for registering with CEM.</h1>
<h3 style="text-align: center">You are now registered for the $event_name event.</h3>
<p style="text-align: center">You should receive a confirmation email shortly.</p>
HTML;
unset($_SESSION['Event']);
}
else
{
	header("Location: $site_root");
}
?>
</div>

<?php include "php/footer.php"; 
?>
</body>
</html>
