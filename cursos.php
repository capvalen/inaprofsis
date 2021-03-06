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
					<div class="row ">
						<div class="col-12 col-md-4">
							<label for=""><i class="bi bi-funnel"></i> Filtros</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Entidad" autocomplete="off" v-model="texto">
							</div>
						</div>
						<div class="col-10 col-md">
							<label for="">Programa</label>
							<select class="form-select" v-model="programaSearch">
								<option value="-1">Todos</option>
								<option v-for="programa in programas" :value="programa.id">{{programa.descripcion}}</option>
							</select>
						</div>
						<div class="col-10 col-md">
							<label for="">Evento</label>
							<select class="form-select" v-model="eventoSearch">
								<option value="-1">Todos</option>
								<option v-for="evento in eventos" :value="evento.id">{{evento.descripcion}}</option>
							</select>
						</div>
						<div class="col-10 col-md">
						<label for="">Año</label>
							<div class="input-group mb-3">
								<input type="number" class="form-control" placeholder="Año" autocomplete="off" v-model="anioSearch">
							</div>
						</div>
						<div class="col-2 col-md d-flex align-content-end align-content-md-center flex-wrap">
							<button class="btn btn-outline-secondary" type="button" @click="buscarConvenios()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de cursos:</p>
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
			this.pedirCursos();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.curso = {
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'',  idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:''
				};
			},
			async pedirCursos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Curso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.cursos = resp;
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
			}
		}
  }).mount('#app')
</script>
</body>
</html>