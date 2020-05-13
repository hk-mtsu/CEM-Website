<!-- navbar -->
<?php
include "php/vars.php";
$curr_page = basename($_SERVER["PHP_SELF"]);
$logged_in =  ((isset($_SESSION["authenticated"])) && ($_SESSION["authenticated"]));
$admin = ((isset($_SESSION["authenticated"])) && ($_SESSION["authenticated"]) && ($_SESSION["role"] == "admin"));
$dashboard_link  = (($logged_in && $admin) ? "$site_root/admin_panel.php" : "$site_root/user_panel.php");
$curr_page=$_SERVER['REQUEST_URI'];
$curr_page_b=$_SERVER['SCRIPT_NAME'];
$carriage_return="\r\n";
echo "<div id=\"navdiv\">";
echo "<div class=\"navbar-header\"><div class=\"logo\">";
echo "<img width=\"140\" height=\"auto\" src=\"assets/logo-cem.svg\"/>";
/*echo "<figcaption class=\"title\"><a class=\"caption\" href=\"index.php\">Center for Educational Media</a></figcaption>";*/
echo "</div></div>";
echo "<div class=\"navbar-body\">";
echo "<ul class=\"topnav\">";
echo "<li class=\"nav\"><a ";
if (stripos($curr_page_b,"index.php") !== false){echo 'class="active"';}
echo "href=\"$site_root/index.php\" class=\"nav-tab\">Home</a></li><li class=\"nav\"><a ";
if (stripos($curr_page,'professional_dev.php') !== false){echo 'class="active"';}
echo "href=\"$site_root/professional_dev.php\" class=\"nav-tab\">Professional Development</a></li><li class=\"nav\"><a ";
if (stripos($curr_page,'erc.php') !== false){echo 'class="active"';}
echo "href=\"$site_root/erc.php\" class=\"nav-tab\">Education Resource Channel</a></li><li class=\"nav\"><a ";
if (stripos($curr_page,'av_services.php') !== false){echo 'class="active"';}
echo "href=\"$site_root/av_services.php\" class=\"nav-tab\">A/V Services</a></li><li class=\"nav\"><a ";
 if (stripos($curr_page,'events.php') !== false){echo 'class="active"';}
 echo "href=\"$site_root/events.php\" class=\"nav-tab\">Events</a></li><li class=\"nav\"><a ";
 if (stripos($curr_page,'Register.php') !== false){echo 'class="active"';}
 echo "href=\"$site_root/register.php\" class=\"nav-tab\">Event Registration</a></li>";
 if ($logged_in) {
 echo "<li class=\"nav\"><a ";
 if ((stripos($curr_page,'user_panel.php') !== false)||(stripos($curr_page,'admin_panel.php') !== false)){echo 'class="active"';}
 echo "href=\"$dashboard_link\" class=\"nav-tab\" >Dashboard</a></li><li><a href=\"$site_root/php/logout.php\" class=\"nav-tab\">Logout</a></li>";
 }
 else{
 echo "<li class=\"nav\"><a ";
 if (stripos($curr_page,'login.php') !== false){echo 'class="active"';}
 echo "href=\"$site_root/login.php\" class=\"nav-tab\">Login</a></li>";
 }
echo "</ul>";
echo "</div></div>";
echo "$carriage_return";
?>
<!-- end of navbar -->