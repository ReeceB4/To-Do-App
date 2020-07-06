
<?php
session_start();
require_once 'connect.php';
if (isset($_POST['add']))
{
    //get the DB stuff
    $db_server = db_connection();
    //atempt to remove html injection and other hacking attempts
    $listTextClean = sanitizeString($db_server, $_POST['add']);
    $sessionID = $_SESSION["id"];
    //query to Add new entry into table
    $sql = "INSERT INTO list_items (ListText, userID)
    VALUES ('$listTextClean','$sessionID' )";
    //Execute query and validate success
    if ($db_server->query($sql)) {
        //echo "New record  created successfully":
        unset($sql);
    } else {
        echo "Error: ". $sql . "<br>" . $db_server->error;
    }
}
/**
 * @param $db_server
 * @param $var
 * @return mixed
 */
function sanitizeString($db_server, $var)
{
	$var = strip_tags($var);
	$var = htmlspecialchars($var);
	$var = stripslashes($var);
	$db_server->real_escape_string($var);
	return($var);
}
?>