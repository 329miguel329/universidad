<?php
	require_once("conection.php");
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_GET)){
		$sql = "INSERT INTO estudiante VALUES(NULL,'" . $_GET["nombre"] . "','" . $_GET["apellido"] . "'," . $_GET["edad"] . ", " . $_GET["genero"] . ", " . $_GET["semestre"] . ", " . $_GET["carrera"] . ", " . $_GET["nacionalidad"] . ")";
		$insert = $conn -> Insert($sql);
		if(isset($insert["error"])){
			echo $insert["error"];
		}else{
			echo 1;
		}
	}else{
		echo "ERROR...";
	}
?>