<?php
	require_once("controller/conection.php");
	if(!isset($_GET["edad_init"])){
		die("No se recibio ningun dato");
	}else if(!isset($_GET["edad_finish"])){
		$consulta = $conn -> Select("SELECT est.id id_est, est.nombre nombre, est.apellido apellido, est.edad edad, gen.id id_gen, gen.name genero, sem.id id_sem, sem.name semestre, car.id id_car, car.name carrera, nac.id id_nac, nac.name nacionalidad
									FROM estudiante est
									LEFT JOIN genero gen ON est.id_genero = gen.id
									LEFT JOIN semestre sem ON est.id_semestre = sem.id
									LEFT JOIN carrera car ON est.id_carrera = car.id
									LEFT JOIN nacionalidad nac ON est.id_nacionalidad = nac.id
									WHERE est.edad > " . $_GET["edad_init"]);
	}else{
		$consulta = $conn -> Select("SELECT est.id id_est, est.nombre nombre, est.apellido apellido, est.edad edad, gen.id id_gen, gen.name genero, sem.id id_sem, sem.name semestre, car.id id_car, car.name carrera, nac.id id_nac, nac.name nacionalidad
									FROM estudiante est
									LEFT JOIN genero gen ON est.id_genero = gen.id
									LEFT JOIN semestre sem ON est.id_semestre = sem.id
									LEFT JOIN carrera car ON est.id_carrera = car.id
									LEFT JOIN nacionalidad nac ON est.id_nacionalidad = nac.id
									WHERE est.edad BETWEEN " . $_GET["edad_init"] . " AND " . $_GET["edad_finish"]);
	}

	if(isset($consulta["error"])){
		die ($consulta["error"]);
	}
	
	if (!isset($_SESSION)){
		session_start();
	}
	$_SESSION["id_divs"] = rand(3, 29);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Universidad</title>
	
	<link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="plugins/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css" />
	<link rel="stylesheet" type="text/css" href="plugins/select2/css/select2-bootstrap.css" />
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	
	<script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="plugins/jquery/jquery.number.js"></script>
	<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="plugins/select2/js/select2.full.js"></script>
	<script type="text/javascript" src="plugins/bootbox/bootbox.min.js"></script>
	
	<script type="text/javascript" src="js/generales.js"></script>
</head>
<body>
	<div class="d-principal" align="center">
		<?php require_once("menu.php"); ?>
		
		<?php
			echo (isset($_GET["edad_finish"]))? "<h4>Edaddes entre: " . $_GET["edad_init"] . " - " . $_GET["edad_finish"] . " años de edad<br />Cantidad de estudiantes: " . $consulta["num_results"] . "<br /></h4>" : "<h4>Edaddes mayores a: " . $_GET["edad_init"] . " años de edad<br />Cantidad de estudiantes: " . $consulta["num_results"] . "<br /></h4>";
		?>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>
							Nombre
						</th>
						<th>
							Apellido
						</th>
						<th>
							Edad
						</th>
						<th>
							Sexo
						</th>
						<th>
							Carrera
						</th>
						<th>
							Semestre
						</th>
						<th>
							Nacionalidad
						</th>
						<th>
							Opciones
						</th>
					</tr>
				</thead>
				<tbody>
			<?php
				if($consulta["num_results"] > 0){
					for($j = 0; $j < $consulta["num_results"]; $j++){
			?>
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["nombre"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["apellido"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["edad"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["genero"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["carrera"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["semestre"];?>
							</td>							
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$j]["nacionalidad"];?>
							</td>
							<td  style="vertical-align: middle;">
								<button id="<?php echo ($consulta["results"][$j]["id_est"] * $_SESSION["id_divs"]);?>" class="btn btn-warning btn-circle btn-lg" onclick="javascript: load_form('form-update-user.php', this.id, 'update-user')" title="Modificar estudiante"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
								&nbsp&nbsp
								<button id="<?php echo ($consulta["results"][$j]["id_est"] * $_SESSION["id_divs"]);?>" class="btn btn-danger btn-circle btn-lg" onclick="javascript: confirm_delete(this.id)" title="Eliminar estudiante"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
							</td>
						</tr>
			<?php
					}
				}
			?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>