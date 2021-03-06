<?php
function cabecera($titulo){
	?>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $titulo ." - INAPROF INTRANET"; ?></title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
	<?php
}
?>

<?php
function pie(){ ?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue@3"></script>

<?php
}
?>

<?php
function menu(){ ?>
<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
	<div class="container">
		<a class="navbar-brand" href="#">
      <img src="https://inaprof.com/wp-content/uploads/2020/05/inaprof_blanco_peque2.png" >
    </a>
		
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Interno
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="convenios.php">Convenios</a></li>
						<li><a class="dropdown-item" href="docentes.php">Docentes</a></li>
						<li><a class="dropdown-item" href="resoluciones.php">Resoluciones <span class="text-decoration-line-through">(pendiente)</span></a></li>
						<li><a class="dropdown-item" href="cursos.php">Cursos</a></li>
						<li><a class="dropdown-item" href="#">Alumnos</a></li>
						<li><a class="dropdown-item" href="#">Colaboradores</a></li>
						<li><a class="dropdown-item" href="#">Agenda colaboradores</a></li>
						<li><a class="dropdown-item" href="#">C??digos</a></li>
						<li><a class="dropdown-item" href="#">Informes</a></li>
						<li><a class="dropdown-item" href="#">Oficios</a></li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
</nav>
<?php
}
?>