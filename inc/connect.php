<?php

//include creds
require_once 'base.php';

//establish connection
$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

//is connection sucessful
if (mysqli_connect_errno($db_server)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
