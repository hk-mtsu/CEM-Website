<?php
/**
    this file inserts new user into event table and emails both the user 
    and the moderator/cc emails that are found in event settings.
 */

require "db_connect.php";
require "vars.php";
require "../email/emailer.php";

session_start();
$success = FALSE;

// load event settings
$EVENT = $_POST["event"];

$query = $conn->prepare("SELECT * from EVENTS WHERE event_name LIKE ?");
// prepare and bindParam should protect against SQL injection
$query->bindParam(1,$_POST["event"],PDO::PARAM_STR,60);
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();

$row=$query->fetch();

$EVENT_NAME = $EVENT;
$EVENT_DATE = $row["event_date"];
$OPEN_REGISTRATION = $row["open_registration"];
$CC_EMAIL = $row["cc_email"];
$ADMIN_EMAIL = $row["admin_email"];
$ADMIN_NAME = $row["admin_name"];
$EMAIL_SUBJECT = $row["event_name"];

// check $_POST array to ensure required variables are set
if (isset($_POST['Fname']) && isset($_POST['Lname'])  && isset($_POST['Position'])
    && isset($_POST['Email']) && isset($_POST['School']) && isset($_POST['District']) && isset($_POST['agree']) ){
    // check that registration is still open
    if ($OPEN_REGISTRATION == 'Y') 
    {
        $success = insert($conn=$conn,$registration_vars=$_POST);
        if ($success)
        {
            $success1 = email_moderator(
                $event=$EVENT, 
                $email_to=$ADMIN_EMAIL,
                $email_from="CEM@mtsu.edu", 
                $from_name="CEM",
                $cc_email="josephbvolmer@gmail.com",
                $registration_vars = $_POST,
                $email_template="../email/event_template_moderator.html"
            ); //sends email to jenny
            $success2 = email_user(
                $event=$EVENT, 
                $email_to = $_POST['Email'], 
                $email_from = "CEM@mtsu.edu", 
                $from_name = "CEM",
                $cc_email="josephbvolmer@gmail.com", 
                $event_moderator="Jenny Marsh",
                $email_template="../email/event_template_user.html"
            ); //sends email to usern
        }
    }
    else 
    {
        $success = FALSE;
    }
}

function email_moderator(
    $event, $email_to, $email_from, $from_name, $cc_email, $registration_vars,
    $email_template ="../email/event_template_moderator.html")
{
    // build email for moderator
    $variables = array();
    $variables['event_name'] = $event;
    $variables['cc_email'] = $cc_email;
    $variables['email_to'] = $email_to;
    $variables['email_from'] = $email_from;
    $variables['email_from_name'] = $from_name;
    $variables['name'] = $registration_vars['Fname'] . " " . $registration_vars['Lname'];
    $variables['phone'] = $registration_vars['Phone'];
    $variables['email'] = $registration_vars['Email'];
    $variables['school'] = $registration_vars['School'];
    $variables['school_phone'] = $registration_vars['SPhone'];
    $variables['school_district'] = $registration_vars['District'];
    $variables['position'] = $registration_vars['Position'];
    $variables['tos'] = "Y";
    // get new emailer class object
    $Emailer = new Emailer();
    // replace vriables from templte with variables dict/array defined above
    // also builds header information etc.
    $Emailer->compile($variables,$email_template);
    // snelod email
    $success = $Emailer->send($verbose=False);
    return $success;
}

function email_user(
    $event, $email_to, $email_from, $from_name, $cc_email, $event_moderator, 
    $email_template="../email/event_template_user.html")
{
    // build email vars
    $variables = array();
    $variables['event_name'] = $event;
    $variables['cc_email'] = $cc_email;
    $variables['email_to'] = $email_to;        
    $variables['email_from'] = $email_from;
    $variables['email_from_name'] = $from_name;
    $variables['event_moderator'] = $event_moderator;
    // get new emailer class object
    $Emailer = new Emailer();
    // replace vriables from templte with variables dict/array defined above
    // also builds header information etc.
    $Emailer->compile($variables,$email_template);
    // send email
    $success = $Emailer->send($verbose=False);
}

function insert($conn, $registration_vars)
{

    // make sure they dont exist as an unregistered record, if so, flip flag
    $query = $conn->prepare("SELECT * FROM REGISTRATIONS WHERE event_name LIKE ? AND Email LIKE ?");
    $query->bindParam(1,$registration_vars["event"],PDO::PARAM_STR,60);
    $query->bindParam(2,$registration_vars['email'],PDO::PARAM_STR,60);
    $query->execute();
    if ($query->rowCount() > 0)
    {
        $query=$conn->prepare("UPDATE REGISTRATIONS SET unregistered='N' WHERE event_name LIKE ? AND Email LIKE ?");
        $query->bindParam(1,$registration_vars["event"],PDO::PARAM_STR,60);
        $query->bindParam(2,$registration_vars['email'],PDO::PARAM_STR,60);
        try{
            $query->execute();
            $success = TRUE;
            $alerts = "Successfully reregistered: " . $query->rowCount() . " records. </br>";
        }
        catch(PDOException $e){
            //$alerts = "Query Failed: " . $e->getMessage() ." <br/>";
            $success = FALSE;
            $alerts = "error reregistering records. </br>";
        }
    }
    else {
        // they dont exist as an unregistered record, so just add them as a new record
        $success = FALSE;
        $query = $conn->prepare("INSERT INTO REGISTRATIONS (event_name, Fname, Lname, Phone, Email, School, SPhone, District, Position, AgreeToTerms) Values(?,?,?,?,?,?,?,?,?,?)");
        $agree = 'Y';
        // prepare and bindParam should protect against SQL injection
        $query->bindParam(1,$registration_vars["event"],PDO::PARAM_STR,60);
        $query->bindParam(2,$registration_vars['Fname'],PDO::PARAM_STR,60);
        $query->bindParam(3,$registration_vars['Lname'],PDO::PARAM_STR,60);
        $query->bindParam(4,$registration_vars['Phone'],PDO::PARAM_STR,10);
        $query->bindParam(5,$registration_vars['Email'],PDO::PARAM_STR,60);
        $query->bindParam(6,$registration_vars['School'],PDO::PARAM_STR,60);
        $query->bindParam(7,$registration_vars['SPhone'],PDO::PARAM_STR,10);
        $query->bindParam(8,$registration_vars['District'],PDO::PARAM_STR,60);
        $query->bindParam(9,$registration_vars['Position'],PDO::PARAM_STR,60);
        $query->bindParam(10,$agree,PDO::PARAM_STR,1);
        try{
            $query->execute();
            $success = TRUE;
        }
        catch(PDOException $e){
            echo "Query Failed: " . $e->getMessage() ." <br/>";
            $success = FALSE;
        }

    }
    return $success;
    
}

$_SESSION['Event'] = $EVENT;

/*
$_SESSION['Fname'] = $_POST['Fname'];
$_SESSION['Lname'] = $_POST['Lname'];
$_SESSION['Phone'] = $_POST['Phone'];
$_SESSION['email_to'] = $_POST['Email'];
$_SESSION['School'] = $_POST['School'];
$_SESSION['SPhone'] = $_POST['SPhone'];
$_SESSION['District'] = $_POST['District'];
$_SESSION['Position'] = $_POST['Position'];
*/

$conn = null; //closes db connection
header('Location: ../confirmation.php');
