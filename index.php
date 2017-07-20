<?php
	//Este archivo contiene la conexion a la base de datos local y se guarda en la variable $conn
	require_once("controller/conection.php");
	
	//Esta es la consulta que se hace a la base de datos general; la consulta se guarda en la variable $consulta
	$consulta = $conn -> Select("SELECT est.id id_est, est.nombre nombre, est.apellido apellido, est.edad edad, gen.id id_gen, gen.name genero, sem.id id_sem, sem.name semestre, car.id id_car, car.name carrera, nac.id id_nac, nac.name nacionalidad
								FROM estudiante est
								LEFT JOIN genero gen ON est.id_genero = gen.id
								LEFT JOIN semestre sem ON est.id_semestre = sem.id
								LEFT JOIN carrera car ON est.id_carrera = car.id
								LEFT JOIN nacionalidad nac ON est.id_nacionalidad = nac.id
								WHERE 1 ORDER BY est.id");

	//Si hubo algún error en la consulta se mostrara en el siguiente bloque el error ocurrido
	if(isset($consulta["error"])){
		die ($consulta["error"]);
	}
	
	//Este bloque inicializa a variable $_SESSION si aún no esta inicializada
	if (!isset($_SESSION)){
		session_start();
	}
	//Esta variable se utiliza para ocultar los id de los usuarios multiplicandolo con el siguiente numero aleatorio
	//y poderlos utilizar en diferentes elementos del documento HTML
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
		<!-- Aqui incluyo el menu principal de todo el aplicativo web -->
		<?php require_once("menu.php"); ?>
		<!-- En la siguiente linea de codigo imprimo la cantidad de estudiantes que se obtuvo de la consulta anterior-->
		<?php echo "<h4>Cantidad total de estudiantes: " . $consulta["num_results"] . "<br /></h4>";?>
		<button class="btn btn-success btn-circle btn-lg" onclick="javascript: load_form('form-create-user.php', 0, 'create-user')" title="Crear estudiante"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
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
					for($i = 0; $i < $consulta["num_results"]; $i++){
			?>
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["nombre"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["apellido"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["edad"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["genero"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["carrera"];?>
							</td>
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["semestre"];?>
							</td>							
							<td  style="vertical-align: middle;">
								<?php echo $consulta["results"][$i]["nacionalidad"];?>
							</td>
							<td  style="vertical-align: middle;">
								<button id="<?php echo ($consulta["results"][$i]["id_est"] * $_SESSION["id_divs"]);?>" class="btn btn-warning btn-circle btn-lg" onclick="javascript: load_form('form-update-user.php', this.id, 'update-user')" title="Modificar estudiante"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
								&nbsp&nbsp
								<button id="<?php echo ($consulta["results"][$i]["id_est"] * $_SESSION["id_divs"]);?>" class="btn btn-danger btn-circle btn-lg" onclick="javascript: confirm_delete(this.id)" title="Eliminar estudiante"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
							</td>
						</tr>
			<?php
					}
				}
			?>
					<tr>
						<td colspan="8" align="center"><button class="btn btn-success btn-circle btn-lg-palabra" onclick="javascript: load_form('form-create-user.php', 0, 'create-user')" title="Crear estudiante"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear nuevo estudiante</button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>