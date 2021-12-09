<?php

class  DrugStore{

	public $mysqli;
	public $conner;
	public $pgconn;



	function connectdb(){
		$mysqli=mysqli_connect('localhost','root', '500@yolanda' ,'drugstore');
		return $mysqli;

	}
	function PDOConnect(){
		$servername='localhost';
		$username= 'root';
		$password= '';
		$dbname='drugstore';
		$connner= new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	//	return $conner;
	}

	function Pgconn(){
		$hostname='localhost';
		$dbname= 'drugstore';
		$username='root';
		$password='';
		$pgconn= pg_connect("host =$hostname dbname=$dbname user=$username pass=$password");
		return $pgconn;
	}


}

?>
