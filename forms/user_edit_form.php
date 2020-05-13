<?php
include "php/vars.php";

echo<<<HTML
	<form action="$site_root/php/update_user.php" method="post">
		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Username" name="uname" required><br>

			<label for="passw"><b>Current Password</b></label>
			<input type="password" placeholder="Password" name="passw" required><br>

			<label for="passw"><b>E-mail Address</b></label>
			<input type="email" placeholder="Email" name="email" required><br>

			<label for="passw"><b>Password</b></label>
			<input type="text" placeholder="Password" name="newpassw" required><br>

			<label for="passw"><b>Confirm Password</b></label>
			<input type="text" placeholder="Password" name="newcpassw" required><br>

			<input type="submit" name="submit"><br>
		</div>
	</form><br>
	</br>
HTML;

?>