<?php
	require_once("conection.php");
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_GET)){
		$sql = "UPDATE estudiante SET nombre='" . $_GET["nombre"] . "', apellido='" . $_GET["apellido"] . "', edad=" . $_GET["edad"] . ", id_genero=" . $_GET["genero"] . ", id_semestre=" . $_GET["semestre"] . ", id_carrera=" . $_GET["carrera"] . ", id_nacionalidad=" . $_GET["nacionalidad"] . " WHERE id=" . ($_GET["id_est"] / $_SESSION["id_divs"]);
		$insert = $conn -> UpdateDelete($sql);
		if(isset($insert["error"])){
			echo $insert["error"];
		}else{
			echo 1;
		}
	}else{
		echo "ERROR...";
	}
?>