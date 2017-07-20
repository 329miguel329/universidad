<?php
	require_once('CRUD.php');
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$database_name = "universidad";
	$conn = new CRUD($host, $user, $pass, $database_name);
?>