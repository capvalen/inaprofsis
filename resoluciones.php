<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Resoluciones'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Resoluciones</h1>	
					<p>Listado de resoluciones por año:</p>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Filtro" autocomplete="off">
						<button class="btn btn-outline-secondary" type="button" id="txtBuscar"><i class="bi bi-search"></i></button>
					</div>
				</div>
				<div class="table-responsive-md">
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Curso</th>
							<th>Código</th>
							<th>Fecha</th>
							<th>Tomo</th>
							<th>Documento</th>
							<th>@</th>
						</thead>
						<tbody>
							<tr v-for="(resolucion, index) in resoluciones">
								<td>{{index+1}}</td>
								<td>{{resolucion.nomCurso}}</td>
								<td>{{resolucion.id}}{{resolucion.codigo}}</td>
								<td>{{fechaLatam(resolucion.fecha)}}</td>
								<td>{{resolucion.tomo}}</td>
								<td>{{resolucion.documento}}</td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarResolucion(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarResolucion(resolucion.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<input type="number" class="form-control" min="1900" max="2099" step="1" value="<?= date('Y')?>" />
					<label for="">Resolución</label>
					<input type="text" class="form-control">
					<label for="">Fecha de resolución</label>
					<input type="date" class="form-control">
					<label for="">Tomo</label>
					<input type="text" class="form-control">
					<label for="">Tipo de evento</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Especialidad</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Código del curso</label>
					<input type="text" class="form-control">
					<label for="">Nombre del curso</label>
					<input type="text" class="form-control">
					<label for="">Fecha de desarrollo</label>
					<input type="text" class="form-control">
					<label for="">Docentes</label>
					<select class="form-select" id="">
						<option value="1">Derecho gubernamental</option>
						<option value="2">Estudio de abogados</option>
						<option value="3">Entidades privadas</option>
					</select>
					<label for="">Horas académicas</label>
					<input type="number" min=1 class="form-control">
					<label for="">Resolucion</label>
					<input type="text" class="form-control">
					<label for="">Link a la DB</label>
					<input type="text" class="form-control">
					<label for="">Observaciones</label>
					<textarea class="form-control" rows="3"></textarea>
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarResolucion()"><i class="bi bi-cloud-plus"></i> Agregar resolucion</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarResolucion()"><i class="bi bi-pencil-square"></i> Actualizar resolucion</button>
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
				resoluciones:[], ramas:[], areas:[], actualizacion:false,sePuedeGuardar:false, ramaSearch:-1, areaSearch:-1, texto:'',
				resolucion :{
					idRama:1, idArea:1,
					fecha: moment().format('YYYY-MM-DD'), dirigido:'', de:'', cargo:'', asunto:'', documento:'', codigo:''
				}
      }
    },
		mounted(){
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.resolucion = {
					idRama:1, idArea:1,
					fecha: moment().format('YYYY-MM-DD'), dirigido:'', de:'', cargo:'', asunto:'', documento:'', codigo:''
				}
			},
		
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Resoluciones.php',{
					method: 'POST', body:data
				});
				this.resoluciones = await respServ.json()
			},
			async agregarResolucion(){
				if(this.resolucion.fecha==''){this.resolucion.fecha=null;}

				let data = new FormData();
				data.append('pedir', 'add')
				data.append('resolucion', JSON.stringify(this.resolucion));
				let respServ = await fetch('./api/Resolucion.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.resoluciones.push( {'id': 'resp', ...this.resolucion});
					this.limpiarPrincipal();
					alert('Resolucion guardado exitosamente')
				}
			},
			editarResolucion(mIndex){
				this.queIndex = mIndex;
				this.resolucion = JSON.parse(JSON.stringify(this.resoluciones[mIndex]));
				this.actualizacion=true;
				this.sePuedeGuardar=true;
			},
			async actualizarResolucion(){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('resolucion', JSON.stringify(this.resolucion));
				let respServ = await fetch('./api/Resolucion.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.resoluciones[this.queIndex] = this.resolucion;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('Resolucion actualizado exitosamente')
				}
			},
			async eliminarResolucion(id, index){
				if( confirm(`¿Desea eliminar el resolucion de la entidad ${this.resoluciones[index].codigo}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					let respServ = await fetch('./api/Resolucion.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.resoluciones.splice(index,1);
					}
				}
			},
			async buscarResolucion(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.ramaSearch>0){ datos.append('idRama', this.ramaSearch); }
				if(this.areaSearch>0){ datos.append('idArea', this.areaSearch); }
				this.resoluciones = [];
				let respServ = await fetch('./api/Resolucion.php',{
					method: 'POST', body:datos
				});
				this.resoluciones = await respServ.json();
				
			},
			async codificar(){
				let datos = new FormData();
				datos.append('pedir', 'codificar')
				let respServ = await fetch('./api/Resolucion.php',{
					method: 'POST', body:datos
				});
				let correlativo = await respServ.text();
				if(parseInt(correlativo)>0){
					let letRama = this.ramas.find(x => x.id = this.resolucion.idRama).abreviatura;
					let letArea = this.areas.find(x => x.id = this.resolucion.idArea).abreviatura;
					this.resolucion.codigo = ('000'+ correlativo).slice(-3)+ `-${moment(this.resolucion.fecha).format('YYYY')}-${letRama}-${letArea}-INAPROF`;
					this.sePuedeGuardar=true;
				}else{
					this.sePuedeGuardar=false;
					alert('Hubo un error inesperado al generar el código, inténtelo nuevamente')
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