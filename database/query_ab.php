<?php
include("db_a.php");
$sql = " select a.id, a.name, a.email, b.userid, b.motorcycle 
from `user` a,`motorcycle` b 
where a.id = b.userid
 ";
//
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<h2>Database A</h2>";	
		foreach($conn->query($sql) as $row) {
				$id=$row['id'];
				$userid=$row['userid'];
				$name=$row['name'];
				$email=$row['email'];
				$motorcycle=$row['motorcycle'];
				$last_id_user = check_table_user_database_c_exist_c($email,$name);
				check_table_motorcar_c_exists($last_id_user,$email,$name,$motorcycle);

				echo "<br>Id : ".$id. " userid : ".$userid." Name:".$name." Email:".$email. " Motorcycle: ".$motorcycle;
			
			}

include("db_b.php");

$sql = " select a.id, a.name, a.email, b.userid, b.car
from `user` a,`cars` b 
where a.id = b.userid
 ";
//
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "<h2>Database B</h2>";	
		foreach($conn->query($sql) as $row) {
				$id=$row['id'];
				$userid=$row['userid'];
				$name=$row['name'];
				$email=$row['email'];
				$car=$row['car'];
				$last_id_user = check_table_user_database_c_exist_c($email,$name);
				check_table_cars_c_exists($last_id_user,$email,$name,$car);

				echo "<br>Id : ".$id. " userid : ".$userid." Name:".$name." Email:".$email. " car: ".$car;
			
			}

function check_table_motorcar_c_exists($userid,$email,$name,$motorcycle)
{
	include("db_c.php");
	$sql = "select count(id) as `total` from `motorcycle` where 
	`email`='$email' and `motorcycle`='$motorcycle' ";
	echo "<br>sql =".$sql;
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$total=0;
		foreach($conn->query($sql) as $row) {
				$total=$row['total'];
			}
	echo "<br>total =".$total;
	if ($total==0) {
		$sql="insert into `motorcycle` (`userid`,`email`,`name`,`motorcycle`) 
		values 
		('$userid','$email','$name','$motorcycle') ";
		$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
		$query=null;

	}

}

function check_table_cars_c_exists($userid,$email,$name,$car)
{
	include("db_c.php");
	$sql = "select count(id) as `total` from `cars` where 
	`email`='$email' and `car`='$car' ";
	echo "<br>sql =".$sql;
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$total=0;
		foreach($conn->query($sql) as $row) {
				$total=$row['total'];
			}
	echo "<br>total =".$total;
	if ($total==0) {
		$sql="insert into `cars` (`userid`,`email`,`name`,`car`) 
		values 
		('$userid','$email','$name','$car') ";
		$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
		$query=null;

	}

}

function check_table_user_database_c_exist_c($email,$name) {
	include("db_c.php");
	$sql = "select count(id) as `total` from `user` where `email`='$email'";
	echo "<br>sql =".$sql;
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$total=0;
		foreach($conn->query($sql) as $row) {
				$total=$row['total'];
			}
	echo "<br>total =".$total;
	$last_id=0;
	if ($total>=1) {
		$sql = "select `id` from `user` where `email`='$email'";
		$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		foreach($conn->query($sql) as $row) {
				$id=$row['id'];
				$last_id=$id;
			}
		return $last_id;	

	}
	if ($total==0) {
		$sql="insert into `user` (`email`,`name`) 
		values 
		('$email','$name') ";
		$last_id=0;
		//echo $sql;

		try {
				$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec($sql);
				$last_id = $conn->lastInsertId();
			}
		catch(PDOException $e)
		{
			$last_id=0;
		}
		
	}





return $last_id;
}		
?>