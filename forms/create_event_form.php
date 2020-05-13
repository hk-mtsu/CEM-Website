<?php
echo<<<HTML
<form name="create_event" id="create_event" action="$site_root/php/create_event.php" method="post">
    <label for="event_name">Event Name</label>
    <input class="create" name="event_name" placeholder="October 4th 2019 Collaborative" value="October 4th 2019 Collaborative"></br>
    <label for="event_date">Event Date</label>
    <input class="create" name="event_date" placeholder="10/04/2019" value="10/04/2019"></br>
    <label for="event_fee">Event Fee</label>
    <input class="create" name="event_fee" placeholder="0" value="0"></br>
    <label for="max_attendees">Max Attendees</label>
    <input class="create" name="max_attendees" placeholder="150" value="150"></br>
    <label for="cut_off_datetime">Cut off Date/Time</label>
    <input class="create" name="cut_off_datetime" placeholder="10/03/2019 12:00:00" value="10/03/2019 12:00:00"></br>
    <label for="mod_email">Moderator Email</label>
    <input class="create" name="mod_email" placeholder="Jenny.Marsh@mtsu.edu" value="Jenny.Marsh@mtsu.edu"></br>
    <label for="mod_name">Moderator Name</label>
    <input class="create" name="mod_name" placeholder="Jenny Marsh" value="Jenny Marsh"></br>
    <label for="cc_email">CC Email</label>
    <input class="create" name="cc_email" placeholder="centerforedmedia@gmail.com" value="centerforedmedia@gmail.com"></br>
    <label for="open_registration">Open Registration</label>
    <select name="open_registration" style="display:inline-block; width: 100px;">
      <option value="Y">Yes</option>
      <option value="N">No</option>
    </select></br>
    <input type="submit" value="Create"></br></br>
</form></br>
HTML;
?>