<?php
session_start();

require_once 'connect.php';
$id = $_SESSION["id"];

$result = $db_server->query("SELECT * FROM list_items where userID = '$id' ORDER BY ListItemID DESC");

$tempNum = 0;
if ($result->num_rows> 0) {
    $strikeArr = array();
    while($row = $result->fetch_assoc()) {
        $strikeArr[$tempNum] = $row["ListItemID"];
        $tempNum++;
    }
    echo json_encode($strikeArr);
    exit();
}else {
    echo "0 results";
}

?>