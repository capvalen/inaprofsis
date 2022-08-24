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
					<h1>Prospectos - Cursos</h1>
					
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
							<th>Nombre</th>
							<th>Foto</th>
							
							<th>@</th>
						</thead>
						<tbody>
							<tr v-if="proCursos.length>0" v-for="(proCurso, index) in proCursos" :key="proCurso.id">
								<td>{{index+1}}</td>
								<td class="text-capitalize">{{proCurso.nombre}}</td>
								<td><a :href="'./images/subidas/'+proCurso.foto" target="_blank">{{proCurso.foto}}</a></td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarProCurso(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarProCurso(proCurso.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<input type="text" class="form-control" v-model="proCurso.nombre">
					<label for="">Foto</label>
					<input type="file" class="form-control" ref="archivoFile" id="txtArchivo">
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarProCurso()"><i class="bi bi-cloud-plus"></i> Agregar proCurso</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarProCurso(true)"><i class="bi bi-pencil-square"></i> Actualizar proCurso</button>
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
				proCurso :{
					id:-1, nombre:'', foto:''
				}
      }
    },
		mounted(){
			this.pedirProCursos();
		},
		methods:{
			limpiarPrincipal(){
				this.proCurso = {
					id:-1, nombre:'', foto:''
				}
				this.$refs.archivoFile.value = '';
			},
			async pedirProCursos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/ProCurso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.proCursos = resp;
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
			async crearProCurso(){
				let data = new FormData();
				data.append('pedir', 'add')
				data.append('proCurso', JSON.stringify(this.proCurso));
				let respServ = await fetch('./api/ProCurso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.proCurso.id=resp;
					this.proCursos.push( {'id': 'resp', ...this.proCurso});
					alert('ProCurso guardado exitosamente')
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
			async eliminarProCurso(id, index){
				if( confirm(`¿Desea eliminar el proCurso de la entidad ${this.proCursos[index].nombre}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					data.append('archivo', this.proCursos[index].foto)
					let respServ = await fetch('./api/ProCurso.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.proCursos.splice(index,1);
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
						this.actualizarProCurso(false);
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