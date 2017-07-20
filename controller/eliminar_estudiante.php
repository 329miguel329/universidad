<?php
	require_once("conection.php");
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_GET)){
		$sql = "DELETE FROM estudiante WHERE id=" . ($_GET["id_est"] / $_SESSION["id_divs"]);
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