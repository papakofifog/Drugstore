<?php
// Include config file
require_once ".././database_p/drugstoreConnect.php";

// Define variables and initialize with empty values
$username= $password = $confirm_password =$firstname =$lastname =$emailaddres= $gender="";
$username_err = $password_err = $confirm_password_err  = $emailaddres_err=$gender_err="";
$db=new DrugStore();
$mysqli= $db->connectdb();
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // validte firstname
    if (empty(trim($_POST['firstname']))){
        $firstname_err= "Please type your firstname";
    }else{
        $firstname=trim($_POST["firstname"]);
    }

    //validte lastname
    if (empty(trim($_POST["lastname"]))){
        $lastname_err="please type your lastname";
    }else{
        $lastname=trim($_POST["lastname"]);
    }

    //validate gender
    if(empty(trim($_POST['gender']))){
        $gender_err="please select your gender type";
    }else{
        $gender=trim($_POST['gender']);
    }

    //validate email address
    if(empty(trim($_POST['emailaddress']))){
        $emailaddres_err="please enter your emailaddress type";
    }else{
        $emailaddres=trim($_POST['emailaddress']);
    }


    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM users WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    //  if(empty($firstname_err)&& empty($lastname_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (userid,firstname,lastname,username,gender,email_address,status,password) VALUES (?,?,?,?,?,?,?,?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssss", $param_userid,$param_firstname, $param_lastname,$param_username,$param_gender,$param_emailaddress,$param_status,$param_password);

            echo "Hello";

            // Set parameters
            $param_userid=uniqid();
            $param_firstname= $firstname;
            $param_lastname= $lastname;
            $param_username = $username;
            $param_gender=$gender;
            $param_status="u";
            $param_emailaddress=$emailaddres;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash



            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: Login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href=".././assets/css/design.css">

</head>
<body>


    <div class="rectangle">
        <div class="picture">
          <h2 style="text-align:center;">Join the Ekasante Family</h2>
      </div>
      <div class="square">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-group">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname; ?>" placeholder="Enter your firstname here">
                <!--<span class="help-block"><?php echo $firstname_err; ?></span>-->
            </div>

            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="Enter your a Lastname here">
                <!--<span class="help-block"><?php echo $lastname_err; ?></span>-->
           </div>

            <div class="form-group <?php echo (!empty($emailaddres_err)) ? 'has-error' : ''; ?>">
                <label for="emailaddress">Email Address</label>
                <input type="text" id="emailaddress" name="emailaddress" class="form-control" value="<?php echo $emailaddres; ?>" placeholder="Enter your email address here">
                <span class="help-block"><?php echo $emailaddres_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for=username>Username</label>
                <input type="text" id=username name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter your username here">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for="password">Password</label>
                <input type="password" id="password_hash"name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Enter your password here">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password"name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm your password here.">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label for="gender">Gender</label><br>

                <div class="" style="display:flex;">
                  <label for="male">Male</label>
                  <input type="radio" id="male" name="gender" value="Male">
                </div>

                <div class="" style="display:flex;">
                  <label for="female">Female</label>
                  <input type="radio" id="female" name="gender" value="Female">
                </div>



                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>
            <br>
            <div class="form-group" id="but">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>

      </div>

          <!--  <p>Already have an account? <a href="user_login.php">Login here</a>.</p>
        </form>-->


</body>
</html>
