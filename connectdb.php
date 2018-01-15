<?php 
	$server="localhost";
	$database="backstreetacademy";
	$username="root";
	$password="";

	mysql_connect($server,$username,$password)
		or die ("GAGAL TERHUBUNG");
	mysql_select_db($database)
		or die ("Database Tidak Ada");
 ?>
