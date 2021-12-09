
  <?php include_once "../.././database_p/drugstoreConnect.php";

  $dbcon=  new Drugstore();
  $con=$dbcon->connectdb();
  $drugID=@$_POST["drugID"];
  $additiondrug=@$_POST["adddquantity"];
  $availabledrug=@$_POST["dquantity"];
  if(empty(trim($drugID)) || empty(trim($additiondrug))){
   $errorMessage= "Please type the quantity of  you want to add." . "<br> Else please click on the cancel button";
  }else {
    // put a control here to check if the  admin is sure  about increasing the drug.
    //echo "Are you sure you want to increase the drug quanitity by ". $additiondrug;

    $newQuantity=$availabledrug+$additiondrug;
    // the drug Id and the new number of drugs have  been inputed in to the form so now add the new drug to the system.
    $sql2="Update drugstore.drug set quantity= '$newQuantity' where ID='$drugID'" ;
    if($con->query($sql2)){
      echo "Drug has been increased succesfully";
      // Redirect the user to the Administrator page
      header("location: Drugssoldtoday.php");
    }


  }
   ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Increase Drug</title>
    <link rel="stylesheet" href="../../assets/css/increaseDrugQuantity.css">

  </head>
  <body>
    
    <div  class="displaycontainer" >
      <?php
      $drugID=@$_GET['ID'];
       $sql3="Select ID, Drugname, quantity from drugstore.drug where ID='$drugID'";
      $result3=$con->query($sql3);
      while ($row=$result3->fetch_assoc()) {


        ?>
      <div class="">
        <form class="IncDrugForm" action="increaseDrugQuanity.php" method="post">
          <div class="displayIncDrug">
            <label class=""for="">Drug Name</label> <br>
            <div class="labeldesign">
                <label class=""for=""> <?php echo $row["Drugname"]; ?></label>
            </div>

          </div>
          <div class="displayIncDrug">
            <label class=""for="">Quantity Available</label><br>
            <div class="labeldesign">
              <label class=""for=""> <?php echo $row["quantity"] ?>  </label> <br>
            </div>

          </div>
            <div class="displayIncDrug">
              <label for="">Increase by </label><br>
              <input class="inputIncDrug" type="number" name="adddquantity" value=""> <br>
              <input type="number" name="dquantity" value="<?php echo $row["quantity"]; ?>" hidden>
              <input type="text" name="drugID" value=" <?php echo $row["ID"]; ?>" hidden>
            <span><button type="submit" name="button" >Save</button></span>
          </div>



        </form>
      <?php } ?>

      </div>


    </div>
    <br>
    <br>
    <br>
    <div class="CancelButton"  role="button"onclick="document.location.href='Drugssoldtoday.php'">
      Cancel
    </div>
    <script type="text/javascript">
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
  </body>
</html>
