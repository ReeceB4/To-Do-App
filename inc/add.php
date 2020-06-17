<?php
  
function sanitizeString($var)
{
	$var = strip_tags($var);
	$var = htmlspecialchars($var);
	$var = stripslashes($var);
	mysqli_real_escape_string($db_server,$var);
	return $var;
}

if (isset($_POST['add']))
{
	//attempt to remove html injection and other hacking attempts
	$listTextClean = sanitizeString($_POST['add']);
	//echo $listTextClean;
	//echo $_POST['add'];
	
	$sql = "INSERT INTO list_items (ListText)
	VALUES ('$listTextClean')";

	if (mysqli_query($db_server, $sql)) {
    		//echo "New record created successfully";
		unset($sql);
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($db_server);
	}	
}
?>