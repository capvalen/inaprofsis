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
					<input type="text" class="form-control">
					
					<label for="">Modalidad</label>
					<select class="form-select" id="" v-model="curso.idModalidad">
						<option v-for="modalidad in modalidades" :value="modalidad.id">{{modalidad.descripcion}}</option>
					</select>
					<label for="">Fecha de inicio</label>
					<input type="date" class="form-control">
					<label for="">Fechas de desarrollo (link)</label>
					<input type="text" class="form-control">
					<label for="">Horas académidas</label>
					<select class="form-select" id="" v-model="curso.idHora">
						<option v-for="hora in horas" :value="hora.id">{{hora.descripcion}}</option>
					</select>
					<label for="">Convenio</label>
					<select class="form-select" id="" v-model="curso.idConvenio">
						<option v-for="convenio in convenios" :value="convenio.id">{{convenio.entidad}}</option>
					</select>
					<label for="">Código de curso</label>
					<input type="text" class="form-control">
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
					<select class="form-select" id="" v-model="curso.idDocente">
						<option v-for="docente in docentes" :value="docente.id">{{docente.apellidos}} {{docente.nombres}}</option>
					</select>
					<label for="">Docente de reemplazo</label>
					<select class="form-select" id="" v-model="curso.idDocenteReemplazo">
						<option v-for="docente in docentes" :value="docente.id">{{docente.apellidos}} {{docente.nombres}}</option>
					</select>
					<label for="">Temario</label>
					<input type="text" class="form-control">
					<label for="">Tipo de certificado</label>
					<select class="form-select" id="" v-model="curso.idTipoCertificado">
						<option v-for="tCertificado in tipoCertificados" :value="tCertificado.id">{{tCertificado.descripcion}}</option>
					</select>
					<label for="">Brochure (link)</label>
					<input type="text" class="form-control">
					<label for="">Etapa del curso</label>
					<select class="form-select" id="" v-model="curso.idEtapa">
						<option v-for="etapa in etapas" :value="etapa.id">{{etapa.descripcion}}</option>
					</select>
					<label for="">Detalles</label>
					<textarea class="form-control" rows="3"></textarea>
					<label for="">Data de alumnos (link)</label>
					<input type="text" class="form-control">
					<label for="">Vacantes disponibles</label>
					<input type="text" class="form-control">

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
				cursos:[], programas:[], eventos:[], modalidades:[], convenios:[], docentes:[], tipoCertificados:[], etapas:[], horas:[], actualizacion:false,
				curso:{
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temario:'', idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0
				}
      }
    },
		mounted(){
			//this.pedirCursos();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.curso = {
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temario:'', idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0
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
				this.actualizacion=true;
			},
			async actualizarCurso(){
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
				if( confirm(`¿Desea eliminar el curso de la entidad ${this.cursos[index].nombres} ${this.cursos[index].apellidos}?`) ){
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
				return moment(fechita).format('DD/MM/YYYY')
			}
		}
  }).mount('#app')
</script>
</body>
</html>