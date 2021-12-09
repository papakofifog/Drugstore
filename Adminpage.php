<?php
session_start();
include_once ".././database_p/drugstoreConnect.php";
$dbcon=  new Drugstore();
$con=$dbcon->connectdb();
$today=Date("Y-m-d");
$sql5= "select * from  drugstore.sold where saledate='$today'";
$result=$con->query($sql5);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href=".././assets/css/Admin.css">
    <link rel="stylesheet" href=".././assets/css/responsive.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <style media="screen">
  #tbdesign {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #tbdesign td, #thead001 th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #tbdesign tr:nth-child(even){background-color: #f2f2f2;}

  #tbdesign tr:hover {background-color: #ddd;}

  #tbdesign th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color:  rgba(55, 107, 135);
    color: white;
  }

  </style>

  <div  class="AdminPageContainer">
    <div class="sideAdmintab">
      <div class="">
        <br>
        <br>
        <br>
        <br>
        <div class="buttonContainer"style="background-color:rgba(43,130,105,1);color:white;" role="button" onclick="document.location.href='./Inventorysytem/salesToday.php'">
          View Today's Sales
        </div>
        <div onclick="document.location.href='./SystemInventorytaker.php'" class="buttonContainer"style="background-color:rgba(43,130,105,1);color:white;" role="button">
          Take Inventory
        </div>
        <div onclick="document.location.href='./Inventorysytem./Drugssoldtoday.php'"class="buttonContainer" style="background-color:rgba(43,130,105,1);color:white;" >
          See Available drugs
        </div>
        <div class="buttonContainer" onclick="document.location.href='./addNewDrug.php'">
          Add New Drug
        </div>

        <div onclick="document.location.href='./AccountPage.php'"class="buttonContainer" style="background-color:rgba(43,130,105,1); color:white;" role="button" >
          Account Setting
        </div>
      </div>



  </div>

    <div class="bodyContainer1" >

      <div class="drugstoreBanner">
        Welcome to Ekasante DrugStore
        <span class="" role="button" onclick="document.location.href='.././login/logout.php'" style="float:right; border-style:solid; border-radius: 10px; font-size:20px; color:red; width:100px;">
          LogOut
        </span>
      </div>

      <div class="">
        <?php
        if(date("a")=="am"){
          echo "Good Morning Mr. " . $_SESSION["firstname"];
        }else{
          echo "Good Afternoon Mr. ".$_SESSION["firstname"];
        }
         ?>
      </div>

     <div style="display:flex;">
       <div class="visualiztionSales" style="background-color: rgba(55, 107, 135);
       color: rgba(255, 252, 252);">
         Total Sales Today
         <?php $salesT= "Select sellingPrice from drugstore.sold  where saledate='$today'";
         $result=$con->query($salesT);
         $sum=$final=0;
         while($row=$result->fetch_assoc()){
           $sum=$sum+$row['sellingPrice'];
         }
         echo "<br>". $sum;
         ?>
       </div>
       <div class="visualiztionSales" style="  background-color: rgba(55, 107, 135);
         color: rgba(255, 252, 252);">
         Total Available Drugs in Inventory <?php $numberSalesT= "Select ID from drugstore.drug where quantity>=1";
         $result2=$con->query($numberSalesT);
         $count2=0;
        while( $number=$result2->fetch_assoc()){
          $count2++;
        };
         echo "<br>". $count2;

         ?>
       </div>
       <div class="visualiztionSales" style="  background-color: rgba(55, 107, 135);
         color: rgba(255, 252, 252);">
         Total Sales For the month of <?php  $month=is_integer(Date("m"));
         $CalendarMonths= ["January", "Feburay","March","April", "May","June","July","August","September","October","November","December"];
         $calenNumber=[0,1,2,3,4,5,6,7,8,9,10,11];
         $MonNumber=7;
         $currentyear=Date("y");
         $curentMonth=Date("m");
         $currentday=Date("d");
          if($currentday==01){
            $MonNumber++;

          }elseif ($curentMonth==01) {
            $MonNumber=0;
          }
          echo "<br>". $CalendarMonths[$calenNumber[$MonNumber]];
         ?>

       </div>
     </div>
     <br>
     <br>
     <div class="druglefAlert">
       <div>Please restock these drugs </div>
       <div class="durgsAlmostfinishCont">
         <?php
         $sql6= "Select Drugname,quantity from drugstore.drug where quantity<=2 order by quantity;";
         $result3= $con->query($sql6);
         ?>
         <table id="tbdesign">
           <tr>
             <th>No</th>
           <th>Drug Name</th>
           <th>Quantity Left</th>
         </tr>

           <?php
           $count=0;
         while ($row=$result3->fetch_assoc()) {$count++?>
           <tr>
             <td><?php echo $count; ?></td>
             <td> <?php echo  $row['Drugname'] ;?></td>
             <td><?php echo $row['quantity'];?></td>
           </tr>

           <?php
         ;}


       ?></table>
       </div>
     </div>
     <br>
     <br>
     <div class="Graph">
       <div class="col-lg-6">
                            <section class="panel">
                                <header class="panel-heading">
                                    Bar
                                </header>
                                <div class="panel-body text-center">
                                    <canvas id="bar" height="300" width="500"></canvas>
                                </div>
                            </section>
                        </div>
     </div>



    </div>
  </div>


</body>
</html>
