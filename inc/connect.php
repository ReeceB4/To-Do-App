<?php

//include creds
require_once 'base.php';

function db_connection()
{
//establish connection
$db_server = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//is connection sucessful
if ($db_server->connect_error) {
    die("Connection failed: " .$db_server->connect_error);
}   
return $db_server;
}

?>
