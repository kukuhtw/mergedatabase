<?php
/*
 ___  ____           __               __        _________  ____      ____ 
|_  ||_  _|         [  |  _          [  |      |  _   _  ||_  _|    |_  _|
  | |_/ /   __   _   | | / ] __   _   | |--.   |_/ | | \_|  \ \  /\  / /  
  |  __'.  [  | | |  | '' < [  | | |  | .-. |      | |       \ \/  \/ /   
 _| |  \ \_ | \_/ |, | |`\ \ | \_/ |, | | | |     _| |_       \  /\  /    
|____||____|'.__.'_/[__|  \_]'.__.'_/[___]|__]   |_____|       \/  \/  

github.com/kukuhtw

*/

$mySQLserver = "localhost";
	$mySQLuser = "root";
	$mySQLpassword = "";
	$mySQLdefaultdb = "databasec";
	$host = "localhost/databasec/";
	$folderweb="";
	$webhook = $host."/";
$link = mysqli_connect($mySQLserver, $mySQLuser, $mySQLpassword,$mySQLdefaultdb) or die ("Could not connect to MySQL");
?>