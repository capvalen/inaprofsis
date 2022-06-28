<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Cursos'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Cursos</h1>
					<p>Listado de convenios por año:</p>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Filtro" autocomplete="off">
						<button class="btn btn-outline-secondary" type="button" id="txtBuscar"><i class="bi bi-search"></i></button>
					</div>
				</div>
				<div class="table-responsive-md">
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Entidad</th>
							<th>Representante</th>
							<th>Fecha</th>
							<th>Periodo</th>
							<th>Celular</th>
							<th>@</th>
					
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>San Pedro Gallo de Juliaca</td>
								<td>Luis Garcia Meza</td>
								<td>14/05/2022</td>
								<td>2000-2030</td>
								<td>965200087</td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0"><i class="bi bi-x-circle-fill"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
			<div class="col-12 col-md-5 col-lg-3 my-3">
				<div class="card">
					<div class="card-body">

					<p class="fw-bold">Ingreso nuevo registro</p>
					<label for="">Año</label>
					<input type="text" class="form-control">
					<label for="">Tipo de programa</label>
					<select class="form-select" id="">
						<option value="1">CONCILIACIÓN</option>
						<option value="2">CURSOS ESPECIALIZADOS</option>
						<option value="3">CURSOS ESPECIALIZADOS ASINCRÓNICOS</option>
					</select>
					<label for="">Tipo de evento</label>
					<select class="form-select" id="">
						<option value="1">Curso Conciliación</option>
						<option value="2">Especialización</option>
						<option value="2">Curso de Especializaión</option>
						<option value="3">Seminario</option>
						<option value="3">Taller</option>
					</select>
					<label for="">Nombre de curso</label>
					<input type="text" class="form-control">
					<label for="">Acuerdos del convenio</label>
					<textarea class="form-control" rows="3"></textarea>
					<label for="">Autoridades por año</label>
					<textarea class="form-control" rows="3"></textarea>
					<label for="">Teléfono</label>
					<input type="text" class="form-control">
					<label for="">Celular</label>
					<input type="text" class="form-control">
					<label for="">Web</label>
					<input type="text" class="form-control">
					<label for="">Categoría</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Observaciones</label>
					<textarea class="form-control" rows="3"></textarea>
					<div class="d-grid mt-2">
						<button class="btn btn-outline-primary">Agregar convenio</button>
					</div>
					
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php pie(); ?>

</body>
</html>