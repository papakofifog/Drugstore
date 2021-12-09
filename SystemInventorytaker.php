<?php
// get  a connection to the drugstore database.
include_once '.././database_p/drugstoreConnect.php';
$Dbcon=new Drugstore();
$conn=$Dbcon->connectdb();
// get the database connection instance.
$newConn=$Dbcon->connectdb();

// The last Id in the drug table.
$lastID= "Select count(ID) from drugstore.drug";
$result=$newConn->query($lastID);
$row=$result->fetch_assoc();
// select all the drugs in the systems drug porfolio.
function SeleectDrug($selectedID){
$sql="Select ID from drug where ID='$selectedID'";
$result=$newConn->query($sql);
$row= $result->fetch_assoc();
return $row;
}







 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Take Stock</title>
   </head>
   <body>
     <!-- Form to determine the month interval the user wants to take the inventory.-->
     <p> Specify the Month you want to take stock of</p>
     <form class="" action="SystemInven" method="post">
       <label for="monthN">Month Name</label>
       <input type="text" id="monthN" name="monthN"   value="">
     </form>
   </body>
 </html>
