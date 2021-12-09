<?php
/* Start session*/
session_start();

 include_once "../.././database_p/drugstoreConnect.php";
 $dbcon=  new Drugstore();
 $con=$dbcon->connectdb();
 $offset = @$_GET["loaded"];
 $searchItem=@$_GET['searchItem'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inventory</title>
    <link rel="stylesheet" href="../../assets/css/inventorydesign.css">

  </head>
  <body >
    <div id="backbutton" role="button" onclick="document.location.href='.././userLogin.php'">
        Back To Main
    </div>
    <form class="" action="inventory.php" method="get">
      <div class="searchside">
        <input type="text" name="searchItem" value=""><button type="submit">Search</button>
      </div>
      <input type="text" name="loaded" value="0" hidden>
    </form>
    <button type="button" name="button" onclick="document.location.href='downloadExcellversion.php'">Create a CSV version</button>

    <div class="listbox">

      <?php
      if(!empty($_GET['searchItem'])){
        $sql= "Select * from drug where status='f' && MATCH(Drugname) AGAINST('$searchItem') LIMIT 0, 100";

      }else{
        $sql="Select * from drug where status='f'";

        }
      $result=$con->query($sql);
      while ($row=$result->fetch_assoc()){ ?>
        <span>
          <div class="listdesign"  onclick="document.location.href='stocktaker.php?ID=<?php echo $row['ID'];?>'"  role="button"> <?php echo $row['Drugname']; ?> </div>  <div class="">

          </div>
        </span>


  <?php
      }
      ?>


    </div>


  </body>
</html>
