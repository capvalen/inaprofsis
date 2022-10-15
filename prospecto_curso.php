<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('ProCursos'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Promocionar cursos</h1>
					
					<div class="row ">
						<div class="col-12 col-md-6">
							<label for=""><i class="bi bi-funnel"></i> Filtros</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Nombre" autocomplete="off" v-model="texto">
							</div>
						</div>
						<div class="col-10 col-md">
							<label for="">Especialidad</label>
							<select class="form-select" v-model="especialidadSearch">
								<option value="-1">Todos</option>
								<option v-for="especialidad in especialidades" :value="especialidad.id">{{especialidad.descripcion}}</option>
							</select>
						</div>
						<div class="col-2 col-md d-flex align-content-end align-content-md-center flex-wrap">
							<button class="btn btn-outline-secondary" type="button" @click="buscarProCurso()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de proCursos:</p>
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th></th>
							<th>Nombre</th>
							<th>F. Inicio</th>
							<th>Plazo Tiempo</th>
							<th>Plazo fecha</th>
							<th>Responsable</th>
							<th>Obs.</th>
							
							<th>@</th>
						</thead>
						<tbody>
							<tr v-if="proCursos.length>0" v-for="(proCurso, index) in proCursos" :key="proCurso.id">
								<td>{{index+1}}</td>
								<td>
									<img v-if="proCurso.foto!=''" :src="'./images/subidas/'+proCurso.foto" width="50">
								</td>
								<td class="text-capitalize"><a class="text-decoration-none" :href="'interesados_curso.php?idCurso='+proCurso.id">{{proCurso.nombre}}</a></td>
								<td >{{fechaLatam(proCurso.inicio)}}</td>
								<td class="text-capitalize">{{proCurso.tiempo}}</td>
								<td class="text-capitalize">{{proCurso.fecha}}</td>
								<td class="text-capitalize">{{proCurso.nombres}}</td>
								<td class="text-capitalize">{{proCurso.observacion}}</td>
								
								<td>
									<button v-if="proCurso.idProcurso==null " type="button" class="btn btn-outline-warning btn-sm border-0" @click="habilitarProCurso(index)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Habilitar Prospecto"><i class="bi bi-cloud-arrow-up"></i></button>
									<div v-else>
										<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarProCurso(index)"><i class="bi bi-pencil-square"></i></button>
										<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarProCurso(index)"><i class="bi bi-x"></i></button>
									</div>
								
								</td>
							</tr>
							<tr v-else>
								<td colspan="6">No se hallaron resultados</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
			<div class="col-12 col-md-5 col-lg-3 my-3">
				<div class="card">
					<div class="card-body">
					<p class="fw-bold">Ingreso nuevo registro</p>
					<label for="">Nombre</label>
					<p class="text-capitalize mb-0">{{proCurso.nombre}}</p>
					
					<label for="">Foto</label>
					<div class="mb-2" v-show="proCurso.foto!=''">
						<img :src="'./images/subidas/'+proCurso.foto" class="img-fluid">
					</div>
					<label for="">Colaborador responsable:</label>
					<select class="form-select" id="" v-model="proCurso.idResponsable">
						<option v-for="colaborador in colaboradores" :value="colaborador.id">{{colaborador.nombres}}</option>
					</select>
					<label for="">Plazo tiempo <small>Ejm: 4 semanas</small></label>
					<input type="text" class="form-control" v-model="proCurso.tiempo">
					<label for="">Plazo fecha <small>Ejm: 31 de noviembre</small></label>
					<input type="text" class="form-control" v-model="proCurso.fecha">
					<label for="">Observación</label>
					<input type="text" class="form-control" v-model="proCurso.observacion">
					

					<div class="d-grid mt-2" v-if="proCurso.idProcurso!=null">
						<button class="btn btn-outline-success" @click="actualizarProCurso(true)"><i class="bi bi-pencil-square"></i> Actualizar Prospecto</button>
					</div>
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script>
	var rutaDocs = '/home/pfeuhnjs/public_html/WEBS/esderecho.pe/intranet/images/subidas/';
  const { createApp } = Vue

  createApp({
    data() {
      return {
				proCursos:[], especialidades:[], actualizacion:false, especialidadSearch:-1, texto:'',
				colaboradores:[],
				proCurso :{
					id:-1, nombre:'', foto:''
				}
      }
    },
		mounted(){
			this.pedirProCursos();
			this.cargarDatos();
		},
		methods:{
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServColaboradores = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				this.colaboradores = await respServColaboradores.json();
				this.colaboradores.push({id:1, nombres: 'Ninguno', apellidos:''})
			},
			limpiarPrincipal(){
				this.proCurso = {
					id:-1, nombre:'', foto:''
				}
				//this.$refs.archivoFile.value = '';
			},
			pedirProCursos(){
				try {
					let data = new FormData();
					data.append('pedir', 'listar')
					fetch('./api/ProCurso.php',{
						method: 'POST', body:data
					})
					.then( respServ =>{
						respServ.json()
						.then( (data)=>{
							this.proCursos = data;
							
						}).then(()=>{
							const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
							const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
						})
					});
					
				} catch (error) {
					
				} finally{
					
				}
				
			},
			agregarProCurso(){
				if(document.getElementById("txtArchivo").files.length>0){//Hay un archivo
					this.crearProCurso();
					this.subirNube();
				}else{
					this.crearProCurso();
					this.limpiarPrincipal();
				}
			},
		
			editarProCurso(mIndex){
				this.queIndex = mIndex;
				this.proCurso = JSON.parse(JSON.stringify(this.proCursos[mIndex]));
				this.actualizacion=true;
			},
			async actualizarProCurso(alertar){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('proCurso', JSON.stringify(this.proCurso));
				let respServ = await fetch('./api/ProCurso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.pedirProCursos();
					this.limpiarPrincipal();
					this.actualizacion=false;
					if(alertar){alert('ProCurso actualizado exitosamente') }
					
				}
			},
			async eliminarProCurso(index){
				if( confirm(`¿Desea eliminar el prospecto llamado: ${this.proCursos[index].nombre}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', this.proCursos[index].idProcurso)
					let respServ = await fetch('./api/ProCurso.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						//this.proCursos.splice(index,1);
						this.pedirProCursos();
					}
				}
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
						this.proCurso.foto='';
						console.log( 'err1' );
					}else{ //subió bien
						this.proCurso.foto = nomArchivo;
						this.actualizarProCurso(true);
						console.log( 'subio bien al indice con nombre: '+ nomArchivo );
					}
				})
				.catch(function(ero){
					console.log( 'err2' + ero );
					return 'error 2';
				});
			},
			async buscarProCurso(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.especialidadSearch>0){ datos.append('idEspecialidad', this.especialidadSearch); }				
				this.proCursos = [];
				let respServ = await fetch('./api/ProCurso.php',{
					method: 'POST', body:datos
				});
				this.proCursos = await respServ.json();
				
			},
			async habilitarProCurso(index){
				if(confirm(`¿Deseas habilitar el prospecto para: ${this.proCursos[index].nombre}?`)){
					let data = new FormData();
					data.append('pedir', 'add');
					data.append('idCurso', this.proCursos[index].id);
					
					let respServ = await fetch('./api/ProCurso.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(parseInt(resp) >=1){
						this.proCurso.idProcurso=resp;
						alert('ProCurso creado exitosamente')
						this.pedirProCursos();
					}
				}
			},
			fechaLatam(fechita){
				if(fechita == '' || fechita == null){
					return '';
				}else{
					return moment(fechita).format('DD/MM/YYYY')
				}
			}
		}
  }).mount('#app')
</script>
</body>
</html>