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
					<label for="">Código de curso</label>
					<input type="text" class="form-control">
					<label for="">Modalidad</label>
					<select class="form-select" id="">
						<option value="1">Presencial</option>
						<option value="2">Virtual online</option>
						<option value="2">Virtual asíncrono</option>
						<option value="3">Híbrido</option>
					</select>
					<label for="">Fecha de inicio</label>
					<input type="date" class="form-control">
					<label for="">Fechas de desarrollo (link)</label>
					<input type="text" class="form-control">
					<label for="">Horas académidas</label>
					<select class="form-select" id="">
						<option value="1">160</option>
						<option value="2">240</option>
						<option value="2">60</option>
						<option value="3">24</option>
						<option value="4">12</option>
					</select>
					<label for="">Convenio</label>
					<select class="form-select" id="">
						<option value="1">MINJUS</option>
						<option value="2">CAL</option>
						<option value="3">CAJ</option>
						<option value="4">CEC</option>
						<option value="5">CAC</option>
					</select>
					<label class="fw-bold">Precios</label>
					<div class="row row-cols-2">
						<div class="col">
							<label for="">General</label>
							<input type="number" class="form-control">
						</div>
						<div class="col">
							<label for="">Ex alumnos</label>
							<input type="number" class="form-control">
						</div>
						<div class="col">
							<label for="">Corporativo</label>
							<input type="number" class="form-control">
						</div>
						<div class="col">
							<label for="">Pronto pago</label>
							<input type="number" class="form-control">
						</div>
						<div class="col">
							<label for="">Remate</label>
							<input type="number" class="form-control">
						</div>
						<div class="col">
							<label for="">Media beca</label>
							<input type="number" class="form-control">
						</div>
						<div class="col">
							<label for="">Especial</label>
							<input type="number" class="form-control">
						</div>
					</div>
					<label for="">Docente original</label>
					<select class="form-select" id="">
						<option value="-1">NINGUNO</option>
						<option value="1">PARIONA VALENCIA CARLOS</option>
						<option value="2">GUZMAN OSORIO MELISA</option>
						<option value="3">HERRERA CHAVEZ GIOVANA</option>
					</select>
					<label for="">Docente de reemplazo</label>
					<select class="form-select" id="">
						<option value="-1">NINGUNO</option>
						<option value="1">PARIONA VALENCIA CARLOS</option>
						<option value="2">GUZMAN OSORIO MELISA</option>
						<option value="3">HERRERA CHAVEZ GIOVANA</option>
					</select>
					<label for="">Temario</label>
					<input type="text" class="form-control">
					<label for="">Tipo de certificado</label>
					<select class="form-select" id="">
						<option value="1">Físico</option>
						<option value="2">Digital</option>
						<option value="3">Digital y físico</option>
					</select>
					<label for="">Brochure (link)</label>
					<input type="text" class="form-control">
					<label for="">Etapa del curso</label>
					<select class="form-select" id="">
						<option value="1">- POR INICIAR</option>
						<option value="2">EN CURSO</option>
						<option value="3">PROCESO DE CERTIFICACIÓN</option>
						<option value="4">PROCESO DE ACREDITACIÓN</option>
					</select>
					<label for="">Detalles</label>
					<textarea class="form-control" rows="3"></textarea>
					<label for="">Data de alumnos (link)</label>
					<input type="text" class="form-control">
					<label for="">Vacantes disponibles</label>
					<input type="text" class="form-control">

					<div class="d-grid mt-2">
						<button class="btn btn-outline-primary">Agregar curso</button>
					</div>
					
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php pie(); ?>

</body>
</html>