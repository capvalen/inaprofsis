<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Convenios'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Convenios</h1>	
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
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarResolucion(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarResolucion(resolucion.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<input type="number" class="form-control" min="1900" max="2099" step="1" value="<?= date('Y')?>" />
					<label for="">Resolución</label>
					<input type="text" class="form-control">
					<label for="">Fecha de resolución</label>
					<input type="date" class="form-control">
					<label for="">Tomo</label>
					<input type="text" class="form-control">
					<label for="">Tipo de evento</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Especialidad</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Código del curso</label>
					<input type="text" class="form-control">
					<label for="">Nombre del curso</label>
					<input type="text" class="form-control">
					<label for="">Fecha de desarrollo</label>
					<input type="text" class="form-control">
					<label for="">Docentes</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Horas académicas</label>
					<input type="number" min=1 class="form-control">
					<label for="">Convenio</label>
					<input type="text" class="form-control">
					<label for="">Link a la DB</label>
					<input type="text" class="form-control">
					<label for="">Observaciones</label>
					<textarea class="form-control" rows="3"></textarea>
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarResolucion()"><i class="bi bi-cloud-plus"></i> Agregar resolucion</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarResolucion()"><i class="bi bi-pencil-square"></i> Actualizar resolucion</button>
					</div>
					
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
</body>
</html>