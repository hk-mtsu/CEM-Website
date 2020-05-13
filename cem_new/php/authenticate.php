<?php

require "vars.php";
require "passtools.php";
require "db_connect.php";

session_start();

$_SESSION["uname"] = NULL;
$_SESSION['view'] = FALSE;
$_SESSION['authenticated'] = FALSE;
$login_page = "$site_root/login.php";


if (isset($_POST["uname"]) && isset($_POST["passw"])) 
{
	$uname = $_POST["uname"];
	$passw = $_POST["passw"];
    $query = $conn->prepare('SELECT Pass,Salt,Fname,Lname,Permission_Level,Member_Since FROM users WHERE User_Id LIKE ?');
    // prepare and bindParam should protect against SQL injection
    $query->bindParam(1,$_POST["uname"],PDO::PARAM_STR,60);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    if ($query->rowCount() > 0)
    {
    	$results = $query->fetchAll();
    	$encrypted_hash = $results[0]["Pass"];
        $salt = $results[0]["Salt"];
        $passtools = new PasswordTools();
        $decrypted_hash = $passtools->decrypt($encrypted_hash, $pepper);
        $match = $passtools->check_hash($passw, $decrypted_hash, $salt);
        if ($match)
    	{
			$_SESSION["uname"] = $uname;
			$_SESSION["Fname"] = $results[0]["Fname"];
			$_SESSION["Lname"] = $results[0]["Lname"];
			$_SESSION['role'] = $results[0]["Permission_Level"];
            $_SESSION['signup_date'] = $results[0]["Member_Since"];
			$_SESSION['view'] = True;
			$_SESSION['authenticated'] = True;	
            $panel = (($_SESSION['role'] == "admin") ? "$site_root/admin_panel.php" : "$site_root/user_panel.php");
            unset($_SESSION["alerts"]);
            header("Location: $panel");
    	}
    	else
    	{
            //echo "invalid password<br>";
			$_SESSION["alerts"] = "invalid username or password";
            header("Location: $login_page");
    	}
    }
    else
    {
		//echo "invalid user id";
        $_SESSION["alerts"] = "invalid username or password";
        header("Location: $login_page");
    }
}
else 
{
    //echo "error";
	$_SESSION["alerts"] = "error.";
    header("Location: $login_page");
}

?>