<?php
/**
 *
 */


include_once "../.././database_p/drugstoreConnect.php";
class commonFunctions{

  /*function writeList(){
    $list="<div class=cntainer><a href ='stocktaker.php'<option > $row['Generic_Name']."    ". $row['Unit_per_Price'];  </option></a> <br></div>";
    echo $list;}
    function  checkExistense($drugcode){
  $sql= "select * from inventorytake where Drugcode='$drugcode'";}*/
  function getDrugID($IDdrug){
    $drugID=$IDdrug;
    return $drugID;
  }
function selectDrugDetails($drugID, $additiondrug){
  $sql= "Select quantity from drugstore.drug where ID='$drugID' ";

  $dbcon=  new Drugstore();
  $con=$dbcon->connectdb();
  $result=$con->query($sql);

  echo "we are greate";
  while ($row=$result->fetch_assoc() ){
    echo "people";
    $drugquantiy=$row['quantity'];
    increaseDrug($row['quantity'],$additiondrug,$drugID,$conn);
  }

}

  function increaseDrug($availabledrug,$additiondrug, $drugID ){
    $sql= "Update drugstore.drug set quantity= '$availabledrug+$additiondrug' where ID='$drugID'" ;
    if($conn->query($sql)){
      $mesaage= "Drug has been increased succesfully";
    }
  }


}



?>
