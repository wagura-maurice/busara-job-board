<?php
// error_reporting(0);
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "busara";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
}

$connection->set_charset("utf8");

include('functions.php');
$userClass = new userClass($connection);

$hDate = (new DateTime (date('Y-m-d H:i:s'))) -> format('M, dS Y');
$phpversion = phpversion();

define('APPNAME', 'Busara - JobBoard');
define('SITEURL', 'http://localhost/busara');
define('AUTHOUR', 'WAGURAMAURICE');
define('AUTHOUR_URL', 'www.waguramaurice.cf');
define('SITEBOOKINGS', 'wagura465@gmail.com');

?>