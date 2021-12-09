<?php
include_once "../.././database_p/drugstoreConnect.php";

$dbcon=  new Drugstore();
$con=$dbcon->connectdb();
$searItem=@$_GET['SearchHere'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inventory</title>
    <link rel="stylesheet" href="../../assets/css/Admin.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <script type="text/javascript" src="../../assets/js/selling.js">

    </script>
  </head>
  <body>
    <br>
    <br>
    <div  role="button" onclick="document.location.href='.././Adminpage.php'" style="border-style:solid; width:100px; background-color:blue; color:white; font-size: 20px;border-radius:10px; height:40px; text-align:center;">
      Home
    </div>


    <div class="container">
      <h3 class="col-md-12 py-3 my-3" style="background: grey; color: white">Available Drugs in Inventory
        <div class="">
          <form class="" action="Drugssoldtoday.php" method="get">
            <label for="SearchHere">Search here</label>
            <input type="text" name="SearchHere" value="">
            <button type="submit" name="button">Search</button>
          </form>
        </div>
      </h3>
      <div class="row text-center">
        <?php
        if(empty($_GET['SearchHere'])){
          $sql="Select * from drug";

        }else {
          $sql= "Select * from drug where  MATCH(Drugname) AGAINST('$searItem') limit 0,100";
        }

        $result= $con->query($sql);
        $i=0;
        //echo 6%3;
        while ($row=$result->fetch_assoc()  ) {
          ?>
          <div class="col-md-3 col-sm-6 my-3 my-md-10">
            <div  class="card shadow">
              <div >
                <img class="img-fluid card-img-top" src="../../assets/pictures/drugs.webp" alt="Picture of the drug">
              </div>
                <div class="card-body">

                  <div class="" role="button"  onclick="document.location.href='Drugssoldtoday.php?ID=<?php echo $row['ID'];?>'">
                    <h5 >  <?php echo $row['Drugname'];?></h5>
                      <h5><?php $drugNumber=$row['quantity']; echo $row['quantity'];?></h5>
                    </div>
                    <div class="">
                      <div id="Add25700" role="button"  onclick="document.location.href='increaseDrugQuanity.php?ID=<?php echo $row["ID"];?>'">
                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="40px" height="30px"><path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24 13 L 24 24 L 13 24 L 13 26 L 24 26 L 24 37 L 26 37 L 26 26 L 37 26 L 37 24 L 26 24 L 26 13 L 24 13 z"/></svg>
                      </div>


                    </div>

                </div>
              </div>

            </div>
              <?php  }   ?>

        </div>
      </div>
      <script type="text/javascript">
        if(window.history.replaceState){
          window.history.replaceState(null,null,window.location.href);
        }
      </script>


  </body>
</html>
