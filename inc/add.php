<?php
session_start();

function sanitizeString($var)
{
    include 'connect.php';
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    $var = striplashes($var);
    $db_server->real_escape_string($var);
    return($var);
}

if (isset($_POST['add']))
{
    //atempt to remove html injection and other hacking attempts
    $listTextClean = sanitizeString($_POST['add']);
    $sessionID = $_SESSION["id"];
    //query to Add new entry into table
    $sql = "INSET INTO list_items (ListText, userID)
    VALUES ('$listTextClean','$sessionID' )";
    //Execute query and validate success
    if ($db_server->query($sql)) {
        //echo "New record  created successfully":
        unset($sql);
    } else {
        echo "Error: ". $sql . "<br>" . $db_server->error;
    }
}
?>