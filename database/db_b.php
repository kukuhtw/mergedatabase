<?php
$mySQLserver = "localhost";
	$mySQLuser = "root";
	$mySQLpassword = "";
	$mySQLdefaultdb = "databaseb";
	$host = "localhost/databaseb/";
	$folderweb="";
	$webhook = $host."/";
$link = mysqli_connect($mySQLserver, $mySQLuser, $mySQLpassword,$mySQLdefaultdb) or die ("Could not connect to MySQL");
?>