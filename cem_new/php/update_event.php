<?php
require "vars.php";
require "db_connect.php";

session_start();

function update_event_table(
	$conn, 
	$old_event_name,$new_event_name,
	$event_fee,$event_date,
	$max_attendees,$cut_off_datetime,
	$mod_email,$mod_name,$cc_email,
	$open_registration
){
	$success = FALSE;
	// update event settings in admin table
	$query = $conn->prepare(
		"UPDATE events
		SET event_name = '$new_event_name', 
		max_attendees = '$max_attendees', 
		cut_off_datetime = '$cut_off_datetime', 
		admin_email = '$mod_email', 
		admin_name = '$mod_name',
		cc_email = '$cc_email',
		event_fee = '$event_fee',
		event_date = '$event_date',
		open_registration = '$open_registration'
		WHERE event_name = '$old_event_name'"
	);
    try{
        $query->execute();
        $success = TRUE;
        //echo "updated admin settings<br>";
    }
    catch(PDOException $e){
        $success = FALSE;
    }
	return $success;
}

$success = update_event_table(
	$conn, 
	$old_event_name=$_POST["old_event_name"],
	$new_event_name=$_POST["new_event_name"],
	$event_fee=$_POST["event_fee"],
	$event_date=$_POST["event_date"],
	$max_attendees=$_POST["max_attendees"],
	$cut_off_datetime=$_POST["cut_off_datetime"],
	$mod_email=$_POST["mod_email"],
	$mod_name=$_POST["mod_name"],
	$cc_email=$_POST["cc_email"],
	$open_registration=$_POST["open_registration"]
);


if ($success) 
{ 
	$_SESSION['alerts'] ="updated event settings."; 
	$_SESSION['selected_event'] = $_POST["new_event_name"];
	$_SESSION['current_tab_bttn'] = "edit_event_bttn";
}
else 
{ 
	$_SESSION['alerts'] = "error updating event settings."; 
	$_SESSION['current_tab_bttn'] = "edit_event_bttn";
}

header("Location: $site_root/admin_panel.php");
?>
