<?php

 $offset = @$_GET["loaded"];
 $search=@$_GET['search'];


 // connect to database
 $dbcon=  new Drugstore();
 $con=$dbcon->connectdb();
 // query the database, limiting results to 10 at a time starting from last loaded result



 // declare array variable to store oci_get_implicit_results








?>
