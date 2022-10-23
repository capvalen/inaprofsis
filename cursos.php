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
							<th>Codigo</th>
							<th>Programa</th>
							<th>Evento</th>
							<th>Año</th>
							<th>Fecha</th>
							<th>@</th>
					
						</thead>
						<tbody>
							<tr v-for="(curso, index) in cursos">
								<td>{{index+1}}</td>
								<td class="text-capitalize"><a class="text-decoration-none" :href="'cursoDetalle.php?id='+curso.id">{{curso.nombre}}</a></td>
								<td>{{curso.codigo}}</td>
								<td>{{curso.desPrograma}}</td>
								<td>{{curso.desEvento}}</td>
								<td>{{curso.anio}}</td>
								<td>{{fechaLatam(curso.inicio)}}</td>
								<td  style='white-space: nowrap'>
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

					<label for="">Foto</label>
					<div v-show="curso.foto==''">
						<input type="file" class="form-control" ref="archivoFile" id="txtArchivo">
					</div>
					<div v-show="curso.foto!=''">
						<img :src="'./images/subidas/'+curso.foto" class="img-fluid">
					</div>

					<label for="">Año</label>
					<input type="number" class="form-control" min="1900" max="2099" step="1" v-model="curso.anio" />
					<label for="">Tipo de programa</label>
					<select class="form-select" v-model="curso.idPrograma">
						<option v-for="programa in programas" :value="programa.id">{{programa.descripcion}}</option>
					</select>
					<label for="">Especialidad</label>
					<select class="form-select" id="" v-model="curso.idEspecialidad">
						<option v-for="especialidad in especialidades" :value="especialidad.id">{{especialidad.descripcion}}</option>
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
					<label for="">Fechas de desarrollo (link) <a :href="retornaLink(curso.fechasLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.fechasLink">
					<label for="">Horas académidas</label>
					<select class="form-select" id="" v-model="curso.idHora">
						<option v-for="hora in horas" :value="hora.id">{{hora.descripcion}}</option>
					</select>
					<label for="">Convenio</label>
					<select class="form-select" id="" v-model="curso.idConvenio">
						<option v-for="convenio in convenios" :value="convenio.id">{{convenio.entidad}}</option>
					</select>
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
					<label for="">Meta</label>
					<input type="number" class="form-control" v-model="curso.meta">
					<label for="">Temario (archivo)</label>
					<input type="file" class="form-control" v-model="curso.temarioArchivo">
					<label for="">Temario (Link) <a :href="retornaLink(curso.temarioLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.temarioLink">
					<label for="">Tipo de certificado</label>
					<select class="form-select" id="" v-model="curso.idTipoCertificado">
						<option v-for="tCertificado in tipoCertificados" :value="tCertificado.id">{{tCertificado.descripcion}}</option>
					</select>
					<label for="">Brochure (link) <a :href="retornaLink(curso.brochureLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.brochureLink">
					<label for="">Etapa del curso</label>
					<select class="form-select" id="" v-model="curso.idEtapa">
						<option v-for="etapa in etapas" :value="etapa.id">{{etapa.descripcion}}</option>
					</select>
					<label for="">Detalles</label>
					<textarea class="form-control" rows="3" v-model="curso.detalles"></textarea>
					<label for="">Data de alumnos (link) <a :href="retornaLink(curso.dataLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.dataLink">
					<label for="">Vacantes disponibles</label>
					<input type="text" class="form-control" v-model="curso.vacantes">
					<label for="">Autorización (archivo)</label>
					<input type="file" class="form-control" v-model="curso.autorizacion">
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
					<label for="">Prospecto (link) <a :href="retornaLink(curso.prospectoLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.prospectoLink">
					<label for="">Grupo de difusión</label>
					<input type="text" class="form-control" v-model="curso.grupo">
					<label for="">Catálogo (link) <a :href="retornaLink(curso.catalogoLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.catalogoLink">
					<label for="">Video (link) <a :href="retornaLink(curso.videoLink)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="curso.videoLink">
					<div class="gap"><button class="btn btn-outline-primary my-2" @click="crearCodigo()"><i class="bi bi-upc-scan"></i> Generar código</button></div>
					<label for="">Código</label>
					<input type="text" class="form-control" v-model="curso.codigo">

					

					





					<div class="d-grid mt-2" v-if="!actualizacion">
						<button v-if="puedeGuardar" class="btn btn-outline-primary" @click="agregarCurso()"><i class="bi bi-cloud-plus"></i> Agregar curso</button>
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
	const rutaDocs = '/home/pfeuhnjs/public_html/WEBS/esderecho.pe/intranet/images/subidas/';
  const { createApp } = Vue

  createApp({
    data() {
      return {
				cursos:[], programas:[], eventos:[], modalidades:[], convenios:[], docentes:[], tipoCertificados:[], etapas:[], horas:[], colaboradores:[], actualizacion:false, texto:'', programaSearch:-1, eventoSearch:-1,anioSearch:'',
				curso:{
					anio: moment().format('YYYY'), idPrograma:1, idEvento:1, idEspecialidad:1, nombre:'', idModalidad:1, inicio:moment().format('YYYY-MM-DD'), fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'',  idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:'',  codigo:'', foto:'', meta:0
				},
				puedeGuardar:false, correlativo:-1
      }
    },
		mounted(){
			this.pedirCursos();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.curso = {
					anio: moment().format('YYYY'), idPrograma:1, idEvento:1, idEspecialidad:1, nombre:'', idModalidad:1, inicio:moment().format('YYYY-MM-DD'), fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'',  idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:'',  codigo:'', foto:'', meta:0
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
				let respServEspecialidad = await fetch('./api/Especialidad.php',{
					method: 'POST', body:data
				});
				this.especialidades = await respServEspecialidad.json();
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
					this.curso.id = resp;
					//this.cursos.push( {'id': resp, ...this.curso});
					this.verificarFoto()
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
			subirNube(){
				var that = this; let nombreSubida='';
				let archivo = this.$refs.archivoFile.files[0];

				let formData = new FormData();
				formData.append('ruta', rutaDocs);
				formData.append('archivo', archivo);

				axios.post('./api/subirAdjunto.php', formData,{
					headers: {
						'Content-Type' : 'multipart/form-data'
					}
				})
				.then( response => {
					let nomArchivo = response.data;
					console.log(nomArchivo)
					if( nomArchivo =='Error subida' ){
						this.curso.foto='';
						console.log( 'err1' );
					}else{ //subió bien
						this.curso.foto = nomArchivo;
						console.log( 'subio bien al indice con nombre: '+ nomArchivo );
					}
				})
				.catch(function(ero){
					console.log( 'err2' + ero );
					return 'error 2';
				})
				.finally( ()=>{
					this.updateSoloFoto();
					
				})
				;
			},
			async updateSoloFoto(){
				let data = new FormData();
				data.append('pedir', 'updateSoloFoto')
				data.append('id', this.curso.id)
				data.append('foto', this.curso.foto)
				let pedirServ = await fetch('./api/Curso.php',{
					method:'POST', body:data
				});
				let diceServ = await pedirServ.text();
				this.limpiarPrincipal();
				console.log('diceServ', diceServ);
			},
			verificarFoto(){
				if(document.getElementById("txtArchivo").files.length>0){//Hay un archivo
					this.subirNube();
				}
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
					this.verificarFoto()
					this.cursos[this.queIndex] = this.curso;
					this.actualizacion=false;
					
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
			async crearCodigo(){
				if(this.curso.idEspecialidad==1 || this.curso.idEvento==1 || this.curso.idModalidad==1 || this.curso.inicio=='' || this.curso.inicio==null || this.curso.anio =='' ){
					alert('Debe rellenar los campos importantes: Especialidad, Evento, Modalidad, Fech. inicio y Año ');
				}else{
					let datos = new FormData();
					datos.append('pedir', 'correlativo')
					let respServ = await fetch('./api/Curso.php',{
						method:'POST', body:datos
					});
					this.correlativo = parseInt(await respServ.text());
					if(this.correlativo>-1){
						let letEspecialidad = this.especialidades.find(x => x.id = this.curso.idEspecialidad).abreviatura;
						let letEvento = this.eventos.find(x => x.id = this.curso.idEvento).abreviatura;
						let letModalidad = this.modalidades.find(x => x.id = this.curso.idModalidad).abreviatura;
						let letRomanos = this.numerosRomanos(moment(this.curso.inicio).format('M'))
						this.curso.codigo = ('00'+this.correlativo).slice(-2)+`-${letEspecialidad}-${letEvento}-${letModalidad}-${letRomanos}-${this.curso.anio}`;
						let datos = new FormData();
						datos.append('pedir', 'verificar')
						datos.append('correlativo', this.curso.codigo)
						let respVerificacion = await fetch('./api/Curso.php', {
							method:'POST', body:datos
						});
						let codigoLibre = await respVerificacion.text()
						if(parseInt(codigoLibre)==0){
							this.puedeGuardar=true;
						}else{
							alert('El código que intenta usar ya debe estar en uso')
							this.puedeGuardar=false;
						}
					}
				}
				
			},
			numerosRomanos(queNum){
				switch (parseInt(queNum)) {
					case 1: return 'I'; break;
					case 2: return 'II'; break;
					case 3: return 'III'; break;
					case 4: return 'IV'; break;
					case 5: return 'V'; break;
					case 6: return 'VI'; break;
					case 7: return 'VII'; break;
					case 8: return 'VIII'; break;
					case 9: return 'IX'; break;
					case 10: return 'X'; break;
					case 11: return 'XI'; break;
					case 12: return 'XII'; break;
					case '': break;
				}
			},
			retornaLink(link){
				if(link ==''){ return '#!'}
				else{
					if( link.includes('http') ){
						return link;
					}else{
						return 'https://'+link;
					}
				}
			}
		}
  }).mount('#app')
</script>
</body>
</html>