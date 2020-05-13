<?php 
echo <<<HTML
<form name="update_event" id="update_event" action="/cem_new/php/update_event.php" method="post">
    <input type="hidden" name="old_event_name" value="$event_name">
    <label for="event_name">Event Name</label>
    <input class="create" name="new_event_name" placeholder="October 4th 2019 Collaborative" value="$event_name"></br>
    <label for="event_date">Event Date</label>
    <input class="create" name="event_date" placeholder="10/04/2019" value="$event_date" ></br>
    <label for="event_fee">Event Fee</label>
    <input class="create" name="event_fee" placeholder="0" value="$event_fee"></br>
    <label for="max_attendees">Max Attendees</label>
    <input class="create" name="max_attendees" placeholder="150" value="$max_attendees"></br>
    <label for="cut_off_datetime">Cut off Date/Time</label>
    <input class="create" name="cut_off_datetime" placeholder="10/03/2019 12:00:00" value="$cut_off_datetime"></br>
    <label for="mod_email">Moderator Email</label>
    <input class="create" name="mod_email" placeholder="Jenny.Marsh@mtsu.edu" value="$mod_email"></br>
    <label for="mod_name">Moderator Name</label>
    <input class="create" name="mod_name" placeholder="Jenny Marsh" value="$mod_name"></br>
    <label for="cc_email">CC Email</label>
    <input class="create" name="cc_email" placeholder="centerforedmedia@gmail.com" value="$cc_email"></br>
    <label for="open_registration">Open Registration</label>
    <select name="open_registration" style="display:inline-block; width: 100px;">
HTML;
    if ($open_registration == "Y")
    {
        echo '<option value="Y" selected>Yes</option>';
        echo '<option value="N">No</option>';
    }
    else
    {
        echo '<option value="Y">Yes</option>';
        echo '<option value="N" selected>No</option>';
    }
echo <<<HTML
    </select></br>
    <input type="submit" value="Update"></br></br>
</form></br>
HTML;
?>