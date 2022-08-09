<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Alumno'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
		.text-naranja{color:#ff8f1b}
		.text-ligero{color: #d9d9d9!important;}
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
						<div class="col">
							<p><strong>DNI:</strong> <span>{{alumno.dni}}</span></p>
						</div>
						<div class="col">
							<p><strong>F. Nacim.:</strong> <span>{{fechaLatam(alumno.fechaNacimiento)}}</span></p>
						</div>
						<div class="col">
							<p><strong>Celular 1:</strong> <span>{{alumno.celular1}}</span></p>
						</div>
						<div class="col">
							<p><strong>Celular 2:</strong> <span>{{alumno.celular2}}</span></p>
						</div>
						<div class="col">
							<p><strong>Whatsapp:</strong> <span>{{alumno.whatsapp}}</span></p>
						</div>
						<div class="col">
							<p><strong>Correo 1:</strong> <span>{{alumno.correo1}}</span></p>
						</div>
						<div class="col">
							<p><strong>Correo 2:</strong> <span>{{alumno.correo2}}</span></p>
						</div>
						<div class="col">
							<p class="text-capitalize"><strong>Dirección:</strong> <span>{{alumno.direccion}}</span></p>
						</div>
						<div class="col">
							<p><strong>Lugar trabajo:</strong> <span>{{alumno.lugarTrabajo}}</span></p>
						</div>
						<div class="col">
							<p><strong>N° Hijos:</strong> <span>{{alumno.hijos}}</span></p>
						</div>
						<div class="col">
							<p><strong>Morosidad:</strong> <span :class="{'text-ligero': alumno.idMorosidad==1, 'text-danger': alumno.idMorosidad==2, 'text-naranja': alumno.idMorosidad==3, 'text-warning': alumno.idMorosidad==4, 'text-success': alumno.idMorosidad==5 }"><i class="bi bi-circle-fill"></i></span> </span></p>
						</div>
						<div class="col">
							<p><strong>Especialidad:</strong> <span>{{alumno.nomEspecialidad}}</span></p>
						</div>
						<div class="col">
							<p><strong>Registrado:</strong> <span>{{fechaLatam(alumno.registro)}}</span></p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<p><strong>Detalles</strong> <span v-html="alumno.detalle.replaceAll('\n', '<br>')"></span></p>
						</div>
					</div>
						
					</div>
				</div>

				<div class="card my-3">
					<div class="card-body">
						<p><strong>Cursos matriculados:</strong></p>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>N°</th>
									<th>Nombre curso</th>
									<th>Fecha</th>
									<th>Precio</th>
									<th>Pagó</th>
									<th>Resta</th>
									<th>Certificado</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(curso, index) in cursos" :key="curso.id">
									<td>{{index+1}}</td>
									<td><a :href="'cursoDetalle.php?id='+curso.id">{{curso.nombre}}</a></td>
									<td>{{fechaLatam(curso.fecha)}}</td>
									<td>{{curso.precio}}</td>
									<td>{{curso.pago}}</td>
									<td>{{curso.debe}}</td>
									<td>{{curso.estado}}</td>
								</tr>
							</tbody>
						</table>
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
				}, cursos:[]
      }
    },
		mounted(){
			this.pedirAlumno();
			
		},
		methods:{
			
			async pedirAlumno(){
				let data = new FormData();
				data.append('pedir', 'matriculas')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.matricula = resp;
				this.alumno = this.matricula[0];
				this.cursos = this.matricula[1];
				
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