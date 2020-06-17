<?php

    //starting the session
    session_start();

    //check if the user logged in and if not direct to login page.
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !==true){
        header("location: login.php");
        exit;
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--diferent link below-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Welcome</title>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your To Do App</h1>
    </div>
    <?php
        echo $_SESSION["id"];
    ?>
    <p>
        <a href="reset.php" class="btn btn-warning">Reset Your Pasword</a>
        <a href="logout.php" class="btn btn-danger">Sign out of your account</a>
    </p>

</body>
</html>