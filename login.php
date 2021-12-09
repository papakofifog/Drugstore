


<?php
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) === true){
    header("location: ./login.php");
    exit;
}
require ".././database_p/drugstoreConnect.php";

// Define the variable initialized to empty variables
$username= $password ="";
$username_err =$passworderr="";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }


    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT userid, firstname,lastname,username, status, password, picture FROM users WHERE username = ?";

        $db=new DrugStore();
        $mysqli= $db->connectdb();
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($userid, $firstname,$lastname,  $username,$status, $hashed_password, $picture);

                    if($stmt->fetch()){
                        $response=password_verify($password,$hashed_password);
                        if($response){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $userid;
                            $_SESSION["username"] = $username;
                            $_SESSION["firstname"] = $firstname;
                            $_SESSION["lastname"]=$lastname;
                            $_SESSION["picture"]=$picture;
                            echo "here we are " . $status;
                            // check if the user is an administrator
                            if($status=='u'){
                              // Redirect user to welcome page
                              header("location: .././mainp/userLogin.php");

                            }else {
                              // Redirect the user to the Administrator page
                              header("location: .././mainp/Adminpage.php");
                            }

                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/Login.css">
</head>
<body class="login-img3-body">
    <div  class="container">
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" required>
          <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <!--<label for="username"> Username:</label><br>-->

              <input type="text" id="username"  class="form-control"placeholder="Enter your username" name="username" value="<?php echo $username; ?>" required>
              <span><?php echo $username_err; ?></span>
            </div>

              <div class="input-group">
                <!--<label for="password">Password</label><br>-->

                <input type="password" class="form-control"placeholder="Enter your password" id="password" name="password" value="<?php echo $password; ?>" required><br>
                <span><?php if(!empty($password_err))echo $password_err; ?></span>
              </div>
              <div class="input-group">
                <button type="submit" class="loginButton"  value="Submit">Login</button>
              </div>




          </div>
        </form>
        <div class="signUp" >
            <p><a href="./signup.php">Dont have an account</a></p>
        </div>


    </div>
    <script type="text/javascript">
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
</body>
</html>
