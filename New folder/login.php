<?php

    //starting the session
    session_start();

    //checking if the user is previously logged in, if yes the direct him to index page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        //if get to here output message and destrot script 
        exit;
    }

    //Include config file
    require_once "connect.php";

    //define variables and initialize with empty variables
    $username = $password = "";
    $username_err = $password_err = "";

    //processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a unused username.";
        } else{
            $username = trim($_POST["username"]);
        }

         //check if password is empty
         if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";
        } else{
            $password = trim($_POST["password"]);
        }

        //verify creds
        if(empty($username_err) && empty($password_err)){
            //prepare an select statement
            $sql = "SELECT id, username, password, confirm FROM users WHERE username = ?";

            if($stmt = $mysqli->prepare($sql)){
                //bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);

                //set parameters
                $param_username = $username;

                //attempt to execute the prepared statement
                if($stmt->execute()){
                    //store result
                    /*call store result() for prepared statements that use SELECT,
                    SHOW, DESCRIBE, EXPLAIN that want buffered by the client,
                    result stored on client for faster access*/
                    $stmt->store_result();

                    //check if username exists, if yes then verify password 
                    if($stmt->num_rows == 1){
                        //bind result variables
                        $stmt->bind_result($id, $username, $hashed_password, $confirm);
                        if($stmt->fetch()){
                            //password_verify checks if a password matches a hash
                            if(password_verify($password, $hashed_password) && $confirm == 1){
                                //password is correct, so start a new session
                                session_start();

                                //store data in session variables
                                $_SESSION["loggedin"] - true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                //Direct user to index page
                                header("location: index.pnp");
                            }else{
                                //display an error message if passwordis not correct 
                                $password_err = "The password you have entered is not valid.";
                            }
                        }
                    } else{
                        //display an error message if username doesnt exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            //close statement
            $stmt->close();
        }

        //close connection
        $mysqli->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--different link below-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : '';?> ">
                <img src="images/user-icon.png" alt="user icon" class="login-icon"><label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : '';?> ">
                <img src="images/pass-icon.jpg" alt="key icon" class="login-icon"><label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Forgot password <a href="forgot.php">Reset now</a>.</p>
            <p>Dont have a account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>