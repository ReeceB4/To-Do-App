<?php
//initialize the session
session_start();

//unset all the session variables
$_SESSION = array();

//redirect to login page
header("location: login.php");
exit;
?>