<?php
//Debug option
//WARNING: Setting this to true could potentially expose your database credentials!! Development purposes only!
$debug = FALSE;

//Error reporting
($debug)?error_reporting(E_ALL):error_reporting(0);

// Database setup
include "./class/database.class.php";

$database = new Database();
$database->debug = $debug;

$database->db_host = "localhost";
$database->db_name = "mycommerce";
$database->db_user = "mycommerce";
$database->db_pass = "password";

$database->Connect();

// Database debug
if ($debug) $database->isConnected();
// End database setup

?>