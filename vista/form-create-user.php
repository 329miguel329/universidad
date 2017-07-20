<div class="col-md-12" id="d-form-create-user">
	<div class="col-md-12" align="center">
		<h4>Formulario de Creación</h4>
	</div>
	<form onsubmit="return false" id="f-create-user">
		<div class="col-md-12">
			<div class="form-group">
				<label>Nombre</label>
				<div class="input-group">
					<span class="input-group-addon" id="sp-nombre"><i class="fa fa-address-card fa-2x fa-fw" aria-hidden="true"></i></span>
					<input type="text" class="form-control input-lg" id="i-nombre"  name="nombre" placeholder="Nombre" />
				</div>
			</div>
			<div class="form-group">
				<label>Apellido</label>
				<div class="input-group">
					<span class="input-group-addon" id="sp-apellido"><i class="fa fa-address-card fa-2x fa-fw" aria-hidden="true"></i></span>
					<input type="text" class="form-control input-lg" id="i-apellido"  name="apellido" placeholder="Apellido" />
				</div>
			</div>
			<div class="form-group">
				<label>Edad</label>
				<div class="input-group">
					<span class="input-group-addon" id="sp-edad"><i class="fa fa-calendar fa-2x fa-fw" aria-hidden="true"></i></span>
					<input type="text" class="form-control input-lg" id="i-edad" name="edad" placeholder="edad" />
				</div>
			</div>
			<div class="form-group">
				<label>Genero</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-genero"><i class="fa fa-venus-mars fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-genero" name="genero">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Semestre</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-semestre"><i class="fa fa-university fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-semestre" name="semestre">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Carrera</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-carrera"><i class="fa fa-graduation-cap fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-carrera" name="carrera">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Nacionalidad</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-nacionalidad"><i class="fa fa-flag fa-2x fa-fw" aria-hidden="true"></i></span>
					<select class="form-control input-lg" id="s-nacionalidad" name="nacionalidad">
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12" align="center">
			<button type="submit" class="btn btn-primary btn-lg" onclick="javascript: submit_form_createUser()">Crear estudiante</button>
		</div>
	</form>
	<div class="col-md-12" id="errors">
		
	</div>
</div>