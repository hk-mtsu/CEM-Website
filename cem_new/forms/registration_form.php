<?php

require "php/db_connect.php";
require "php/vars.php";
require "php/funcs.php";

$query = $conn->prepare("SELECT * FROM events WHERE open_registration LIKE 'Y'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$num_open = $query->rowCount();

if ($num_open > 0)
{
$query = $conn->prepare("SELECT * FROM events");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();

echo<<<HTML
<form class="form-horizontal">
<h3>Please fill out form</h3>
<div>
    <form class="registration_form" method="post" id="registration" action="$site_root/php/event_registration.php">
    <div class="form-group">
        <label>Event</label>
        <h4 class="alert">ATTN: BE SURE TO SELECT CORRECT EVENT</h4>
        <select class="form-control" name="event" class="event" required>
            <option disabled selected value> -- select an event -- </option>
HTML;
            while($event=$query->fetch())
            {
                // check cutoff date and max registrations before showing in select...
                $event_name = $event["event_name"];
                $cut_off_datetime = $event["cut_off_datetime"];
                $open_registration = $event["open_registration"];
                $event_fee = $event["event_fee"];
                if ($open_registration == 'Y') 
                {
                    echo "<option value='$event_name'>$event_name</option>";
                }
            }
            
echo<<<HTML
        </select>

    </div>
    
   
    <div class="form-group">
        <label>First Name</label>
        <input class="form-control" name="Fname" size="60" placeholder= "First Name" value="Test" required >
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input class="form-control" name="Lname" size="60" placeholder= "Last Name" value="User" required>
    </div>

    <div class="form-group">
       <label>Cell Phone (e.g. XXX-XXX-XXXX)</label>
        <input class="form-control" id="Phone" name="Phone" size="60" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"placeholder= "Phone Number (e.g. 123-456-7890)"  value="615-962-2813" required>
    </div>

    <div class="form-group">
        <label>Email address</label>
        <input class="form-control" name="Email" size="60" placeholder="Email address" value="jbv2d@mtmail.mtsu.edu" required>
    </div>

    <div class="form-group">
        <label>School</label>
        <input class="form-control" name="School" size="60" placeholder="School" value="MTSU" required>
    </div>

    <div class="form-group">
        <!--<label>School Phone (e.g. XXX-XXX-XXXX)</label>-->
        <!--<input name="SPhone" size="60" required>-->
        <input class="form-control" id="SPhone" name="SPhone" size="60" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  value="615-962-2813" placeholder="School Phone (e.g. XXX-XXX-XXXX)" required>
    </div>

    <div class="form-group">
        <!--<label>District</label>-->
        <input class="form-control" name="District" size="60" placeholder="District"  value="Rutherford" required>
    </div>

    <div class="form-group">
        <!--<label>Position</label>-->
        <input class="form-control" name="Position" size="60" placeholder="Position"  value="GA" required>
    </div>

    <div class="form-group">
        <label style="padding-top: 1em"><strong>Terms and Conditions</strong></label>
        <div class="form-control" id="terms_and_conditions" style="width: 60%;height: 15em; overflow: Auto; border: 1px solid black; border-radius: 3px;">
            Pursuant to the Tennessee Personal Rights Protection Act, T. C. A. §47-25-110 and the U.S. Copyright Act, I,
            the undersigned, hereby grant permission to the Center for Educational Media to record my image, voice, performances, poses, acts,
            plays and appearances, and use my picture, photograph, silhouette and other reproductions of my physical likeness and sound in any
            legitimate uses it may deem proper; and further agree to the unlimited distribution, advertising, promotion, exhibition and exploitation
            of the recording(s) of my performance for educational purposes only, in any format now known or hereafter developed, and displayed by any
            method or device now known or hereafter devised in which the same may be used, and/or incorporated and or exhibited and/or exploited. This
            permission applies to the program titled: ELL Collaborative
            <br/><br/>
            I also agree that the final edited recording(s) of my voice, performances, poses, acts, plays, appearances, etc. will become the property of
            the Center for Educational Media, or its parent organization or assigns and that I further acknowledge and agree that any appearance and/or
            performance, and all rights associated with that appearance and/or performance, including, without limitation any copyright, trademark or moral
            rights flowing from which, are hereby irrevocably transferred and assigned to the Center for Educational Media. Notwithstanding the above, I
            retain the right to use the final edited recordings for non-commercial educator professional development and training purposes.
            <br/><br/>
            I further agree that I will not assert or maintain against the Center for Educational Media, Middle Tennessee State University (MTSU), the
            MTSU Board of Trustees, their employees and their successors, assigns and licensees, any claim, action, suit or demand of any kind or nature
            whatsoever, including by not limited to, those based on the Tennessee Personal Rights Protection Act, T. C. A. §47-25-110, or grounded upon any
            common law cause of action for invasion of privacy, rights of publicity or other civil rights, or the U.S. Copyright Act or for any other claims,
            liabilities, demands, actions, causes of action(s), costs and expenses whatsoever, at law or in equity, known or unknown, anticipated or
            unanticipated, which I ever had, now have, or may, shall or hereafter have by reason, matter, cause or thing arising out of the use as herein
            provided.
            <br/><br/>
            I affirm that neither I, nor anyone acting on my behalf, gave or agreed to give anything of value to any Center for Educational Media employees
            or any of their representative(s) for arranging my appearance in this production.
        </div>
    </div>
    <div class="checkbox">
        <input type="checkbox" name="agree" required/> I Agree to the Center for Educational Media's Terms and Conditions
        <br/>
        <br/>
    </div>
    <div>
        <input class="btn btn-default" type="submit" name="submit" >
    </div>
    </form>
</div>
HTML;
}

else
{
echo<<<HTML
<h1 style="text-align: center">Sorry, no events are currently open for registration. </h1>
<h3 style="text-align: center">Please try again at a later date.</h3>
HTML;
}

?>