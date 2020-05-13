<?php
require "vars.php";
require "db_connect.php";


session_start();

function delete_user($POST_VARS, $CONN) 
{
	$success = FALSE;
	if ( (isset($POST_VARS['selected_event'])) && (isset($POST_VARS['client_email'])) )
	{
		
		$selected_event = $POST_VARS['selected_event'];
		$client_email = $POST_VARS['client_email'];

		// todo: instead of actually deleting records, just flip a flag that says they unregistered...
		// then on admin panel when vieiwing records, only show ones that havent unregistered..
		// just to be extra safe, and eliminate this delete statement....
		// also on registration, check if email exists and if it does make sure unregistered is reset to 'N'
		
		//$sql_delete_query=$CONN->prepare("DELETE FROM registrations WHERE event_name LIKE ? AND Email LIKE ?");
	    //$sql_delete_query->bindParam(1,$selected_event,PDO::PARAM_STR,60);
	    //$sql_delete_query->bindParam(2,$client_email,PDO::PARAM_STR,60);

		$sql_delete_query=$CONN->prepare("UPDATE registrations SET unregistered='Y' WHERE event_name LIKE ? AND Email LIKE ?");
	    $sql_delete_query->bindParam(1,$selected_event,PDO::PARAM_STR,60);
	    $sql_delete_query->bindParam(2,$client_email,PDO::PARAM_STR,60);
	    try{
	        $sql_delete_query->execute();
	        $success = TRUE;
	        $alerts = "Successfully unregistered: " . $sql_delete_query->rowCount() . " records. </br>";
	    }
	    catch(PDOException $e){
	        //$alerts = "Query Failed: " . $e->getMessage() ." <br/>";
	        $success = FALSE;
	        $alerts = "error unregistering records. </br>";
	    }
	}
	else { 
		$success = FALSE; 
	 	$alerts = "error unregistering records. </br>";
	}
	return $alerts;
}

$alerts = delete_user($POST_VARS=$_POST, $CONN=$conn);
$_SESSION["alerts"] = $alerts;
header("Location: $site_root/admin_panel.php");

?>
