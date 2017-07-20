<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" href="index.php">Universidad</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Listado de estudiantes</a></li>
				<li><a href="carrera.php">Carrera</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Edades
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="edad.php?edad_init=18&edad_finish=21">Entre 18 - 21</a></li>
						<li><a href="edad.php?edad_init=22&edad_finish=30">Entre 22 - 30</a></li>
						<li><a href="edad.php?edad_init=30">Mayores de 30</a></li>
					</ul>
				</li>
				<li><a href="nacionalidad.php">Nacionalidad</a></li>
			</ul>
		</div>
	</div>
</nav>