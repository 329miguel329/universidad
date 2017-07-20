<?php
	if (!isset($_SESSION)){
		session_start();
	}
	require_once("../controller/conection.php");
	$consult = $conn -> Select("SELECT est.id id_est, est.nombre nombre, est.apellido apellido, est.edad edad, gen.id id_gen, gen.name genero, sem.id id_sem, sem.name semestre, car.id id_car, car.name carrera, nac.id id_nac, nac.name nacionalidad
								FROM estudiante est
								LEFT JOIN genero gen ON est.id_genero = gen.id
								LEFT JOIN semestre sem ON est.id_semestre = sem.id
								LEFT JOIN carrera car ON est.id_carrera = car.id
								LEFT JOIN nacionalidad nac ON est.id_nacionalidad = nac.id
								WHERE est.id=" . ($_GET["id_div"] / $_SESSION["id_divs"]));
	if(isset($consult["error"])){
		die ($consult["error"]);
	}
?>
<div class="col-md-12" id="d-form-update-user">
	<div class="col-md-12" align="center">
		<h4>Formulario de Actualización</h4>
	</div>
	<form onsubmit="return false" id="f-update-user">
		<div class="col-md-12">
			<div class="form-group">
				<label>Nombre</label>
				<div class="input-group">
					<span class="input-group-addon" id="sp-nombre"><i class="fa fa-address-card fa-2x fa-fw" aria-hidden="true"></i></span>
					<input type="text" class="form-control input-lg" id="i-nombre"  name="nombre" placeholder="Nombre" value="<?php echo $consult["results"][0]["nombre"]; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label>Apellido</label>
				<div class="input-group">
					<span class="input-group-addon" id="sp-apellido"><i class="fa fa-address-card fa-2x fa-fw" aria-hidden="true"></i></span>
					<input type="text" class="form-control input-lg" id="i-apellido"  name="apellido" placeholder="Apellido" value="<?php echo $consult["results"][0]["apellido"]; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label>Edad</label>
				<div class="input-group">
					<span class="input-group-addon" id="sp-edad"><i class="fa fa-calendar fa-2x fa-fw" aria-hidden="true"></i></span>
					<input type="text" class="form-control input-lg" id="i-edad" name="edad" placeholder="edad" value="<?php echo $consult["results"][0]["edad"]; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label>Genero</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-genero"><i class="fa fa-venus-mars fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-genero" name="genero">
						<option value="<?php echo $consult["results"][0]["id_gen"]; ?>" selected="selected"><?php echo $consult["results"][0]["genero"]; ?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Semestre</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-semestre"><i class="fa fa-university fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-semestre" name="semestre">
						<option value="<?php echo $consult["results"][0]["id_sem"]; ?>" selected="selected"><?php echo $consult["results"][0]["semestre"]; ?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Carrera</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-carrera"><i class="fa fa-graduation-cap fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-carrera" name="carrera">
						<option value="<?php echo $consult["results"][0]["id_car"]; ?>" selected="selected"><?php echo $consult["results"][0]["carrera"]; ?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Nacionalidad</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-nacionalidad"><i class="fa fa-flag fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-nacionalidad" name="nacionalidad">
						<option value="<?php echo $consult["results"][0]["id_nac"]; ?>" selected="selected"><?php echo $consult["results"][0]["nacionalidad"]; ?></option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12" align="center">
			<button id="<?php echo $_GET["id_div"]; ?>" type="submit" class="btn btn-primary btn-lg" onclick="javascript: submit_form_updateUser(this.id)">Actualizar estudiante</button>
		</div>
	</form>
	<div class="col-md-12" id="errors">
		
	</div>
</div>