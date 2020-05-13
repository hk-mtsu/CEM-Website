<?php
/*
this page is for administrators to create events, remove event attendees, and update event settings
*/

// start php session
session_start();
require "php/vars.php";

if (!((isset($_SESSION["authenticated"])) && ($_SESSION["authenticated"]) && ($_SESSION["role"] == "admin")))
{
    header("Location: $site_root/admin_login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Center for Educational Media | Admin Panel</title>
<!-- data tables style stuff -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- custom style sheet -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- data tables js stuff, not sure if all of this is necessary -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var table = $('#rTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy','excel','csv','pdf','print'
        ]
    });
    table.buttons().container().appendTo($('#buttons'));
});
</script>

<script type="text/javascript" charset="utf8" src="js/script.js"></script>

</head>

<body>
<!-- nav bar -->
<?php
  require "php/db_connect.php";
  require "php/vars.php";
  require "php/navbar.php"; 

?>
<!-- load all conference settings -->
<?php
  $settings_query = $conn->prepare('SELECT * FROM events');
  $settings_query->setFetchMode(PDO::FETCH_ASSOC);
  $settings_query->execute();
?>

<div class="container"> <!-- page content div start -->
    <div id="alerts_div"></div>
    <br/><br/>

    <!-- Tab links -->
    <div class="tabs">
        <button id="edit_event_bttn" class="tablinks" onclick="openTab(event, 'edit')">Edit Event</button>
        <button id="create_event_bttn" class="tablinks" onclick="openTab(event, 'create')">Create Event</button>
        <button id="show_event_bttn" class="tablinks" onclick="openTab(event, 'show')">Show Event</button>
    </div>

    <!-- edit Tab content -->
    <div id="edit" class="tabcontent">
        <h1>Edit Event</h1>

        <form name="load_event" id="load_event" action="php/load_event.php" method="post">
            <select name="select_event" id="select_event" class="select_event" onchange="this.form.submit()">
            <?php
            if ((!isset($_SESSION["selected_event"]))||(isset($_SESSION["selected_event"]) && $_SESSION["selected_event"] == 'None'))
            {
                echo "<option disabled selected value> -- select an event -- </option>";
            }
            $settings_query = $conn->prepare('SELECT * FROM events');
            $settings_query->setFetchMode(PDO::FETCH_ASSOC);
            $settings_query->execute();
            while($row=$settings_query->fetch())
            { 
                $event_name = $row["event_name"];
                if ($event_name  == $_SESSION["selected_event"]) { echo "<option value=\"$event_name\" selected>$event_name</option>";}
                else {echo "<option value=\"$event_name\">$event_name</option>";}
            } 
            ?>
            </select>
            <input type="hidden" id="current_tab_bttn" name="current_tab_bttn" value="edit_event_bttn">
        </form></br>

        <?php
        // if there is an event selected load the settings
        if ( (isset($_SESSION["selected_event"])) && ($_SESSION["selected_event"] != "None") ) 
        {
            $selected_event = $_SESSION["selected_event"];
            $query = $conn->prepare('SELECT * FROM events WHERE event_name LIKE ?');
            // prepare and bindParam should protect against SQL injection
            $query->bindParam(1,$_SESSION["selected_event"],PDO::PARAM_STR,60);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            while($row=$query->fetch())
            {
                $conf_settings=$row;
                $event_name = $conf_settings["event_name"];
                $event_date = $conf_settings["event_date"];
                $event_fee = $conf_settings["event_fee"];
                $max_attendees = $conf_settings["max_attendees"];
                $cut_off_datetime = $conf_settings["cut_off_datetime"];
                $mod_email = $conf_settings["admin_email"];
                $mod_name = $conf_settings["admin_name"];
                $cc_email = $conf_settings["cc_email"];
                $open_registration = $conf_settings["open_registration"];
            }
        }
        // if no event is selected set empty strings
        else
        {
            $event_name = "";
            $event_date = "";
            $event_fee = "";
            $max_attendees = "";
            $cut_off_datetime = "";
            $mod_email = "";
            $mod_name = "";
            $cc_email = "";
            $open_registration = "";        
        }
        ?>

        <?php require "forms/edit_event_form.php"; ?>

    </div><!-- end edit Tab content -->


    <div id="create" class="tabcontent"><!-- create Tab content -->
        <h1>Create Event</h1>
        <!--<button type="button" id="createbtn">Show/Hide</button><br>--> 
        <?php require "forms/create_event_form.php"; ?>
    </div> <!-- end create Tab content -->


    <div id="show" class="tabcontent"><!-- show Tab content -->
        
        <form name="load_event" id="load_event" action="php/load_event.php" method="post">
            <select name="select_event" id="select_event" onchange="this.form.submit()">
            <?php
            if ((!isset($_SESSION["selected_event"]))||(isset($_SESSION["selected_event"]) && $_SESSION["selected_event"] == 'None'))
            {
                echo "<option disabled selected value> -- select an event -- </option>";
            }
            $settings_query = $conn->prepare('SELECT * FROM events');
            $settings_query->setFetchMode(PDO::FETCH_ASSOC);
            $settings_query->execute();
            while($row=$settings_query->fetch())
            { 
                $event_name = $row["event_name"];
                if ( (isset($_SESSION["selected_event"])) && ($_SESSION["selected_event"] == $event_name) ) 
                {
                    echo "<option value=\"$event_name\" selected>$event_name</option>";
                }
                else 
                {
                    echo "<option value=\"$event_name\">$event_name</option>";
                }
            } 
            ?>
            <!--<option value="None">None</option>-->
            </select>
            <input type="hidden" id="current_tab_bttn" name="current_tab_bttn" value="show_event_bttn">
        </form></br>

    <?php
    // if there is an event selected, load the event settings
    if ( (isset($_SESSION["selected_event"])) && ($_SESSION["selected_event"] != "None") ) 
    {
        $selected_event = $_SESSION["selected_event"];
        $query = $conn->prepare('SELECT * FROM events WHERE event_name LIKE ?');
        // prepare and bindParam should protect against SQL injection
        $query->bindParam(1,$_SESSION["selected_event"],PDO::PARAM_STR,60);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        while($row=$query->fetch())
        {
            $conf_settings=$row;
            $event_name = $conf_settings["event_name"];
            $event_date = $conf_settings["event_date"];
            $event_fee = $conf_settings["event_fee"];
            $max_attendees = $conf_settings["max_attendees"];
            $cut_off_datetime = $conf_settings["cut_off_datetime"];
            $mod_email = $conf_settings["admin_email"];
            $mod_name = $conf_settings["admin_name"];
            $cc_email = $conf_settings["cc_email"];
            $open_registration = $conf_settings["open_registration"];
        }
        echo "<h1>$event_name</h1>";
    }
    
