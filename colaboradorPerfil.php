<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Colaboradores'); ?>
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
					<h1>Colaborador: <small class="text-muted text-capitalize">{{colaborador.apellidos}} {{colaborador.nombres}}</small></h1>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row row-cols-2 row-cols-md-5">
							<div class="col">
								<p><strong>D.N.I.:</strong> <span>{{colaborador.dni}}</span></p>
							</div>
							<div class="col">
								<p><strong>Cargo:</strong> <span>{{colaborador.nomCargo}}</span></p>
							</div>
							<div class="col">
								<p><strong>F. Nacimiento:</strong> <span>{{fechaLatam(colaborador.fechaNacimiento)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Whatsapp:</strong> <span>{{colaborador.whatsapp}}</span></p>
							</div>
							<div class="col">
								<p><strong>Celular 1:</strong> <span>{{colaborador.celular1}}</span></p>
							</div>
							<div class="col">
								<p><strong>Celular 2:</strong> <span>{{colaborador.celular2}}</span></p>
							</div>
							<div class="col">
								<p><strong>Correo 1:</strong> <span>{{colaborador.correo1}}</span></p>
							</div>
							<div class="col">
								<p><strong>Correo 2:</strong> <span>{{colaborador.correo2}}</span></p>
							</div>
							<div class="col">
								<p><strong>Carrera:</strong> <span>{{colaborador.carrera}}</span></p>
							</div>
							<div class="col">
								<p><strong>Especialidad:</strong> <span>{{colaborador.nomEspecialidad}}</span></p>
							</div>
							<div class="col">
								<p><strong>Dirección:</strong> <span>{{colaborador.direccion}}</span></p>
							</div>
							<div class="col">
								<p><strong>N° Hijos:</strong> <span>{{colaborador.hijos}}</span></p>
							</div>
							<div class="col">
								<p><strong>Periodo:</strong> <span>{{colaborador.periodo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Día de pago:</strong> <span>{{fechapago(colaborador.pago)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Remuneración:</strong> <span>S/ {{monedaLatam(colaborador.remuneracion)}}</span></p>
							</div>
							
							


						</div>
						<div class="row">
							<div class="col" v-if="colaborador.hijos>0">
								<p><strong>Nombres hijos:</strong> <span v-html="colaborador.nombresHijos.replaceAll('\n', '<br>')"></span></p>
							</div>
							<div class="col">
								<p><strong>Detalles:</strong> <span v-html="colaborador.detalles.replaceAll('\n', '<br>')"></span></p>
							</div>
							<div class="col">
								<p><strong>Hoja de vida:</strong> <span v-html="colaborador.hojaVida.replaceAll('\n', '<br>')"></span></p>
							</div>
						</div>
					</div>
				</div>



				<div class="card my-3">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<p>Agenda del colaborador</p>
							<button class="btn btn-sm btn-outline-warning" @click="abrirCrear()"><i class="bi bi-award"></i> Agendar tarea</button>
						</div>
						<div class="table-responsive-md">
		
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Fecha</th>
									<th>Hora</th>
									<th>Tiempo</th>
									<th>Actividad</th>
									<th>Respuesta</th>
									<th>Check</th>
									<th>Observaciones</th>
								</thead>
								<tbody>
									<tr v-for="(agendado, index) in agenda">
										<td>{{index+1}}</td>
										<td>{{fechaLatam(agendado.fecha)}}</td>
										<td>{{horaLatam(agendado.hora)}}</td>
										<td class="text-capitalize">{{horaDentro(agendado.fecha, agendado.hora)}}</td>
										<td class="text-capitalize">{{agendado.actividad}}</td>
										<td>{{agendado.respuesta}}</td>
										<td>
											<span v-if="agendado.checked==0"><span class="badge text-bg-warning">Pendiente</span></span>
											<span v-if="agendado.checked==1"><span class="badge text-bg-success">Culminado</span></span>
											</td>
										<td> <p class="mb-1"><span v-html="agendado.observaciones.replaceAll('\n', '<br>')"></span></p> <button class="btn btn-outline-success btn-sm" v-if="agendado.checked==1" @click="addObservacion(index)"><i class="bi bi-file-plus"></i> Nueva observación</button></td>
										<td >
											<button class="btn btn-outline-secondary btn-sm" v-if="agendado.checked==0" @click="preFinalizar(index)"><i class="bi bi-alarm"></i> Finalizar</button>
											
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			
		</div>
		<!-- Modal inicializar agenda -->
		<div class="modal fade" id="modalIniciar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Crear actividad</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Rellena los datos para la nueva actividad:</p>
						<label for="">Nombre</label>
						<input type="text" class="form-control" v-model="tarea.nombre">
						<label for="">Fecha</label>
						<input type="date" class="form-control" v-model="tarea.fecha">
						<label for="">Hora</label>
						<input type="time" class="form-control" v-model="tarea.hora">
						<button class="btn btn-outline-primary mt-3" @click="crearAgenda()"><i class="bi bi-alarm"></i> Crear tarea</button>
					</div>
					
				</div>
			</div>
		</div>
		<!-- Modal finalizar agenda -->
		<div class="modal fade" id="modalFinalizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Culminar actividad</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>¿Desas finalizar la actividad «{{tarea.nombre}}»?</p>
						<p>Agrega algún comentario sobre la tarea a culminar</p>
						<input type="text" class="form-control" v-model="tarea.culminar">
						<button class="btn btn-outline-primary mt-3" @click="culminarAgenda()"><i class="bi bi-alarm"></i> Culminar tarea</button>
					</div>
					
				</div>
			</div>
		</div>

		
	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script src="js/moment-with-locales.min.js"></script>
<script>
	var modalFinalizar, modalIniciar;
  const { createApp } = Vue

  createApp({
    data() {
      return {
				agenda:[], tarea:{ id:-1, nombre:'', culminar:'', fecha:moment().format('YYYY-MM-DD'), hora: moment().format('HH:mm')},
				colaborador :{
					idEspecialidad:1, idCargo:3,
					nombres:'', apellidos:'', dni:'', whatsapp:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', carrera:'', direccion:'', hijos:0, nombresHijos:'',  periodo:'', detalles:'', hojaVida:'', pago:'', remuneracion:0
				},
				
      }
    },
		mounted(){
			this.pedirColaborador();
			this.pedirAgenda();
			modalIniciar = new bootstrap.Modal(document.getElementById('modalIniciar'));
			modalFinalizar = new bootstrap.Modal(document.getElementById('modalFinalizar'));
			
		},
		methods:{
			
			async pedirColaborador(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				let temp = await respServ.json();
				this.colaborador = temp[0];
			},
			async pedirAgenda(){
				let data = new FormData();
				data.append('pedir', 'verAgenda')
				data.append('nivel', '1') //cambiar el nivel a 0 cuando sea de colaborador
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				this.agenda = await respServ.json();
			},
			preFinalizar(index){
				this.tarea.id= this.agenda[index].id;
				this.tarea.nombre= this.agenda[index].actividad;
				this.tarea.culminar='';
				modalFinalizar.show()
			},
			async culminarAgenda(){
				let data = new FormData();
				data.append('pedir', 'culminarAgenda')
				data.append('id', this.tarea.id)
				data.append('respuesta', this.tarea.culminar)
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				if(await respServ.text()!=1){
					alert('Hubo un error al actualizar')
				}
				this.pedirAgenda();
				modalFinalizar.hide();
			},
			async addObservacion(index){
				this.tarea.id= this.agenda[index].id;
				
				let texto ='';
				if( texto= prompt('Información extra para agregar:')){
					if(this.agenda[index].observaciones != ''){ texto += "<br/>"+ texto }
					let data = new FormData();
					data.append('pedir', 'addObsAgenda')
					data.append('id', this.tarea.id)
					data.append('observacion', texto)
					let respServ = await fetch('./api/Colaborador.php',{
						method: 'POST', body:data
					});
					if(await respServ.text()!=1){
						alert('Hubo un error al actualizar')
					}
					this.pedirAgenda();
				}
			},
			abrirCrear(){
				modalIniciar.show();
			},
			async crearAgenda(){
				if( this.tarea.nombre!='' && this.tarea.fecha!='' && this.tarea.hora!='' ){
					let data = new FormData();
					data.append('pedir', 'addNewAgenda')
					data.append('idColaborador', '<?= $_GET['id']?>')
					data.append('actividad', this.tarea.nombre )
					data.append('fecha', this.tarea.fecha )
					data.append('hora', this.tarea.hora )
					let respServ = await fetch('./api/Colaborador.php',{
						method: 'POST', body:data
					});
					modalIniciar.hide();
					if(await respServ.text()!=1){
						alert('Hubo un error al actualizar')
					}
					this.pedirAgenda();
				}
			},
			
			fechapago(fechita){
				if(fechita == null){
					return '';
				}else{
					return moment(fechita, 'YYYY-MM-DD').format('DD')
				}
			},
			fechaLatam(fechita){
				if(fechita == null){
					return '';
				}else{
					return moment(fechita, 'YYYY-MM-DD').format('DD/MM/YYYY')
				}
			},
			horaLatam(fechita){
				if(fechita == null){
					return '';
				}else{
					return moment(fechita, 'HH:mm:ss').format('hh:mm a')
				}
			},
			horaDentro(dia, hora){
				if(dia == null || hora == null){
					return '';
				}else{
					moment.locale('es');
					return moment(dia+" "+hora, 'YYYY-MM-DD HH:mm:ss').fromNow()
				}
			},
			
			monedaLatam(monedita){
				if(monedita==null){ return '-'; }
				else{ return parseFloat(monedita).toFixed(2); }
			},
			
		}
  }).mount('#app')
</script>
</body>
</html>