<?php
session_start();
include_once ".././database_p/drugstoreConnect.php";
$Dbcon=new Drugstore();
$conn=$Dbcon->connectdb();
$newConn=$Dbcon->connectdb();
// collect the data from the sale form.
$named=$numberd=$sellingp=$unit_Sale="";
$named_err=$numberd_err=$sellingp_err=$unit_SaleErr="";
// Check if the drug name has been inserted
if(empty(trim(@$_POST['named']))){
  $named_err="Please enter the name of the drug";
}else {
  $named=$_POST['named'];
}
// check if the unit of sale has been inserted
if(empty(trim(@$_POST['formsold']))){
  $unit_SaleErr="In what way was the drug sold.";
}else{
  $unit_Sale=@$_POST['formsold'];
}
// check if the user has specified the number of drugs that can be sold.
if(empty(trim(@$_POST['numberd']))){
  $numberd_err="Please specify a the number of drugs sold";
}else{
  $numberd=@$_POST['numberd'];
}
if(empty(trim(@$_POST['sellP']))){
  $sellingp_err= "Please enter the selling Price";
}else{
  $sellingp=@$_POST['sellP'];
}
$drugCoder1=@$_POST['seaDrugcode'];
$drugID=@$_POST['seaDrugID'];
$userID=@$_SESSION['id'];
$quantityd= @$_POST['quantity'];
echo $drugID;
echo $quantityd;

if(!empty(@$_POST['numberd'])&&!empty(@$_POST['named']) ){
  $sql4= 'Insert into drugstore.sold(drugcode,drugname,numberItems,formSold,unitryPrice,sellingPrice,saledate,soldBy) values(?,?,?,?,?,?,?,?)';
  if($stmt=$conn->prepare($sql4) ){
    $stmt ->bind_param("ssssssss", $param_drugcode,$param_drugname,$param_numberItems, $param_formsold,$param_unitryPrice,$param_sellingPrice,$param_saledate,$param_soldBy);
    $param_drugcode=$drugCoder1;
    $param_drugname=$named;
    $param_numberItems=$numberd;
    $param_formsold=$unit_Sale;
    $param_unitryPrice=$sellingp;
    $param_sellingPrice=$sellingp*$numberd;
    $param_saledate=Date("Y-m-d");
    $param_soldBy=$userID;
    if($stmt->execute()){
      $succesMessage= "Executed Successfull";
      // update the quantity value of the specific drug that has been sold.
      $sql= "Update drugstore.drug set quantity=$quantityd-$numberd where ID=$drugID";

      if($newConn->query($sql)){
        $succesUpdate= "Sold drug has been updated";
      }

    }else{
      echo "There is a problem somewhere";
    }
  }else {
      echo "Please check your Sql statement";
  }
}else {
  $searchBoxStmt= "Please search for the drug you are selling in the search box and and then specify the number you have sold.";

}





?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sell</title>
    <link rel="stylesheet" href="../assets/css/selling.css">
    <script type="text/javascript" src=".././assets/js/selling.js">

    </script>
  </head>
  <body>
    <div class="headingContainer">
      <p>Sell Here Ekasanate Drugs!!!</p>
    </div>
    <div class="container1" >
      <div class="">
        <form  class="SearchForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">

            <div id='inpuSearch' style="display:flex;">
              <input type="text" name="search" id="search" value="" onclick="doSearch()" placeholder="Search here"><button id="SubmitButton" type="Submit" name="submit" style="margin-left:20px;  margin-top:5px;">Submit</button>
            </div>

            <div hidden>
              <input type="number" name="formtype" >1</input>
              <input type="text" name="loaded"  id="loaded"value="0">
            </div>




          <div class="searchContainer"  id="searchCon" >

                  <?php
                require  'search.php';
                $sql = "Select * from drug where MATCH(Drugname) AGAINST('$search') LIMIT 0, 10";
                $result = $con->query($sql);
                if( $result->num_rows > 0 ) {
                   while( $row = $result->fetch_assoc() ){
                ?>

                   <div  role="button" onclick="document.location.href='sellingpage.php?ID=<?php echo $row['ID']; ?>' "  ><?php   echo $row[ "Drugname" ] ;  ?></div>
                   <hr>

              <?php }

            }

               ?>


             </div>
        </form>




        <div class="formdesign">
          <?php
          $GetDrugID=@$_GET['ID'];
            $sql2= "select  * from drug where ID='$GetDrugID'";
            $result2= $con->query($sql2);
            $row=$result2->fetch_assoc() ?>

         <form class="formConatainer" action="sellingpage.php" method="POST">

            <div class="">

                    <label for="named">Name of Drug</label><br>
                    <div class="LabeDesign">
                        <?php echo @$row["Drugname"];?>
                    </div>

                  <div class="">
                    <input type="text" name="named" id="named" value="<?php echo @$row["Drugname"];?>" hidden>
                  </div>

            </div><br>

            <!--<div class="">
              <label for="formsold">Unit of sale</label><br>
              <label class="labeldesign" for=""><?php echo @$row["Unit_per_Price"];?></label>
              <input type="option" name="formsold" id="formsold"value="<?php echo @$row["Unit_per_Price"];?>" hidden><br>
                <span> <?php echo $sellingp_err;?> </span>-
            </div><br>-->

            <div class="">
              <label for="sellP">Price</label><br>
              <div class="LabeDesign">
                  <?php echo @$row["Price"];?>
              </div>
              <input type="text" name="sellP" id="unitP"value="<?php echo @$row["Price"];?>"hidden ><br>
                <!--<span> <?php echo $sellingp_err;?> </span>-->
            </div><br>

            <div class="">
              <label for="numberd">Number Sold</label><br>
              <input type="number" name="numberd"  id="numberd" value="<?php echo $numberd;?>"><br>
                <!--<span><?php echo $numberd_err;?></span>-->
            </div><br>







            <div hidden>
               <input type="number"  name="formtype" hidden>2</input>
            </div>
            <input type="text" name="seaDrugcode" value="<?php echo @$row['Drugcode']; ?>" hidden >
            <input type="text" name="seaDrugID" value="<?php echo @$row['ID']; ?>" hidden>
            <input type="text" name="quantity" value="<?php echo @$row['quantity'];?>" hidden>



            <div class="">
              <button type="submit" name="submit">Sell</button>

            </div>
          </form>
        <?php
        $insertDrugname= @$row['Drugname'];
        $insertDrugcode=@$row['Drugcode'];
        $insertID=@$row['ID'];
        $insertUnitPerprice=@$row['Unit_per_Price'];
        $insertPrice=@$row['Price'];

        ?>
        </div>
      </div>

      <div class="tableContainer">
        <?php
        $today=Date("Y-m-d");
        $sql5= "select * from  drugstore.sold where saledate='$today'";
        $result=$con->query($sql5);
        $count=0;
        ?>
        <table id="tbdesign">
          <tr>
            <th>No-count </th>
            <th>Drugname </th>
            <th>Quantuty-sold </th>
            <th>UnitPrice </th>
            <th>(Ghc)SellingPrice </th>
          </tr>
          <?php while ($row=$result->fetch_assoc()) { $count++?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['drugname'] ;?></td>
            <td><?php echo $row['numberItems']; ?></td>
            <td><?php echo $row['unitryPrice'] ;?></td>
            <td><?php echo $row['sellingPrice'] ;?></td>
          </tr>
        <?php ;} ?>
        </table>
      </div>

    </div>

    <a href="userLogin.php">Home</a>

    <script type="text/javascript">
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
  </body>
</html>
