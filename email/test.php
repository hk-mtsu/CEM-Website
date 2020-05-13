<?php
require "emailer.php";

// build email vars
$variables = array();
$variables['email_from']='CEM@mtsu.edu';
$variables['email_from_name']='CEM';
$variables['event_name'] = "December 12th Collaborative";
$variables['event_moderator'] = "Joseph Volmer";
$variables['to_email'] = "Joseph Volmer <jv2d@mtmail.mtsu.edu>";
$variables['cc_email'] = "josephbvolmer@gmail.com";

// get new emailer class object
$Emailer = new Emailer();

// replace vriables from templte with variables dict/array defined above
// also builds header information etc.
$Emailer->compile($variables,"event_template_user.html");

// send email
$Emailer->send($verbose=False);

?>
