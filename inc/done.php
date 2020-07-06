<?php 
session_start();
require_once 'connect.php';
$checkNumA = $_POST['val'];
$db_server = db_connection();
$id = $_SESSION["id"];
$result = $db_server->query("SELECT ListItemDone FROM list_items
                            WHERE ListID='$checkNumA' AND userID = '$id' ");

$row = $result->fetch_row();
 if ($row[0]==0){
     $sql = "UPDATE list_items SET ListItemDone='1'
     WHERE ListID='$checkNumA' AND userID = '$id' ";

     if ($db_server->query($sql)) {
         unset($sql);
         echo 1;
     } else{
         echo "Error: " . $sql . "<br>" . $db_server->error;
     }
 }else{
    $sql = "UPDATE list_items SET ListItemDone='0'
    WHERE ListID='$checkNumA' AND userID = '$id' ";

    if ($db_server->query($sql)) {
        unset($sql);
        echo 0;
    } else{
        echo "Error: " . $sql . "<br>" . $db_server->error;
    }
 }

 ?>