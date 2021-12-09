<?php
// Connect to the database DrugStore.
include_once '.././database_p/drugstoreConnect.php';
$newDrug= new DrugStore();
$newDrugCon= $newDrug->connectdb();
$newDrug2= $newDrug->connectdb();
// Verify inputs
$dname=$dprice=$dquantity=" ";
$dname_err=$dprice_err=$dquantity_err="";
if(empty($_POST['drugname'])){
  $dname_err="Please add the name of the drug";
}else {
  $dname=$_POST['drugname'];
}
if(empty($_POST['Sellprice'])){
  $dprice_err="Please add price of the drugs";
}else{
  $dprice=$_POST['Sellprice'];
}
if(empty($_POST['numBought'])){
  $dquantity_err="How many are Available";
}else {
  $dquantity=$_POST['numBought'];
}
// Check if the drug already exist.
$checkDrugExist="Select drugname from drug where drugname='$dname'";

if( !empty($dname && $dprice && $dquantity)   ){

  $result= $newDrugCon->query($checkDrugExist);
  if($result->num_rows=== 1){
    echo "sorry we can not add this drug";
  }else{
    // Sql statement to insert  a new drug into the database
    $sql= 'Insert into drugstore.drug(Drugcode,Drugname,Price,quantity,status) values (?,?,?,?,?)';
    // Prepare the sql statement for the bind process
    if($stmt1=$newDrug2->prepare($sql))
    {  $stmt1->bind_param("sssss", $param_Drugcode,$param_Drugname, $param_Price,$param_quantity, $param_status);
      $param_Drugcode="drug".uniqid();
      $param_Drugname=$dname;
      $param_Price=$dprice;
      $param_quantity=$dquantity;
      $param_status="f";
      // Execute the sql statement if the bind process was successfull
      if($stmt1->execute()){
        echo "Drug has been added Successfully";
      }else{
        $iputNotFilled= "Please fill all input boxes";
      }
    }

    }

  }else {
    $codeError= "Something is wrong with the id";
  }

?>






<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>NewDrug</title>
    <link rel="stylesheet" href="../assets/css/addNewDrug.css">
  </head>
  <body>
      <div class="NewDruF12">
        <form class="" action="addNewDrug.php" method="POST" >

           <div class="formGroup">
                  <div class="">
                        <label for="named">Name of Drug</label>
                  </div>

                  <div class="">
                        <input class="inputGroup" type="text" name="drugname" id="drugname" required> <br>
                        <span><?php if(!empty($dname_err)) echo $dname_err; ?></span>
                  </div>
           </div>

           <div class="formGroup">
             <div class="">
                  <label for="Sellprice">Selling Price</label>
             </div>

             <div class="">
                  <input class="inputGroup" type="double" name="Sellprice" id="Sellprice" value="" required><br>
                  <span><?php if(!empty($dprice_err)) echo $dprice_err; ?></span>
             </div>

           </div>


           <div class="formGroup">

             <div class="">
                  <label for="numBought">Number bought</label>
             </div>

              <div class="">
                  <input class="inputGroup" type="number" name="numBought" id="numBought" value="" required><br>
                  <span><?php if(!empty($dquantity_err)) {echo $dquantity_err;} ?></span>
              </div>

           </div>


           <div class=" formGroup">
             <button type="submit" >Add Drug</button>

           </div>

         </form>
      </div>
      <div class="backButton" role="button" onclick="document.location.href='Adminpage.php'">
        Back
      </div>
      <script type="text/javascript">
        if(window.history.replaceState){
          window.history.replaceState(null,null,window.location.href);
        }
      </script>
  </body>
</html>
