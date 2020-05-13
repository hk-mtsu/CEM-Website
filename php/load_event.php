<?php
require "vars.php";
require "db_connect.php";

session_start();

if ( isset($_POST['select_event']) && ($_POST['select_event'] != "None") && isset($_POST['current_tab_bttn'])) 
{
	$_SESSION['selected_event'] = $_POST['select_event'];
	$_SESSION['alerts'] = 'loaded '. $_POST['select_event'];
	$_SESSION['current_tab_bttn'] = $_POST['current_tab_bttn'];
}
else {
	$_SESSION['selected_event'] = 'None';
	$_SESSION['alerts'] = 'error loading event';
	$_SESSION['current_tab_bttn'] = 'current_tab_bttn';

}

header('Location: ../admin_panel.php');

?>
