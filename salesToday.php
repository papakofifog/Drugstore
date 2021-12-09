<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/style.css">
  </head>
  <body>
    <div class="" role="button" onclick="document.location.href='.././Adminpage.php'" style="border-style:solid; background-color:blue; color:white; width:150px; height:50px;">
      Back
    </div>
    <div class="">
      <?php
      include_once "../.././database_p/drugstoreConnect.php";
      $dbcon=  new Drugstore();
      $con=$dbcon->connectdb();
      $today=Date("Y-m-d");
      $sql5= "select * from  drugstore.sold where saledate='$today'";
      $result=$con->query($sql5);
      $count=0;
      ?>
      <table>
        <tr>
          <th>Sold number</th>
          <th>Drugname</th>
          <th>form sold</th>
          <th>Number Sold</th>
          <th>unitPrice</th>
          <th>Selling Price</th>
        </tr>
        <?php while ($row=$result->fetch_assoc()) { $count++?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row['drugname'] ;?></td>
          <td><?php echo $row['formSold']; ?></td>
          <td><?php echo $row['numberItems']; ?></td>
          <td><?php echo $row['unitryPrice'] ;?></td>
          <td><?php echo $row['sellingPrice'] ;?></td>
        </tr>
      <?php ;} ?>
      </table>
    </div>

  </body>
</html>
