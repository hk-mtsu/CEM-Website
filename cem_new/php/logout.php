<?php
require "vars.php";
session_start();
session_destroy();
header("Location: $site_root/index.php");
?>