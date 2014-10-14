<?php
//Debug option
//WARNING: Setting this to true could potentially expose your database credentials!! Development purposes only!
$debug = TRUE;
//if ($debug){ print "Debug enabled."; }

//Error reporting
($debug)?error_reporting(E_ALL):error_reporting(0);

// Classes
require "./class/database.class.php";
require "./class/user.class.php";

// DB Connect
$database = new DB();
//if ($debug){ print_r($database); }

?>