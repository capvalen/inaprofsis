<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Docentes'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Docentes</h1>
					<p>Listado de docentes:</p>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Filtro" autocomplete="off">
						<button class="btn btn-outline-secondary" type="button" id="txtBuscar"><i class="bi bi-search"></i></button>
					</div>
				</div>
				<div class="table-responsive-md">
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Apellidos y nombres</th>
							<th>Representante</th>
							<th>Fecha</th>
							<th>Periodo</th>
							<th>Celular</th>
							<th>@</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
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
					<label for="">Especialidad</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Nombres</label>
					<input type="text" class="form-control">
					<label for="">Apellidos</label>
					<input type="text" class="form-control">
					<label for="">D.N.I.</label>
					<input type="text" class="form-control">
					<label for="">Fecha de nacimiento</label>
					<input type="date" class="form-control">
					<label for="">Celular 1</label>
					<input type="text" class="form-control">
					<label for="">Celular 2</label>
					<input type="text" class="form-control">
					<label for="">Correo 1</label>
					<input type="text" class="form-control">
					<label for="">Correo 2</label>
					<input type="text" class="form-control">
					<label for="">N° Registro Conciliador 1</label>
					<input type="text" class="form-control">
					<label for="">N° Registro Conciliador 2</label>
					<input type="text" class="form-control">
					<label for="">N° Registro Capacitador</label>
					<input type="text" class="form-control">
					<label for="">Dirección</label>
					<input type="text" class="form-control">
					<label for="">Lugar de trabajo</label>
					<input type="text" class="form-control">
					<label for="">N° Hijos</label>
					<input type="text" class="form-control">
					<label for="">Particuliaridades del docente</label>
					<textarea class="form-control" rows="3"></textarea>
					<label for="">Hoja de vida</label>
					<input type="file" class="form-control">
					<div class="d-grid mt-2">
						<button class="btn btn-outline-primary">Agregar docente</button>
					</div>
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php pie(); ?>

</body>
</html>