<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Principal'); ?>
<body>

<style>
	body,#app{
		min-height: 100vh;
		background-color: #F5F8FA;
	}
	.tarjeta{
		min-height: 150px;
		background-color: white;
		border-radius: 10px;
	}
	.tarjeta i{
		font-size: 4rem;	
	}
	.tarjeta:hover, .card-body:hover{
		cursor: pointer;
		box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
		transition:all 0.2s;
	}
</style>

	<?php menu(); ?>
	<div class="container pt-4" id="app">
		<h1>Bienvenido a Sistema Inaprof</h1>
		<p>Estas con el usuario: <strong>María Pilar Mateo</strong></p>

		<div class="row row-cols-3 row-cols-md-5 px-4">
			<div class="col mb-2" @click="buscarConveniosVencer()">
				<div class="tarjeta text-center p-2">
					<p class="mb-0 text-muted">Convenios a vencer</p>
					<span class="text-muted"><i class="bi bi-box2-heart"></i></span>
					<p class="mb-0">
						<span class="badge rounded-pill text-bg-primary fw-lighter px-3 py-2">{{resumen.convenios}} convenios</span>
					</p>
				</div>
			</div>
			<div class="col mb-2">
				<div class="tarjeta text-center p-2">
					<p class="mb-0 text-muted">Cursos presenciales</p>
					<span class="text-muted"><i class="bi bi-sticky"></i></span>
					<p class="mb-0">
						<span class="badge rounded-pill text-bg-warning fw-lighter px-3 py-2">{{resumen.presencial}} cursos</span>
					</p>
				</div>
			</div>
			<div class="col mb-2">
				<div class="tarjeta text-center p-2">
					<p class="mb-0 text-muted">Cursos virtuales</p>
					<span class="text-muted"><i class="bi bi-sticky-fill"></i></span>
					<p class="mb-0">
						<span class="badge rounded-pill text-bg-success fw-lighter px-3 py-2">{{resumen.virtual}} cursos</span>
					</p>
				</div>
			</div>
			<div class="col mb-2">
				<div class="tarjeta text-center p-2">
					<p class="mb-0 text-muted">Alumnos totales</p>
					<span class="text-muted"><i class="bi bi-file-earmark-person"></i></span>
					<p class="mb-0">
						<span class="badge rounded-pill text-bg-info fw-lighter px-3 py-2">15647 alumnos</span>
					</p>
				</div>
			</div>
			<div class="col mb-2">
				<div class="tarjeta text-center p-2">
					<p class="mb-0 text-muted">Pagos a verificar</p>
					<span class="text-muted"><i class="bi bi-coin"></i></span>
					<p class="mb-0">
						<span class="badge rounded-pill text-bg-danger fw-lighter px-3 py-2">24 pagos</span>
					</p>
				</div>
			</div>
			<div class="col mb-2">
				<div class="tarjeta text-center p-2">
					<p class="mb-0 text-muted">Actividades pendientes</p>
					<span class="text-muted"><i class="bi bi-clipboard2-check"></i></span>
					<p class="mb-0">
						<span class="badge rounded-pill text-bg-danger fw-lighter px-3 py-2">6 tareas</span>
					</p>
				</div>
			</div>


		</div>

		<h2 class="mt-4">Actividades agendadas</h2>
		<div class="card border-0 mb-5">
			<div class="p-3">
				<div class="list-group">
					<a href="#!" class="list-group-item list-group-item-action " aria-current="true">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">1. Listar tareas</h5>
							<small>hace 2 días</small>
						</div>
						<p class="mb-1">Some placeholder content in a paragraph.</p>
						<small>And some small print.</small>
					</a>
					<a href="#!" class="list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">2. Publicar redes sociales</h5>
							<small class="text-muted">hoy</small>
						</div>
						<p class="mb-1">Some placeholder content in a paragraph.</p>
						<small class="text-muted">And some muted small print.</small>
					</a>
					
				</div>
			</div>
		</div>

	<!-- Modal para ver resultados de convenios -->
	<div class="modal fade" id="modalConvenios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="d-flex justify-content-between mb-2">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Convenios por vencer</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					
					<ul class="list-group ">
						<div v-for="convenio in convenios" class="list-group-item list-group-item-action">
							<div>
								<h5 class="mb-1">Entidad: {{convenio.entidad}}</h5>
								<p class="mb-0">Representante: {{convenio.representante}}</p>
								<small>Vence {{cuandoVence(convenio.fechaFin)}}</small>
							</div>
						</li>
					</ul>
					
					<div class="d-flex justify-content-end mt-2">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Salir</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script src="js/moment-with-locales.min.js"></script>
<script>
	var modalConvenios;
  const { createApp } = Vue
	createApp({
		name: 'Principal',
		data() {
			return {
				convenios:[], resumen:[]
			}
		},
		mounted(){
			this.pedirDatos();
			modalConvenios = new bootstrap.Modal(document.getElementById('modalConvenios'));
		},
		methods:{
			async pedirDatos(){
				let datos = new FormData();
				datos.append('pedir', 'conteo')
				let respServ = await fetch('./api/Resumen.php',{
					method:'POST', body: datos
				});
				this.resumen = await respServ.json();
				this.resumen = this.resumen[0]

			},
			async buscarConveniosVencer(){
				
				let datos = new FormData();
				datos.append('pedir', 'porVencer')
				let respServ = await fetch('./api/Convenio.php',{
					method:'POST', body: datos
				});
				this.convenios = await respServ.json();
				
				modalConvenios.show()
			},
			cuandoVence(fecha){
				moment.locale('es')
				return moment(fecha).fromNow();
			}
		}
	}).mount('#app')
	
</script>
</body>
</html>
