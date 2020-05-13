<?php
require "vars.php";
require "db_connect.php";

session_start();

function add_event($conn,$event_name,$event_fee,$event_date,$max_attendees,$cut_off_datetime,$mod_email,$mod_name,$cc_email,$open_registration) 
{
	// add event to events table
	$query = $conn->prepare(
		"INSERT INTO EVENTS (event_name,max_attendees,cut_off_datetime,admin_email,admin_name,cc_email,event_fee,event_date,open_registration)
		VALUES (?,?,?,?,?,?,?,?,?)"
	);
	// bind parameters
	$query->bindParam(1,$event_name,PDO::PARAM_STR,255);
	$query->bindParam(2,$max_attendees,PDO::PARAM_STR,3);
	$query->bindParam(3,$cut_off_datetime,PDO::PARAM_STR,255);
	$query->bindParam(4,$mod_email,PDO::PARAM_STR,255);
	$query->bindParam(5,$mod_name,PDO::PARAM_STR,255);
	$query->bindParam(6,$cc_email,PDO::PARAM_STR,255);
	$query->bindParam(7,$event_fee,PDO::PARAM_STR,11);
	$query->bindParam(8,$event_date,PDO::PARAM_STR,255);
	$query->bindParam(9,$open_registration,PDO::PARAM_STR,1);
	try{
		$query->execute();
		return TRUE;
	}
	catch(PDOException $e){
		//echo $e;
		return FALSE;
	}
}

// mkae sure everythig is set that we need, or else kick back to admin page
if (!(
		isset($_POST["event_date"]) && isset($_POST["event_name"]) &&
		isset($_POST["event_fee"]) && isset($_POST["max_attendees"]) &&
		isset($_POST["cut_off_datetime"]) && isset( $_POST["mod_email"]) &&
		isset($_POST["mod_name"]) && isset($_POST["cc_email"]) &&
		isset($_POST["open_registration"])
	))
{
	header("Location: $site_root/admin_panel.php");
}

/* check if an event with that name exists */
/* all event names must be unique */

$success1=FALSE;
$success2=FALSE;

// get event id
$query = $conn->prepare("SELECT COUNT(*) AS NumMatches FROM events WHERE event_name LIKE ?");
$query->bindParam(1, $_POST["event_name"], PDO::PARAM_STR, 255);

try{
	$query->execute();
	$num_matches=(int)$query->fetch()["NumMatches"];
	$success1=TRUE;
}
catch(PDOException $e){
	$num_matches=0;
	$success1=FALSE;	
}

if ($success1)
{
	if ($num_matches == 0)
	{
		$success2 = add_event(
			$conn=$conn,
			$event_name=$_POST["event_name"],
			$event_fee=$_POST["event_fee"],
			$event_date=$_POST["event_date"],
			$max_attendees=$_POST["max_attendees"],
			$cut_off_datetime=$_POST["cut_off_datetime"],
			$mod_email=$_POST["mod_email"],
			$mod_name=$_POST["mod_name"],
			$cc_email=$_POST["cc_email"],
			$open_registration=$_POST["open_registration"]
		);
	}
	else 
	{
		$success2 = FALSE;
	}
}

// notify admin of result
if ($success1 && $success2 ) { $value="successfully created event."; }
else { $value="error creating event."; }
$_SESSION["alerts"] = $value;
$_SESSION["current_tab_bttn"] = "create_event_bttn";
header("Location: $site_root/admin_panel.php");

?>
