<?php
include "php/vars.php";
/*
if 	(
		(isset($_SESSION["uname"])) &&
		(isset($_SESSION["authenticated"])) &&
		(isset($_SESSION["view"])) &&
		$_SESSION['authenticated'] &&
		$_SESSION['view']
	)
{
	header("Location: $site_root/admin_panel.php");
}
else {
*/

/*
User_Id
Fname
Lname
Email
Password
Participant_Type
Role
School_District
School_Name
Permission_Level
*/

echo<<<HTML
	<form action="$site_root/php/register_user.php" method="post">
		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Username" name="uname" required><br>

			<label for="fname"><b>First Name</b></label>
			<input type="text" placeholder="First Name" name="fname" required><br>

			<label for="lname"><b>Last Name</b></label>
			<input type="text" placeholder="Last Name" name="lname" required><br>

			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Email@address.com" name="email" required><br>

			<label for="passw"><b>Password</b></label>
			<input type="password" placeholder="Password" name="passw" required><br>
			
			<label for="passw"><b>Confirm Password</b></label>			
			<input type="password" placeholder="Password" name="cpassw" required><br>
			<input type="submit" name="submit"><br>
		</div>
	</form><br>
	</br>
HTML;

?>