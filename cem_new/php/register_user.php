<?php
require "vars.php";
require "db_connect.php";
require "passtools.php";

session_start();

// make sure required vars are set
function check_post_vars($post_vars, &$errors)
{
	// echo var_dump($post_vars);
	$result = ( 
		( isset($post_vars["fname"])) &&
		( isset($post_vars["lname"])) &&
		( isset($post_vars["uname"])) &&
		(isset($post_vars["email"])) &&
		(isset($post_vars["passw"])) &&
		(isset($post_vars["cpassw"])) 
	);
	if (!$result){$errors[] = "One or more required vars were missing.";}
	return $result;
}

function validate_names($fname, $lname, &$errors)
{
    $errors_init = $errors;	
	// todo: validate user entered names. make sure they are only valid characters and acceptable length
	if (strlen($fname) > 30 || strlen($lname) > 30) 
	{
        $errors[] = "Both first and last name must be under 40 characters";
	}
 	elseif ( (!ctype_alpha($fname)) || (!ctype_alpha($lname)) )
 	{
        $errors[] = "Both first and last name must only contain alphabetic characters";
 	}
    return ($errors == $errors_init);
}

function validate_password($password, &$errors) 
{
    $errors_init = $errors;
    if (strlen($password) < 8) 
    {
        $errors[] = "Password too short!";
    }
    if (!preg_match("#[0-9]+#", $password)) 
    {
        $errors[] = "Password must include at least one number!";
    }
    if (!preg_match("#[a-zA-Z]+#", $password)) 
    {
        $errors[] = "Password must include at least one letter!";
    }
    return ($errors == $errors_init);
}

// checks if username is alphanumeric and that it does not exist in users table
function validate_username($username, &$errors)
{
	global $conn;
    $errors_init = $errors;
	if (! ctype_alnum($username) )
	{ 
		$errors[] = "Username must be alpha-numeric.";
		return False; 
	}
	else
	{
		// todo: validate user entered username. make sure its not been used, and alpha-numeric
		$query = $conn->prepare('SELECT * FROM Users WHERE User_Id LIKE ?');
		// prepare and bindParam should protect against SQL injection
		$query->bindParam(1,$username,PDO::PARAM_STR,255);
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$query->execute();
		$username_available = ($query->rowCount() == 0);
		if (! $username_available)
		{
			$errors[] = "Username is already taken.";		
		}
    	return ($errors == $errors_init);
	}
}

// checks if email is valid and that it does not exist in users table
function validate_email($email_addr, &$errors)
{
	global $conn;
    $errors_init = $errors;
	// todo: validate user entered username. make sure its not been used, and alpha-numeric
	$query = $conn->prepare('SELECT * FROM users WHERE Email LIKE ?');
	// prepare and bindParam should protect against SQL injection
	$query->bindParam(1,$email_addr,PDO::PARAM_STR,255);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	$query->execute();
	$email_available = ($query->rowCount() == 0);
	if (! $email_available)
	{
		$errors[] = "Email address is already being used.";
	}
    return ($errors == $errors_init);
}



$errors = NULL;

if (check_post_vars($_POST, $errors))
{
	// confirm passwords match
	if ($_POST["passw"] != $_POST["cpassw"])
	{
		$errors[] = "Passwords do not match, please try again";
	}
	else 
	{
		validate_password($_POST["passw"], $errors);
		validate_names($_POST["fname"], $_POST["lname"], $errors);
		validate_username($_POST["uname"], $errors);
		validate_email($_POST["email"], $errors);
	}

}
// not all required post vars were found, redirect bcak to login
else
{
	$errors[] = "Error creating user, Please try again.";
}

// failed one or more test
if ($errors != NULL)
{
	// echo var_dump($errors);
	$_SESSION["alerts"] = "<br/>".implode("<br/>",$errors)."<br/>";
	$_SESSION["tab"] = "register";
	header("Location: $site_root/login.php");
}
else
{
	// echo "password, names, username, and email were validated.<br>";			
	// insert into users table,
	$user_id=$_POST["uname"];
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$email=$_POST["email"];
	$password=$_POST["passw"];
	$participant_type="K_12_Teacher";
	// get new passwordtools class object
	$passtools = new PasswordTools();
	// generate salt
	$salt = $passtools->salt();
	// hash password with salt
	$hashed_password = $passtools->hash($password, $salt);
	// pepper is site wide and stored on server in vars file...
	$encrypted_hash = $passtools->encrypt($hashed_password, $pepper);
	// store encrypted hash and its corresponidng salt together
	$query = $conn->prepare("INSERT INTO users 
	(User_id, Fname, Lname, Email, Pass, Salt, Participant_type)
	values (?,?,?,?,?,?,?)");
	// bind parameters
	$query->bindParam(1,$user_id,PDO::PARAM_STR,255);
	$query->bindParam(2,$fname,PDO::PARAM_STR,255);
	$query->bindParam(3,$lname,PDO::PARAM_STR,255);
	$query->bindParam(4,$email,PDO::PARAM_STR,255);
	$query->bindParam(5,$encrypted_hash,PDO::PARAM_STR,255);
	$query->bindParam(6,$salt,PDO::PARAM_STR,255);
	$query->bindParam(7,$participant_type,PDO::PARAM_STR,255);
	try{
		$query->execute();
		$success=True;
        $decrypted_hash = $passtools->decrypt($encrypted_hash, $pepper);
        $match = $passtools->check_hash($password, $decrypted_hash, $salt);
	}
	catch(PDOException $e){
		$success=False;
		echo "error: ". $e;
	}

	if ($success)
	{
		// set session variables
		// kick to user_panel page		
		$_SESSION["authenticated"] = True;
		$_SESSION["role"] = 'user';
		$_SESSION["uname"] = $user_id;
		$_SESSION["Fname"] = $fname;
		$_SESSION["Lname"] = $lname;
		// get signup timestamp...
		$query = $conn->prepare("SELECT Member_Since from users WHERE User_id like ?");	
		$query->bindParam(1,$user_id,PDO::PARAM_STR,255);
		try
		{
			$query->execute();
		    if ($query->rowCount() > 0)
    		{
    			$results = $query->fetchAll();
    			$signup_date = $results[0]["Member_Since"];
				$_SESSION["signup_date"] = $signup_date;
			}
			else{ $_SESSION["signup_date"] = "Error"; }
		}
		catch(PDOException $e){ $_SESSION["signup_date"] = "Error"; }
		header("Location: $site_root/user_panel.php");
	}
	else
	{
		$errors[] = "Error registering user";
		$_SESSION["alerts"] = "<br/>".implode("<br/>",$errors)."<br/>";
		$_SESSION["tab"] = "register";
		header("Location: $site_root/login.php");
	}
}

?>