?>
        <div id="registrationsdiv">
            <h2>Registrations</h2>
            <div id="buttons"></div>
            <table id="rTable" class="display nowrap">
                <thead>
                    <tr>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Phone</td>
                        <td>E-mail</td>
                        <td>School</td>
                        <td>School Phone</td>
                        <td>District</td>
                        <td>Position</td>
                        <td>Date</td>
                        <td>Agree To Terms</td>
                        </tr>
                </thead>
                <tbody>
                <?php
                if ( (isset($_SESSION["selected_event"])) && ($_SESSION["selected_event"] != "None") ) 
                {
                    $selected_event = $_SESSION["selected_event"];
                    $query = $conn->prepare("SELECT * FROM events join registrations on events.event_name = registrations.event_name where events.event_name LIKE ? AND unregistered LIKE 'N'");
                    $query->bindParam(1, $selected_event, PDO::PARAM_STR, 255);
                    $query->setFetchMode(PDO::FETCH_ASSOC);
                    $query->execute();
                    if($query->rowCount() != 0) 
                    {
                        while($row=$query->fetch())
                        {
                            echo "<tr>".
                                "<td>".$row["Fname"]."</td>".
                                "<td>".$row["Lname"]."</td>".
                                "<td>".$row["Phone"]."</td>".
                                "<td>".$row["Email"]."</td>".
                                "<td>".$row["School"]."</td>".
                                "<td>".$row["SPhone"]."</td>".
                                "<td>".$row["District"]."</td>".
                                "<td>".$row["Position"]."</td>".
                                "<td>".$row["Date"]."</td>".
                                "<td>".$row["AgreeToTerms"]."</td>".
                                "</tr>";
                        }
                    }
                }
                ?>
                </tbody>
                <tfooter>
                    <tr>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Phone</td>
                        <td>E-mail</td>
                        <td>School</td>
                        <td>School Phone</td>
                        <td>District</td>
                        <td>Position</td>
                        <td>Date</td>
                        <td>Agree To Terms</td>
                    </tr>
                </tfooter>
            </table>
        </div> <!-- end  registrationsdiv -->
    </div> <!-- edit show Tab content -->



</div> <!-- end page content div -->

</body>

<script type="text/javascript">
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<?php
if  ( isset ($_SESSION["current_tab_bttn"]) && (
        $_SESSION["current_tab_bttn"] == 'edit_event_bttn' ||
        $_SESSION["current_tab_bttn"] == 'create_event_bttn' || 
        $_SESSION["current_tab_bttn"] == 'show_event_bttn'
    ))
{ 
    echo '<script type="text/javascript">document.getElementById("'.$_SESSION["current_tab_bttn"].'").click();</script>';
}
else
{
    echo '<script type="text/javascript">document.getElementById("edit_event_bttn").click()</script>';
}

if(isset($_SESSION['alerts']))
{
    $val = $_SESSION['alerts'];
    unset($_SESSION['alerts']);
echo<<<SCRIPT
    <script type="text/javascript">
        document.getElementById("alerts_div").innerHTML =  "$val"
        setTimeout(function(){ document.getElementById("alerts_div").innerHTML = ""; }, 3000);
    </script>
SCRIPT;
}

include "php/footer.php"; 
?>

</html>
