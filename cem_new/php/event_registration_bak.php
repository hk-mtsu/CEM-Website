<?php
/**
    this file inserts new user into event table and emails both the user 
    and the moderator/cc emails that are found in event settings.
 */

require "db_connect.php";
require "vars.php";

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

$EVENT_DATE = $row["event_date"];
$OPEN_REGISTRATION = $row["open_registration"];
$CC_EMAIL = $row["cc_email"];
$ADMIN_EMAIL = $row["admin_email"];
$EMAIL_SUBJECT = $row["event_name"];

// check $_POST array to ensure required variables are set
if (isset($_POST['Fname']) && isset($_POST['Lname'])  && isset($_POST['Position'])
    && isset($_POST['senderEmail']) && isset($_POST['School']) && isset($_POST['District']) && isset($_POST['agree']) ){
    // check that registration is still open
    if ($OPEN_REGISTRATION == 'Y') 
    {
        $success = insert($CONN=$conn,$EVENT_NAME=$EVENT,$POST_VARS=$_POST);
        if ($success)
        {
           // email_moderator($CC_EMAIL, $ADMIN_EMAIL, $EMAIL_SUBJECT); //sends email to jenny
           // email_user($CC_EMAIL, $ADMIN_EMAIL, $EMAIL_SUBJECT); //sends email to user
        }
    }
    else 
    {
        $success = FALSE;
    }
}

function email_moderator($CC_EMAIL, $ADMIN_EMAIL, $EMAIL_SUBJECT)
{
    // build email for moderator
    // email addresses
    //echo "<br>emailing moderator.<br>";
    $emailFrom = 'CEM@mtsu.edu';
    $emailFromName = 'CEM';
    $emailTo = $ADMIN_EMAIL;
    $cc = $CC_EMAIL;
    // subject
    $emailSubject = $EMAIL_SUBJECT;
    // headers
    $headers = "From: " . $emailFromName . " <" . $emailFrom . "> \r\n";
    $headers .= "Cc: " . $cc . "\r\n";
    // message
    $msg = "Name: " . $_POST['Fname'] . " " . $_POST['Lname'] . "\r\n";
    $msg .= "Phone: " . $_POST['Phone'] . "\r\n";
    $msg .= "Email: " . $_POST['senderEmail'] . "\r\n";
    $msg .= "School: " . $_POST['School'] . "\r\n";
    $msg .= "School Phone: " . $_POST['SPhone'] . "\r\n";
    $msg .= "District: " . $_POST['District'] . "\r\n";
    $msg .= "Position: " . $_POST['Position'] . "\r\n";
    $msg .= "Agreed to Terms: Y\r\n";
    //These will be added to the email msg only if they are set
    if (isset($_POST['DistrictBilling'])) {
        $msg .= "District to Bill: " . $_POST['DistrictBilling'] . "\r\n";
    }
    if (isset($_POST['DistrictAddress'])) {
        $msg .= "District Address: " . $_POST['DistrictAddress'] . "\r\n";
    }
    if (isset($_POST['DistrictContact'])) {
        $msg .= "District Contact: " . $_POST['DistrictContact'] . "\r\n";
    }
    if (isset($_POST['DistrictContactNumber'])) {
        $msg .= "District Contact Number: " . $_POST['DistrictContactNumber'] . "\r\n";
    }
    // send email
    //$success = mail($emailTo, $emailSubject, $msg, $headers);
    //test for error
    /*
    if (!$success) {
        $errorMsg = error_get_last()['message'];
        echo $errorMsg;
    } else {
        echo "Sent\r\n";
    }
    */
    $success=TRUE;
    return $success;
}

function email_user($CC_EMAIL, $EMAIL_SUBJECT)
{
	//echo "<br>emailing user.<br>";
    //settings
    $emailFrom = 'CEM@mtsu.edu';
    $emailFromName = 'CEM';
    $emailTo = $_POST['senderEmail']; //users email
    $emailSubject = $EMAIL_SUBJECT;
    // To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // Additional headers
    // $headers[] = 'To: ' . $emailTo;
    $headers[] = 'From: ' . $emailFrom;
    $headers[] = 'Cc: ' . $CC_EMAIL;

    //create email msg
    $msg = '<html>
                <head>  <title>Thanks from cem</title></head>
                <body style="font-family: Verdana; ">
                  <p>Thank you for Registering for the ELL Collaborative.
                   You will receive an email from Jenny Marsh closer to the date of the Collaborative with more details including parking information.
                   </p>

                </bodystyle>
                </html>
    ';

    //$success = mail($emailTo, $emailSubject, $msg, implode("\r\n", $headers));
    //test for error
    /*
    if (!$success) {
        $errorMsg = error_get_last()['message'];
        echo $errorMsg;
    } else {
        echo "Sent";
    }
    */
    $success=TRUE;
    return $success;
}

function insert($CONN, $EVENT_NAME, $POST_VARS)
{

    // make sure they dont exist as an unregistered record, if so, flip flag
    $query = $CONN->prepare("SELECT * FROM REGISTRATIONS WHERE event_name LIKE ? AND Email LIKE ?");
    $query->bindParam(1,$EVENT_NAME,PDO::PARAM_STR,60);
    $query->bindParam(2,$POST_VARS['senderEmail'],PDO::PARAM_STR,60);
    $query->execute();
    if ($query->rowCount() > 0)
    {
        $query=$CONN->prepare("UPDATE REGISTRATIONS SET unregistered='N' WHERE event_name LIKE ? AND Email LIKE ?");
        $query->bindParam(1,$EVENT_NAME,PDO::PARAM_STR,60);
        $query->bindParam(2,$POST_VARS['senderEmail'],PDO::PARAM_STR,60);
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
        $query = $CONN->prepare("INSERT INTO REGISTRATIONS (event_name, Fname, Lname, Phone, Email, School, SPhone, District, Position, AgreeToTerms) Values(?,?,?,?,?,?,?,?,?,?)");
        $agree = 'Y';
        // prepare and bindParam should protect against SQL injection
        $query->bindParam(1,$EVENT_NAME,PDO::PARAM_STR,60);
        $query->bindParam(2,$POST_VARS['Fname'],PDO::PARAM_STR,60);
        $query->bindParam(3,$POST_VARS['Lname'],PDO::PARAM_STR,60);
        $query->bindParam(4,$POST_VARS['Phone'],PDO::PARAM_STR,10);
        $query->bindParam(5,$POST_VARS['senderEmail'],PDO::PARAM_STR,60);
        $query->bindParam(6,$POST_VARS['School'],PDO::PARAM_STR,60);
        $query->bindParam(7,$POST_VARS['SPhone'],PDO::PARAM_STR,10);
        $query->bindParam(8,$POST_VARS['District'],PDO::PARAM_STR,60);
        $query->bindParam(9,$POST_VARS['Position'],PDO::PARAM_STR,60);
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
$_SESSION['Fname'] = $_POST['Fname'];
$_SESSION['Lname'] = $_POST['Lname'];
$_SESSION['Phone'] = $_POST['Phone'];
$_SESSION['senderEmail'] = $_POST['senderEmail'];
$_SESSION['School'] = $_POST['School'];
$_SESSION['SPhone'] = $_POST['SPhone'];
$_SESSION['District'] = $_POST['District'];
$_SESSION['Position'] = $_POST['Position'];

$conn = null; //closes db connection
header('Location: ../confirmation.php');
