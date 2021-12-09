<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: user_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>welcome</title>
    <link rel="stylesheet" href="../assets/css/user.css">
  </head>
  <body>
    <div class="container">
      <div class="sidetab">
        <div class="picturecont">
          <img src=".././<?php echo $_SESSION['picture'];?>" alt="image of the user" style="width:70%; height:20%;">
        </div>



          <b class="buttn">Home</b>
          <div class="borderbuttn">
            <div class="buttn">
              <a type="button" class="beutybuttn" href="sellingpage.php" >Sell</a>
            </div>

            <div class="buttn">
              <a type="button" name="button" href=".././login/logout.php" class="beutybuttn">Out</a><br>
            </div>

          </div>



        </div>


      <div class="content">
        <h2>Ekasante DrugStore</h2>
        <div>
          <p>Welcome <?php echo  $_SESSION["firstname"]; ?> to Ekasante Drugstore. Sell and make money for Mr Asante.</p>
        </div>
        <div class="">
          <h3>Message from Mr Asante</h3>
          <p>Today is a new day to be happy. Sell and make money</p>
          <p>Father Abraham has many sons many sons of father Abraham and i am one of them so are you so let us praise the lord left foo right footer</p>
        </div>


      </div>

    </div>





  </body>
</html>
