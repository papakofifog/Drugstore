<?php
session_start();
include_once "../.././database_p/drugstoreConnect.php";
$valueID=$_GET['ID'];
$dbcon=  new Drugstore();
$con=$dbcon->connectdb();
$sql= "Select * from drug where ID=$valueID";
$result=$con->query($sql);
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <form class="" action='stocktaker.php ' method="get">
      <!--label of the name of the drug-->
      <div class="">
          <?php while($row= $result->fetch_assoc()){ ?>
          <label for=""><?php echo $row["Drugname"];  ?></label><br>
          <input type="text" name="ID" value='<?php   echo $row['ID']; ?>' hidden>

        <?php $drugID=$row['ID'];
        $drugcode=$row['Drugcode'];
          $drugname=$row['Drugname'];
          $unitPrice=$row['Price'];
       }?>



      </div>

      <!--input for the number or the item sold-->
      <div class="">
        <?php if(empty($existAl)){
        echo '  <label for="">Number sold</label> <br>
          <input type="number" name="soldnumb"   value="" placeholder="how many have you sold">';
       }else{echo $existAl;}?>
      </div>

      <div class="">
        <button type="submit" name="submit">Save</button>
      </div>
      <input type='number' name="checker" value="1" hidden>

    </form>

    <?php

      $Newcon=  new Drugstore();
      $con=$Newcon->connectdb();


            $sql3= "select Drugcode from inventorytake where Drugcode =?";
              if( $stmt= $con->prepare($sql3) ){
                $stmt->bind_param("s", $param_drucode);
                //set parameters
                $param_drucode=$drugcode;
                if($stmt->execute()){

                  $stmt->store_result();
                  if($stmt->num_rows == 1){
                    $existAl="Your stock has already been taken";
                    $stmt->close();
                  }else{
                    if(empty(trim(@$_GET['soldnumb']))){
                        $num_itemssold="Please enter the number of the drugs you sold";
                    }else{
                        $num_itemssold=trim($_GET['soldnumb']);
                        $sellingprice=$unitPrice*$num_itemssold;
                        $datetaken=date("Y/m/d");
                        $sql1= "Insert into inventorytake(Drugcode,Drugname,soldnumber,unit_price,sellingPrice,datetaken) values(?,?,?,?,?,?)";
                        if($stmt1 = $con->prepare($sql1)){
                          $stmt1->bind_param("ssssss",$param_drugcode,$param_Drugname,$param_soldnumber,$param_unit_price,$param_sellingPrice,$param_datetaken);
                          // Set the parameters to be inserted into the mysql_list_table
                          $param_drugcode=$drugcode;
                          $param_Drugname=$drugname;
                          $param_soldnumber=$num_itemssold;
                          $param_unit_price=$unitPrice;
                          $param_sellingPrice=$sellingprice;
                          $param_datetaken=$datetaken;
                          if($stmt1->execute() ){
                            echo "Your stock has been taken";

                            $commandu= "update drugstore.drug set status='t' where ID=?";
                            if($stmt5 = $con->prepare($commandu)){
                              //bind the parameter to the drug row.
                              $stmt5->bind_param("s", $param_code);
                              //set the parameters
                              $param_code=$drugID;
                              if($stmt5->execute()){
                                echo "Update succesfully";
                                header("location:inventory.php");
                              }else {echo "Sorry we were not able to update the function";}
                            }else {
                            echo "There is a problem somewhere";
                          }

                    }




                  }else {
                    echo "Something went wrong";
                  }
                }
              }}}?>
  </body>
</html>
