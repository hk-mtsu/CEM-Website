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
echo "<nav class=\"navbar navbar-dark\" style=\"background-color: #002e4d;\">";
echo "<div class=\"container\">";
echo "<div style=\"float: left;\"><img width=\"120\" height=\"140\" src=\"assets/logo-cem.svg\"/></div><br><br>";
echo "<div class=\"navbar-header\"><div class=\"logo\">";
echo "<a style=\"color:white; font-size: 20px;\" class=\"navbar-brand\" href=\"$site_root/index.php\"><div>Center for Educational Media</div>";

/*echo "<figcaption class=\"title\"><a class=\"caption\" href=\"index.php\">Center for Educational Media</a></figcaption>";*/
echo "</div>";
echo "<div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">";

echo "<ul style=\"color:black; font-size: 20px;\" class=\"nav navbar-nav\">";
echo "<br><br>";
echo "<li class=\"nav-item\"><a ";
if (stripos($curr_page_b,"index.php") !== false){echo 'class="active"';}
echo "href=\"$site_root/index.php\" class=\"nav-link\" >Home</a></li> ";
echo "<li class=\"nav-item dropdown\">";
echo "<a class=\"nav-link dropdown-toggle\" id=\"navbarDropdownMenuLink\" data-toggle=\"dropdown\"aria-haspopup=\"true\" aria-expanded=\"True\">Professional Development </a>";
echo " <div class=\"dropdown-content\"> ";
echo " <a class=\"dropdown-item\" href=\"$site_root/professional_dev.php\"  target=\" pdevabout\">About</a> <br>";
echo " <a class=\"dropdown-item\" href=\"$site_root/professional_dev.php\" target=\" pdevvideos\">Online Professional Development</a><br> ";
echo " <a class=\"dropdown-item\" href=\"$site_root/professional_dev.php\" target=\" pdevevent\">Offline Professional Development</a> <br>";
echo " </div>";


echo "</li><li class=\"nav-item\"><a ";
if (stripos($curr_page,'erc.php') !== false){echo 'class="active"';}
echo "href=\"$site_root/erc.php\" class=\"nav-link\">Education Resource Channel</a></li><li class=\"nav-item\"><a ";
if (stripos($curr_page,'av_services.php') !== false){echo 'class="active"';}
echo "href=\"$site_root/av_services.php\" class=\"nav-link\">A/V Services</a></li> ";

 if ($logged_in) {
 echo "<li class=\"nav-item\"><a ";
 if ((stripos($curr_page,'user_panel.php') !== false)||(stripos($curr_page,'admin_panel.php') !== false)){echo 'class="active"';}
 echo "href=\"$dashboard_link\" class=\"nav-link\" >Dashboard</a></li><li><a href=\"$site_root/php/logout.php\" class=\"nav-link\">Logout</a></li>";
 }
 else{
 echo "<li class=\"nav-item\"><a ";
 if (stripos($curr_page,'login.php') !== false){echo 'class="active"';}
 echo "href=\"$site_root/login.php\" class=\"nav-link\">Login</a></li>";
 }
echo "</ul>";
echo "</div>";
echo "</div></div><br></div></nav>";

echo "$carriage_return";


?>
<!-- end of navbar -->


