<?php
// Original PHP code by Chirp Internet: www.chirpinternet.eu
// include the database connection
include_once "../.././database_p/drugstoreConnect.php";
$ExcelConn= new Drugstore();
$CreatExcel=$ExcelConn->connectdb();
function cleanData(&$str){
  if($str == 't') $str='TRUE';
  if($str == 'f') $str='FALSE';
  if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    //$str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
}

// filename to download

$filename = "Drug Stock for" .date('Ymd') . ".csv";

header("Content-Disposition: attatchment; filename=\"$filename\"");
header("Content-Type: text/csv");

//header("Content-Type: text/csv; charset=UTF-16LE");

$out = fopen("php://output", 'w');
$sql= 'SELECT * FROM drugstore.inventorytake';

$flag =false;
$result= $CreatExcel->query($sql);
while($row =$result->fetch_assoc()) {
    if(!$flag) {
      // display field/column names as first row
      fputcsv($out, array_keys($row), ',', '"');
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }

  fclose($out);
  exit;



?>
