<?php
function cabecera($titulo){
	?>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $titulo ." - INAPROF INTRANET"; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="shortcut icon" href="https://esderecho.pe/wp-content/uploads/2022/11/favicon.png" type="image/png">
</head>
	<?php
}
?>

<?php
function pie(){ ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
}
?>

<?php
function menu(){ ?>
<nav class="navbar navbar-dark bg-morado navbar-expand-lg" style="background-color: #7933F9;">
	<div class="container">
		<a class="navbar-brand" href="principal.php">
      <img src="https://esderecho.pe/wp-content/uploads/2022/06/esDerecho_transparente-300x66.png" >
    </a>
		
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mb-2 mb-lg-0">
				<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="principal.php"><i class="bi bi-house"></i> Principal</a>
        </li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="bi bi-speedometer2"></i> Interno
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="convenios.php">Convenios</a></li>
						<li><a class="dropdown-item" href="docentes.php">Docentes</a></li>
						<li><a class="dropdown-item" href="resoluciones.php">Resoluciones</a></li>
						<li><a class="dropdown-item" href="cursos.php">Cursos</a></li>
						<li><a class="dropdown-item" href="alumnos.php">Alumnos</a></li>
						<li><a class="dropdown-item" href="colaboradores.php">Colaboradores</a></li>
						<!-- <li><a class="dropdown-item" href="#">Códigos</a></li> -->
						<li><a class="dropdown-item" href="informes.php">Informes</a></li>
						<li><a class="dropdown-item" href="oficios.php">Oficios</a></li>
					</ul>
				</li>
			</ul>

			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle active" href="#" id="navbarVentas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="bi bi-easel2"></i> Ventas
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarVentas">
						<li><a class="dropdown-item" href="prospecto_curso.php">Cursos de Prospectos </a></li>
						<li><a class="dropdown-item" href="#!">Verificar pagos </a></li>
						<li><a class="dropdown-item" href="#!">Delivery's </a></li>
					</ul>
				</li>
				<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="configuraciones.php"><i class="bi bi-gear-wide"></i> Configuraciones</a>
        </li>
			</ul>

		</div>
	</div>
</nav>
<?php
}
?>