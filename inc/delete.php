<?php
require_once 'connect.php';
$checkNumA = $_POST['val'];

$sql = "DELETE FROM list_items WHERE ListId='$checkNumA' ";

if ($db_server->query($sql)) {
        echo "Record deleted successfully";
    unset($sql);
} else{
    echo "Error: " . $sql . "<br>" . $db_server->error;
}
?>