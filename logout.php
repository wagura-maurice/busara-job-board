<?php
include 'lib/dbConfig.php'; // just for the session

$userClass->Logout();

$userClass->Redirect("".SITEURL."");
?>