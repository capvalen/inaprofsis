<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Alumno'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12">
				<div class="row col p-4">
					<h1>Alumno: <small class="text-muted text-capitalize">{{alumno.nombres}} {{alumno.apellidos}}</small></h1>
				</div>

				<div class="card">
					<div class="card-body">
				
					<p><strong>Datos Generales:</strong></p>
					<div class="row row-cols-2 row-cols-md-5">
						<div class="col">
							<p><strong>Código:</strong> <span>{{alumno.id}}</span></p>
						</div>
					</div>
						
					</div>
				</div>

				<div class="card my-3">
					<div class="card-body">

					</div>
				</div>


				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<p>Lista de matriculados</p>
							<button class="btn btn-sm btn-outline-success"><i class="bi bi-person-bounding-box"></i> Matricular alumno</button>
						</div>
						<div class="table-responsive-md">
		
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Nombre</th>
									<th>Programa</th>
									<th>Evento</th>
									<th>Año</th>
									<th>Fecha</th>
									<th>@</th>
		
								</thead>
								<tbody>
									<tr v-for="(alumno, index) in alumnos">
										<td>{{index+1}}</td>
										<td><a class="text-decoration-none" :href="'alumnoDetalle.php?id='+alumno.id">{{alumno.nombre}}</a></td>
										<td>{{alumno.desPrograma}}</td>
										<td>{{alumno.desEvento}}</td>
										<td>{{alumno.anio}}</td>
										<td>{{fechaLatam(alumno.inicio)}}</td>
										<td>
											<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editaralumno(index)"><i class="bi bi-pencil-square"></i></button>
											<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminaralumno(alumno.id, index)"><i class="bi bi-x-circle-fill"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			
		</div>

		
	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script>
  const { createApp } = Vue

  createApp({
    data() {
      return {
				alumnos:[],
				alumno:{
					idEspecialidad:1,
					nombres:'', apellidos:'', dni:'', conciliador:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', whatsapp:'', direccion:'', lugarTrabajo:'', hijos:0,  idMorosidad:1, detalle:''
				}
      }
    },
		mounted(){
			this.pediralumno();
			
		},
		methods:{
			
			async pediralumno(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.alumnos = resp;
				this.alumno = this.alumnos[0];
				console.log(this.alumnos);
			},
			
			fechaLatam(fechita){
				if(fechita == null){
					return '';
				}else{
					return moment(fechita, 'YYYY-MM-DD').format('DD/MM/YYYY')
				}
			},
			
			monedaLatam(monedita){
				return parseFloat(monedita).toFixed(2);
			},
			
		}
  }).mount('#app')
</script>
</body>
</html>