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
								<p><strong>Cod.</strong> <span v-if="curso.codigo==''">-</span> <span v-else>{{curso.desEvento}}</span></p>
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
							<tr v-for="(curso, index) in cursos">
								<td>{{index+1}}</td>
								<td><a class="text-decoration-none" :href="'cursoDetalle.php?id='+curso.id">{{curso.nombre}}</a></td>
								<td>{{curso.desPrograma}}</td>
								<td>{{curso.desEvento}}</td>
								<td>{{curso.anio}}</td>
								<td>{{fechaLatam(curso.inicio)}}</td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarCurso(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarCurso(curso.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<input type="number" class="form-control" min="1900" max="2099" step="1" v-model="curso.anio" />
					<label for="">Tipo de programa</label>
					<select class="form-select" v-model="curso.idPrograma">
						<option v-for="programa in programas" :value="programa.id">{{programa.descripcion}}</option>
					</select>
					<label for="">Tipo de evento</label>
					<select class="form-select" id="" v-model="curso.idEvento">
						<option v-for="evento in eventos" :value="evento.id">{{evento.descripcion}}</option>
					</select>
					<label for="">Nombre de curso</label>
					<input type="text" class="form-control" v-model="curso.nombre">
					<label for="">Modalidad</label>
					<select class="form-select" id="" v-model="curso.idModalidad">
						<option v-for="modalidad in modalidades" :value="modalidad.id">{{modalidad.descripcion}}</option>
					</select>
					<label for="">Fecha de inicio</label>
					<input type="date" class="form-control" v-model="curso.inicio">
					<label for="">Fechas de desarrollo (link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.fechasLink">
					<label for="">Horas académidas</label>
					<select class="form-select" id="" v-model="curso.idHora">
						<option v-for="hora in horas" :value="hora.id">{{hora.descripcion}}</option>
					</select>
					<label for="">Convenio</label>
					<select class="form-select" id="" v-model="curso.idConvenio">
						<option v-for="convenio in convenios" :value="convenio.id">{{convenio.entidad}}</option>
					</select>
					<label for="">Código de curso</label>
					<input type="text" class="form-control" v-model="curso.codigo">
					<label class="fw-bold">Precios</label>
					<div class="row row-cols-2">
						<div class="col">
							<label for="">General</label>
							<input type="number" class="form-control" v-model="curso.pGeneral">
						</div>
						<div class="col">
							<label for="">Ex alumnos</label>
							<input type="number" class="form-control" v-model="curso.pExalumnos">
						</div>
						<div class="col">
							<label for="">Corporativo</label>
							<input type="number" class="form-control" v-model="curso.pCorporativo">
						</div>
						<div class="col">
							<label for="">Pronto pago</label>
							<input type="number" class="form-control" v-model="curso.pPronto">
						</div>
						<div class="col">
							<label for="">Remate</label>
							<input type="number" class="form-control" v-model="curso.pRemate">
						</div>
						<div class="col">
							<label for="">Media beca</label>
							<input type="number" class="form-control" v-model="curso.pMediaBeca">
						</div>
						<div class="col">
							<label for="">Especial</label>
							<input type="number" class="form-control" v-model="curso.pEspecial">
						</div>
					</div>
					<label for="">Docente original</label>
					<select class="form-select" id="" v-model="curso.idDocente">
						<option v-for="docente in docentes" :value="docente.id">{{docente.apellidos}} {{docente.nombres}}</option>
					</select>
					<label for="">Docente de reemplazo</label>
					<select class="form-select" id="" v-model="curso.idDocenteReemplazo">
						<option v-for="docente in docentes" :value="docente.id">{{docente.apellidos}} {{docente.nombres}}</option>
					</select>
					<label for="">Temario (archivo)</label>
					<input type="file" class="form-control" v-model="curso.temarioArchivo">
					<label for="">Temario (Link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.temarioLink">
					<label for="">Tipo de certificado</label>
					<select class="form-select" id="" v-model="curso.idTipoCertificado">
						<option v-for="tCertificado in tipoCertificados" :value="tCertificado.id">{{tCertificado.descripcion}}</option>
					</select>
					<label for="">Brochure (link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.brochureLink">
					<label for="">Etapa del curso</label>
					<select class="form-select" id="" v-model="curso.idEtapa">
						<option v-for="etapa in etapas" :value="etapa.id">{{etapa.descripcion}}</option>
					</select>
					<label for="">Detalles</label>
					<textarea class="form-control" rows="3" v-model="curso.detalles"></textarea>
					<label for="">Data de alumnos (link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.dataLink">
					<label for="">Vacantes disponibles</label>
					<input type="text" class="form-control" v-model="curso.vacantes">
					<label for="">Autorización (archivo)</label>
					<input type="file" class="form-control" v-model="curso.vacantes">
					<label for="">Cambios realizados</label>
					<textarea class="form-control" rows="3" v-model="curso.detalles"></textarea>
					<label for="">Lista de alumnos enviado:</label>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="checkAlumnos" v-model="curso.checkAlumnos" :checked="curso.checkAlumnos" :value="curso.checkAlumnos">
						<label class="form-check-label" for="checkAlumnos">
							<span v-if="!curso.checkAlumnos">Sin enviar</span>
							<span v-else>Enviado</span>
						</label>
					</div>
					<label for="">Lista de Afianzamiento:</label>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="checkAfianzamiento" v-model="curso.checkAfianzamiento" :checked="curso.checkAfianzamiento" :value="curso.checkAfianzamiento">
						<label class="form-check-label" for="checkAfianzamiento">
							<span v-if="!curso.checkAfianzamiento">Sin enviar</span>
							<span v-else>Enviado</span>
						</label>
					</div>
					<label for="">Lista de Aprobados:</label>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="checkAprobados" v-model="curso.checkAprobados" :checked="curso.checkAprobados" :value="curso.checkAprobados">
						<label class="form-check-label" for="checkAprobados">
							<span v-if="!curso.checkAprobados">Sin enviar</span>
							<span v-else>Enviado</span>
						</label>
					</div>
					<label for="">Colaborador responsable N° 1:</label>
					<select class="form-select" id="" v-model="curso.idResponsable1">
						<option v-for="colaborador in colaboradores" :value="colaborador.id">{{colaborador.nombres}}</option>
					</select>
					<label for="">Colaborador responsable N° 2:</label>
					<select class="form-select" id="" v-model="curso.idResponsable2">
						<option v-for="colaborador in colaboradores" :value="colaborador.id">{{colaborador.nombres}}</option>
					</select>
					<label for="">Prospecto (link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.prospectoLink">
					<label for="">Grupo de difusión</label>
					<input type="text" class="form-control" v-model="curso.grupo">
					<label for="">Catálogo (link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.catalogoLink">
					<label for="">Video (link) <a href="#!"><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.videoLink">
					

					





					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarCurso()"><i class="bi bi-cloud-plus"></i> Agregar curso</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarCurso()"><i class="bi bi-pencil-square"></i> Actualizar curso</button>
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
				cursos:[], programas:[], eventos:[], modalidades:[], convenios:[], docentes:[], tipoCertificados:[], etapas:[], horas:[], colaboradores:[], actualizacion:false, texto:'', programaSearch:-1, eventoSearch:-1,anioSearch:'',
				curso:{
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'', idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:''
				}
      }
    },
		mounted(){
			this.pedirCurso();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.curso = {
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'',  idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:''
				};
			},
			async pedirCurso(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Curso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.cursos = resp;
				this.curso = this.cursos[0];
				console.log(this.cursos);
			},
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Programa.php',{
					method: 'POST', body:data
				});
				this.programas = await respServ.json();
				let respServEvento = await fetch('./api/Evento.php',{
					method: 'POST', body:data
				});
				this.eventos = await respServEvento.json();
				let respServModalidad = await fetch('./api/Modalidad.php',{
					method: 'POST', body:data
				});
				this.modalidades = await respServModalidad.json();
				let respServConvenios = await fetch('./api/Convenio.php',{
					method: 'POST', body:data
				});
				this.convenios = await respServConvenios.json();
				let respServDocentes = await fetch('./api/Docente.php',{
					method: 'POST', body:data
				});
				this.docentes = await respServDocentes.json();
				let respServCertificados = await fetch('./api/Tipo_Certificado.php',{
					method: 'POST', body:data
				});
				this.tipoCertificados = await respServCertificados.json();
				let respServEtapas = await fetch('./api/Etapa.php',{
					method: 'POST', body:data
				});
				this.etapas = await respServEtapas.json();
				let respServHoras = await fetch('./api/Hora.php',{
					method: 'POST', body:data
				});
				this.horas = await respServHoras.json();
				let respServColaboradores = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				this.colaboradores = await respServColaboradores.json();
			},
			async agregarCurso(){
				let data = new FormData();
				data.append('pedir', 'add')
				data.append('curso', JSON.stringify(this.curso));
				let respServ = await fetch('./api/Curso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.cursos.push( {'id': 'resp', ...this.curso});
					this.curso=[];
					this.limpiarPrincipal();
					alert('Curso guardado exitosamente')
				}
			},
			editarCurso(mIndex){
				this.queIndex = mIndex;
				this.curso = JSON.parse(JSON.stringify(this.cursos[mIndex]));
				/* if(this.curso.checkAlumnos=='1'){
					document.getElementById('checkAlumnos').checked  = true;
				}else{
					document.getElementById('checkAlumnos').checked  = false;
				}
				if(this.curso.checkAfianzamiento==1){
					document.getElementById('checkAfianzamiento').checked  = true;
				}else{
					document.getElementById('checkAfianzamiento').checked  = false;
				}
				if(this.curso.checkAprobados==1){
					document.getElementById('checkAprobados').checked  = true;
				}else{
					document.getElementById('checkAprobados').checked  = false;
				} */
				this.actualizacion=true;
			},
			async actualizarCurso(){

				if(document.getElementById('checkAlumnos').checked){ this.curso.checkAlumnos = 1; }else{ this.curso.checkAlumnos =0;}
				if(document.getElementById('checkAfianzamiento').checked){ this.curso.checkAfianzamiento = 1; }else{ this.curso.checkAfianzamiento =0;}
				if(document.getElementById('checkAprobados').checked){ this.curso.checkAprobados = 1; }else{ this.curso.checkAprobados =0;}

				let data = new FormData();
				data.append('pedir', 'update')
				data.append('curso', JSON.stringify(this.curso));
				let respServ = await fetch('./api/Curso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.cursos[this.queIndex] = this.curso;
					this.actualizacion=false;
					this.limpiarPrincipal();
					alert('Curso actualizado exitosamente')
				}
			},
			async eliminarCurso(id, index){
				if( confirm(`¿Desea eliminar el curso llamado ${this.cursos[index].nombre}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					data.append('curso', JSON.stringify(this.curso));
					let respServ = await fetch('./api/Curso.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.cursos.splice(index,1);
					}
				}

			},
			fechaLatam(fechita){
				if(fechita == null){
					return '';
				}else{
					return moment(fechita, 'YYYY-MM-DD').format('DD/MM/YYYY')
				}
			},
			async buscarConvenios(){
				if(this.texto=='' && this.programaSearch==-1 && this.eventoSearch==-1 && this.anioSearch=='' ){
					this.pedirCursos();
				}else{
					let datos = new FormData();
					datos.append('pedir', 'listar')
					datos.append('texto', this.texto)
					if(this.programaSearch!=-1){ datos.append('idPrograma', this.programaSearch) }
					if(this.eventoSearch!=-1){ datos.append('idEvento', this.eventoSearch) }
					if(this.anioSearch !='' ){ datos.append('anio', this.anioSearch) }
					this.cursos = [];
					let respServ = await fetch('./api/Curso.php',{
						method: 'POST', body:datos
					});
					this.cursos = await respServ.json();
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