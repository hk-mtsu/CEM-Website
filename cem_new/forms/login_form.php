<?php
include "php/vars.php";
echo<<<HTML
	<form action="$site_root/php/authenticate.php" method="post">
		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Username" name="uname" required><br>
			<label for="passw"><b>Password</b></label>
			<input type="password" placeholder="Password" name="passw" required><br>
			<input type="submit" name="submit"><br>
		</div>
	</form><br>
	</br>
HTML;

?>