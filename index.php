<?php 

//session_start(); //starts in add.php
//Login Data
require_once 'inc/connect.php';
//The Add List Item functionallity
require_once 'inc/add.php'; 


?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  
<body>
<!--<div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <?php 
    echo $_SESSION["id"];
    ?>-->
    <p>
        <a href="reset.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
<div class="container-fluid">
       
<!-- Start instructions section-->
<button data-toggle="collapse" data-target="#infoToggle" type="button" class="btn btn-info"><span class="glyphicon glyphicon-info-sign"></span></button><h1>Online Todo List</h1>      
    <div class="collapse" id="infoToggle">
      With this simple list making app you can,
      <ul>
          <li>
          <span class="glyphicon glyphicon-plus"></span> Add Items to the list  
          </li>
          <li>
          <span class="glyphicon glyphicon-ok"></span> Check items off the list  
          </li>  
          <li>
          <span class="glyphicon glyphicon-remove"></span> Delete items from the list  
          </li>
      </ul>  
   </div><!--close collapse-->
<!-- End instructions section-->

<!--The main list section start-->    
<div class="panel panel-default">    
<div class="panel-body">  
 <ul>

<?php
//get the DB stuff
$db_server = db_connection();
//create resource ordered such that new items are added to top of list
$todo_res = mysqli_query($db_server, "SELECT * FROM list_items ORDER BY ListItemID DESC");

//check sucess of building resource
if(!$todo_res)die("Database access failed :" . mysqli_error());

//temp int incrementor 
$tempNum=0;
//check if resource is not empty
if (mysqli_num_rows($todo_res) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($todo_res)) {
	//Render to DOM        
	echo "<li>" . $row["ListText"]. "</li>";
	$ListIDCount = $row["ListItemID"];
	$sql_listID = "UPDATE list_items SET ListID='$tempNum'
	       	       WHERE ListItemID='$ListIDCount' ";
	//Execute query and validate - Ensure ListID is sequential
	if (mysqli_query($db_server, $sql_listID)) {
    		//echo "New record created successfully";
		$tempNum++;
		unset($sql_listID);
	} else {
    		echo "Error: " . $sql_listID . "<br>" . mysqli_error($db_server);
	}	

    }
} else {
    echo "0 results";
}

?>

</ul>    
</div><!--close panel-body-->    
</div><!--close panel panel-default-->
    
 <!--submit button functionallity caught by add.php see index top-->   
 <form class="form-inline" role="form" action="index.php" method="post">
      
    <input type="text" class="form-control" name="add" id="addID">
  
  <button type="submit" class="btn btn-default">Add</button>
</form>    
<!--The main list section end-->
    
</div><!--Close .container-fluid-->

<!--Add Del and Done Buttons to li and set line-through-->      
<script src="js/todo.js"></script>
<script type="text/javascript">
    cleanUp();
</script>

<?php mysqli_close($db_server); ?>  
</body>    
    
</html>
