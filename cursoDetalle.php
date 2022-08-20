<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Cursos'); ?>
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
					<h1>Curso: <small class="text-muted">{{curso.nombre}}</small></h1>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row row-cols-2 row-cols-md-5">
							<div class="col">
								<p><strong>Año:</strong> <span>{{curso.anio}}</span></p>
							</div>
							<div class="col">
								<p><strong>Prog.</strong> <span>{{curso.desPrograma}}</span></p>
							</div>
							<div class="col">
								<p><strong>Eve.</strong> <span>{{curso.desEvento}}</span></p>
							</div>
							<div class="col">
								<p><strong>Cod.</strong> <span v-if="curso.codigo==''">-</span> <span v-else>{{curso.codigo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Mod.</strong> <span>{{curso.desModalidad}}</span></p>
							</div>
							<div class="col">
								<p><strong>Inicio</strong> <span>{{fechaLatam(curso.inicio)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Horas</strong> <span>{{curso.desHoras}}</span></p>
							</div>
							<div class="col">
								<p><strong>Conv.</strong> <span>{{curso.desConvenio}}</span></p>
							</div>
							<div class="col">
								<p><strong>Doc.</strong> <span>{{curso.nomDocente}}</span></p>
							</div>
							<div class="col">
								<p><strong>Doc. Reemp.</strong> <span>{{curso.nomDocenteReemplazo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Temario Archivo </strong> 
									<span v-if="curso.temarioArchivo==''">-</span>
									<span v-else><a :href="curso.temarioArchivo" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Temario Link: </strong> 
									<span v-if="curso.temarioLink==''">-</span>
									<span v-else><a :href="curso.temarioLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Cert.</strong> <span>{{curso.nomCertificado}}</span></p>
							</div>
							<div class="col">
								<p><strong>Brochure: </strong> 
									<span v-if="curso.brochureLink==''">-</span>
									<span v-else><a :href="curso.brochureLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Etapa</strong> <span>{{curso.etapaNombre}}</span></p>
							</div>
							<div class="col">
								<p><strong>Data: </strong> 
									<span v-if="curso.dataLink==''">-</span>
									<span v-else><a :href="curso.dataLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Vacantes</strong> <span>{{curso.vacantes}}</span></p>
							</div>
							<div class="col">
								<p><strong>Lista alumnos: </strong> 
									<span v-if="curso.checkAlumnos==0"><i class="bi bi-x-lg"></i></span>
									<span v-else><i class="bi bi-check-lg"></i></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Lista afianzamiento: </strong> 
									<span v-if="curso.checkAfianzamiento==0"><i class="bi bi-x-lg"></i></span>
									<span v-else><i class="bi bi-check-lg"></i></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Lista aprobados: </strong> 
									<span v-if="curso.checkAprobados==0"><i class="bi bi-x-lg"></i></span>
									<span v-else><i class="bi bi-check-lg"></i></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Autorización: </strong> 
									<span v-if="curso.autorizacion==''">-</span>
									<span v-else><a :href="curso.autorizacion" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Resp. #1</strong> <span>{{curso.nomResponsable1}}</span></p>
							</div>
							<div class="col">
								<p><strong>Resp. #2</strong> <span>{{curso.nomResponsable2}}</span></p>
							</div>
							<div class="col">
								<p><strong>Prospecto: </strong> 
									<span v-if="curso.prospectoLink==''">-</span>
									<span v-else><a :href="curso.prospectoLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Grupo:</strong> <span>{{curso.grupo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Catálogo: </strong> 
									<span v-if="curso.catalogoLink==''">-</span>
									<span v-else><a :href="curso.catalogoLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Video: </strong> 
									<span v-if="curso.videoLink==''">-</span>
									<span v-else><a :href="curso.videoLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>


						</div>
						<div class="row">
							<div class="col">
								<p><strong>Detalles</strong> <span v-html="curso.detalles.replaceAll('\n', '<br>')"></span></p>
							</div>
							<div class="col">
								<p><strong>Cambios</strong> <span v-html="curso.cambios.replaceAll('\n', '<br>')"></span></p>
							</div>
						</div>
					</div>
				</div>

				<div class="card my-3">
					<div class="card-body">
						<p><strong>Listado de precios:</strong></p>
						<div class="row row-cols-2 row-cols-md-4">
							<div class="col">
								<p><strong>General</strong> <span>S/ {{monedaLatam(curso.pGeneral)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Ex. Alumnos</strong> <span>S/ {{monedaLatam(curso.pExalumnos)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Corporativo</strong> <span>S/ {{monedaLatam(curso.pCorporativo)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Pronto pago</strong> <span>S/ {{monedaLatam(curso.pPronto)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Remate</strong> <span>S/ {{monedaLatam(curso.pRemate)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Media beca</strong> <span>S/ {{monedaLatam(curso.pMediaBeca)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Especial</strong> <span>S/ {{monedaLatam(curso.pEspecial)}}</span></p>
							</div>
						</div>
					</div>
				</div>


				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<p>Lista de matriculados</p>
							<button class="btn btn-sm btn-outline-warning" @click="abrirOff()"><i class="bi bi-award"></i> Matricular alumno</button>
						</div>
						<div class="table-responsive-md">
		
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Fecha</th>
									<th>Tipo certificado</th>
									<th>Estado</th>
									<th>Apellidos y nombres</th>
									<th>D.N.I.</th>
									<th>Celular</th>
									<th>Correo</th>
									<th>Precio</th>
									<th>Pagó</th>
									<th>Resta</th>
									<th>Certificado</th>
		
								</thead>
								<tbody>
									<tr v-for="(alumno, index) in alumnos">
										<td>{{index+1}}</td>
										<td>{{fechaLatam(alumno.fecha)}}</td>
										<td>
											<span v-if="alumno.tipoCertificado==1">Virtual</span>
											<span v-else>Físico</span>
										</td>
										<td>
											<span class="tooltips" v-if="alumno.idEstadoCertificado==1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sin generar"><i class="bi bi-circle"></i></span>
											<span class="text-warning tooltips" v-if="alumno.idEstadoCertificado==2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Emitido"><i class="bi bi-circle-half"></i></span>
											<span class="text-sucess tooltips" v-if="alumno.idEstadoCertificado==3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Entregado"><i class="bi bi-circle-fill"></i></span>
										</td>
										<td><a class="text-decoration-none" :href="'alumnoDetalle.php?id='+alumno.idAlumno">{{alumno.apellidos}} {{alumno.nombres}}</a></td>
										<td>{{alumno.dni}}</td>
										<td>{{alumno.celular1}}</td>
										<td>{{alumno.correo1}}</td>
										<td>{{alumno.precio}}</td>
										<td>{{alumno.pago}}</td>
										<td>{{alumno.debe}}</td>
										<td>{{alumno.estado}}</td>
										<td>
											<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarCurso(index)"><i class="bi bi-pencil-square"></i></button>
											<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarCurso(curso.id, index)"><i class="bi bi-x-circle-fill"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			
		</div>

		<!-- inicio Offcanvas -->
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offMatricula" >
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" >Matricular</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<p class="mb-0">Primero ubique al alumno a matricular:</p>
				<p class="fst-italic">Filtro: Nombre, Apellido, Dni y <kbd><i class="bi bi-arrow-return-left"></i> Enter</kbd></p>
				<input type="text" class="form-control mb-2" @keypress.enter="buscarCandidato()" v-model="texto">
				<div v-if="!ocultarTabla">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Apellidos y Nombres</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(candidato, indice) in candidatos" :key="candidato.id">
								<td class="text-capitalize"><span class="me-2" :class="{'text-ligero': candidato.idMorosidad==1, 'text-danger': candidato.idMorosidad==2, 'text-naranja': candidato.idMorosidad==3, 'text-warning': candidato.idMorosidad==4, 'text-success': candidato.idMorosidad==5 }"><i class="bi bi-circle-fill"></i></span> </span> {{candidato.apellidos}} {{candidato.nombres}}</td>
								<td><button class="btn btn-outline-warning border-0 btn-sm" @click="seleccionarCandidato(indice)"><i class="bi bi-award"></i></button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-if="verSeleccionado">
					<p class="mt-2"><strong>Seleccionado</strong></p>
					<dl>
						<dt>Apellidos y nombres</dt>
						<dd>{{postulante.apellidos}} {{postulante.nombres}}</dd>
						<dt>D.N.I.</dt>
						<dd>{{postulante.dni}}</dd>
						<dt>Celulares</dt>
						<dd>{{postulante.celular1}} {{postulante.celular2}} </dd>
						<dt>Morosidad</dt>
						<dd><span :class="{'text-ligero': postulante.idMorosidad==1, 'text-danger': postulante.idMorosidad==2, 'text-naranja': postulante.idMorosidad==3, 'text-warning': postulante.idMorosidad==4, 'text-success': postulante.idMorosidad==5 }"><i class="bi bi-circle-fill"></i></span> </span></dd>
						<dt>Tipo de matrícula</dt>
						<dd>
							<select class="form-select" id="sltTipoMatriculaPostulante" v-model="postulante.idTipoMatricula" @change="cambiarPrecioPagar()">
								<option v-for="matricula in tipoMatricula" :value="matricula.id">{{matricula.descripcion}}</option>
							</select>
						</dd>
						<dt>Tipo de pago</dt>
						<dd>
							<select class="form-select" id="sltTipoPagoPostulante" v-model="postulante.comoPaga">
								<option value="1">Pago total</option>
								<option value="2">Pago en cuotas</option>
							</select>
						</dd>
						<dt>Tipo de Certificado</dt>
						<dd>
							<select class="form-select" id="sltTipoPagoPostulante" v-model="postulante.tipoCertificado">
								<option value="1">Virtual</option>
								<option value="2">Físico</option>
							</select>
						</dd>
						<dt>Cantidad de Cuotas</dt>
						<dd>
							<input type="number" class="form-control" v-model="postulante.cuotas" >
						</dd>
						<dt>Precio a pagar</dt>
						<dd>S/ {{monedaLatam(precioApagar)}}</dd>
						
						<button class="btn btn-outline-success" @click="evaluarPreMatricula"><i class="bi bi-patch-plus-fill"></i> Generar matrícula</button>
					</dl>
				</div>
			</div>
		</div>
		<!-- Fin Offcanvas -->

		
	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script>
	var offMatricula;
  const { createApp } = Vue

  createApp({
    data() {
      return {
				cursos:[], alumnos:[], candidatos:[], texto:'', ocultarTabla:true, verSeleccionado:false, tipoMatricula:[],
				curso:{
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'', idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:''
				},
				postulante:{idTipoMatricula:1}, precioApagar:0, clientePaga:0, comoPaga:1, cuotas:1,tipoCertificado:1
      }
    },
		mounted(){
			this.pedirCurso();
			this.pedirDatos();
			offMatricula = new bootstrap.Offcanvas(document.getElementById('offMatricula'))
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
				var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
					return new bootstrap.Tooltip(tooltipTriggerEl)
				})
		},
		methods:{
			
			async pedirDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/TipoMatriculas.php',{
					method: 'POST', body:data
				});
				this.tipoMatricula = await respServ.json();
				
			},
			pedirCurso(){
				let data = new FormData();
				data.append('pedir', 'matriculados')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = fetch('./api/Curso.php',{
					method: 'POST', body:data
				})
				.then(respuesta=>{ 
					this.matriculas = respuesta.json()
						.then(matriculas=>{
							this.curso = matriculas[0];
							this.alumnos = matriculas[1];
						})
						.then( ()=>{
							var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
							var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
								return new bootstrap.Tooltip(tooltipTriggerEl)
							})
						})
				});
				/* let resp = await respServ.json();
				this.matriculas = resp;
				
				 */
				
				
			},
			async buscarCandidato(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('texto', this.texto)
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				this.candidatos = await respServ.json();
				this.ocultarTabla=false;
				this.verSeleccionado=false;
			},
			cambiarPrecioPagar(){
				let index = document.getElementById('sltTipoMatriculaPostulante').value;
				switch(index){
					case '1': this.precioApagar=this.curso.pGeneral; break;
					case '2': this.precioApagar=this.curso.pExalumnos; break;
					case '3': this.precioApagar=this.curso.pCorporativo; break;
					case '4': this.precioApagar=this.curso.pPronto; break;
					case '5': this.precioApagar=this.curso.pRemate; break;
					case '6': this.precioApagar=this.curso.pMediaBeca; break;
					case '7': this.precioApagar=this.curso.pEspecial; break;
				}
			},
			async evaluarPreMatricula(){
				/* if(this.clientePaga=='' || this.clientePaga<=0){
					alert('El cliente debe matricularse con un monto mínimo');
				}else */
				if(document.getElementById('sltTipoMatriculaPostulante').value==7 && this.clientePaga < this.curso.pEspecial ){
					alert('El monto mínimo a pagar es de '+ this.curso.pEspecial +' soles.')
				}else if(this.postulante.cuotas =='' || this.postulante.cuotas<0){
					alert('El mínimo de cuotas debe ser 1')
				}
				else{
					//matricular
					let data = new FormData();
					data.append('pedir', 'matricular')
					data.append('idCurso', '<?= $_GET['id']; ?>')
					data.append('idAlumno', this.postulante.id)
					data.append('idTipoMatricula', document.getElementById('sltTipoMatriculaPostulante').value )
					data.append('comoPago', this.postulante.comoPaga )
					data.append('cuotas', this.postulante.cuotas)
					data.append('tipoCertificado', this.postulante.tipoCertificado)
					data.append('precio', this.precioApagar)
					
					data.append('texto', this.texto)
					let respServ = await fetch('./api/Curso.php',{
						method: 'POST', body:data
					});
					console.log(respServ.text());
				}
			},


			abrirOff(){
				this.candidatos=[];
				this.texto='';
				this.ocultarTabla=true;
				this.verSeleccionado=false;
				offMatricula.show();
			},
			seleccionarCandidato(index){
				this.postulante= this.candidatos[index];
				this.postulante.idTipoMatricula=1;
				this.postulante.comoPaga=1;
				this.postulante.cuotas=1;
				this.postulante.tipoCertificado=1;
				this.precioApagar=this.curso.pGeneral;
				this.ocultarTabla=true;
				this.verSeleccionado=true;
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