<?php
function reached_max_registrations($max_registrations = 150, $event_table) 
{
    require 'db_connect.php';
    $query = $conn->prepare("SELECT * FROM $event_table");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $num_rows = $query->rowCount();
    $conn = null; //closes db connection
    //echo "num_rows".$num_rows;
    //echo "max_registrations".$max_registrations;
    return ($num_rows >= $max_registrations);
}

// check if current time is past the cutoff date time
// return TRUE if current datetime of server is past the set cutoff_datetime
// return FALSE if the current datetime of server is under the set cutoff_datetime
function past_cutoff_datetime($cutoff_datetime)
{
  // note: date time of cem server 5 hours ahead of central time
  date_default_timezone_set("America/Chicago");
  $curr = date('Y-m-d H:i:s');
  $date1 = strtotime($curr);
  $date2 = strtotime($cutoff_datetime); 
  $valid = $date2 > $date1;
  if ($valid){ $result = FALSE;}
  else { $result = TRUE;}
  return $result;
}

function modifyNavbar($items) {
  $ref = isset($_GET['p']) && isset($items[$_GET['p']]) ? $_GET['p'] : null;
  if($ref) {
    $items[$ref]['class'] .= '-selected'; 
  }
  return $items;
}

function GenerateMenu($menu, $class) {
  if(isset($menu['callback'])) {
    $items = call_user_func($menu['callback'], $menu['items']);
  }
  $html = "<nav class='$class'>\n";
  foreach($items as $item) {
    $html .= "<a href='{$item['url']}' class='{$item['class']}'>{$item['text']}</a>\n";
  }
  $html .= "</nav>\n";
  return $html;
}

?>
