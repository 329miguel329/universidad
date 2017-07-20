<?php
	require_once("conection.php");
	//$query = $conn -> Select("")
	
	if(isset($_GET)){
		$sql = "SELECT * FROM " . $_GET['data'];
		$jasondata = $conn -> Select($sql);
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($jasondata, JSON_FORCE_OBJECT);
	}else{
		echo "No se recibio nada";
	}
?>