<?php

$numRowsTodo = mysqli_num_rows($todo_res);
echo $numRowsTodo;
//$row = mysqli_fetch_assoc($todo_res);
//$maxNum = $row[$numRowsTodo];
//echo $maxNum;
//echo $todo_res[];

if ($numRowsTodo > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($todo_res)) {
        echo "<li>" . $row["ListText"]. "</li>";
    }
} else {
    echo "0 results";
}

$sql = "UPDATE list_items SET ListID='1'
	WHERE ListItemID='1' ";
if (mysqli_query($db_server, $sql)) {
    	echo "New record created successfully";
	//unset($sql);
} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($db_server);
}
?>