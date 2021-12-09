<?php
session_start();
include_once ".././database_p/drugstoreConnect.php";
$dbcon=  new Drugstore();
$con=$dbcon->connectdb();
$today=Date("Y-m-d");
$userID=$_SESSION["id"];


$sql5= "select * from  drugstore.users where ID='$userID'";

$result=$con->query($sql5);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account Details</title>
    <link rel="stylesheet" href="../assets/css/Admin.css">
  </head>
  <body>
<div class="PicturePerson">

  <div class="picture-container">

      <img src="../<?php echo $_SESSION["picture"]; ?>" alt="Picture of the Acount User" >
      <div class="">
        <div class="NameDesign">
          <?php echo $_SESSION["firstname"] . " ". $_SESSION["lastname"]; ?>
        </div>
        <br>
        <br>
        <br>
        <div class="" >
          <div class="" role="button" >
            Edit Profile Picture
          </div>
          <div class="" style="width:100px;" role="button">
          Change Password
          </div>
          <div class="" style="width: 100px;" role="button" onclick="document.location.href='.././login/logout.php'" >
          LogOut
          </div>
        </div>

      </div>


  </div>

</div>

  </body>
</html>
