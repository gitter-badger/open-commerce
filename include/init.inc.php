<?php
//Debug option
//WARNING: Setting this to true could potentially expose your database credentials!! Development purposes only!
$debug = TRUE;

//Error reporting
($debug)?error_reporting(E_ALL):error_reporting(0);

// Database setup
include "./class/database.class.php";
$database = new Db();

?>