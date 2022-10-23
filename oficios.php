<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Oficios'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Oficios</h1>
					
					<div class="row ">
						<div class="col-12 col-md-6">
							<label for=""><i class="bi bi-funnel"></i> Filtros</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Nombre, apellidos, código" autocomplete="off" v-model="texto">
								
							</div>
						</div>
						<div class="col-10 col-md">
							<label for="">Rama</label>
							<select class="form-select" v-model="ramaSearch">
								<option value="-1">Todos</option>
								<option v-for="rama in ramas" :value="rama.id">{{rama.descripcion}}</option>
							</select>
						</div>
						<div class="col-10 col-md">
							<label for="">Área</label>
							<select class="form-select" v-model="areaSearch">
								<option value="-1">Todos</option>
								<option v-for="area in areas" :value="area.id">{{area.descripcion}}</option>
							</select>
						</div>
						<div class="col-2 col-md d-flex align-content-end align-content-md-center flex-wrap">
							<button class="btn btn-outline-secondary" type="button" @click="buscarOficio()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de oficios:</p>
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Código</th>
							<th>Asunto</th>
							<th>Fecha</th>
							<th>Dirigido</th>
							<th>Documento</th>
							<th>@</th>
						</thead>
						<tbody>
							<tr v-if="oficios.length>0" v-for="(oficio, index) in oficios" :key="oficio.id">
								<td>{{index+1}}</td>
								<td class="text-capitalize">Oficio {{oficio.codigo}}</td>
								<td>{{oficio.asunto}}</td>
								<td>{{fechaLatam(oficio.fecha)}}</td>
								<td>{{oficio.dirigido}}</td>
								<td>{{oficio.documento}}</td>
								<td>
									<!-- <button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarOficio(index)"><i class="bi bi-pencil-square"></i></button> -->
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarOficio(oficio.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					
					<label for="">Rama</label>
					<select v-model="oficio.idRama" class="form-select">
						<option v-for="rama in ramas" :value="rama.id">{{rama.descripcion}}</option>
					</select>
					<label for="">Área</label>
					<select v-model="oficio.idArea" class="form-select">
						<option v-for="area in areas" :value="area.id">{{area.descripcion}}</option>
						</select>
					<label for="">Fecha</label>
					<input type="date" class="form-control" v-model="oficio.fecha">
					<label for="">Dirigido a</label>
					<input type="text" class="form-control" v-model="oficio.dirigido">
					<label for="">Asunto</label>
					<input type="text" class="form-control" v-model="oficio.asunto">
					<label for="">Referencia</label>
					<input type="text" class="form-control" v-model="oficio.de">
					<label for="">Suscribe</label>
					<input type="text" class="form-control" v-model="oficio.suscribe">
					<label for="">Cargo</label>
					<input type="text" class="form-control" v-model="oficio.cargo">
					<label for="">Documento</label>
					<input type="file" class="form-control" v-model="oficio.documento">
					<button class="btn btn-outline-primary my-2" @click="codificar" v-if="!sePuedeGuardar">Codificar</button>
					<input type="text" class="form-control" v-model="oficio.codigo" placeholder="Código">
					
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarOficio()" v-if="sePuedeGuardar"><i class="bi bi-cloud-plus"></i> Agregar oficio</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarOficio()"><i class="bi bi-pencil-square"></i> Actualizar oficio</button>
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
				oficios:[], ramas:[], areas:[], actualizacion:false,sePuedeGuardar:false, ramaSearch:-1, areaSearch:-1, texto:'',
				oficio :{
					idRama:1, idArea:1,
					fecha: moment().format('YYYY-MM-DD'), dirigido:'', de:'', cargo:'', asunto:'', documento:'', codigo:'', suscribe:''
				}
      }
    },
		mounted(){
			this.pedirOficios();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.oficio = {
					idRama:1, idArea:1,
					fecha: moment().format('YYYY-MM-DD'), dirigido:'', de:'', cargo:'', asunto:'', documento:'', codigo:'', suscribe:''
				}
			},
			async pedirOficios(){
				let data = new FormData();
				data.append('pedir', 'listar')
				/* let respServ = await fetch('./api/Oficio.php',{
					method: 'POST', body:data
				});
				this.oficios = await respServ.json(); */

				let respServRamas = await fetch('./api/Ramas.php',{
					method: 'POST', body:data
				});
				this.ramas = await respServRamas.json();
				let respServAreas = await fetch('./api/Areas.php',{
					method: 'POST', body:data
				});
				this.areas = await respServAreas.json();

			},
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Oficio.php',{
					method: 'POST', body:data
				});
				this.oficios = await respServ.json()
			},
			async agregarOficio(){
				if(this.oficio.fecha==''){this.oficio.fecha=null;}

				let data = new FormData();
				data.append('pedir', 'add')
				data.append('oficio', JSON.stringify(this.oficio));
				let respServ = await fetch('./api/Oficio.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.oficios.push( {'id': 'resp', ...this.oficio});
					this.limpiarPrincipal();
					this.sePuedeGuardar=false;
					alert('Oficio guardado exitosamente')
				}
			},
			editarOficio(mIndex){
				this.queIndex = mIndex;
				this.oficio = JSON.parse(JSON.stringify(this.oficios[mIndex]));
				this.actualizacion=true;
				this.sePuedeGuardar=true;
			},
			async actualizarOficio(){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('oficio', JSON.stringify(this.oficio));
				let respServ = await fetch('./api/Oficio.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.oficios[this.queIndex] = this.oficio;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('Oficio actualizado exitosamente')
				}
			},
			async eliminarOficio(id, index){
				if( confirm(`¿Desea eliminar el oficio de la entidad ${this.oficios[index].codigo}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					let respServ = await fetch('./api/Oficio.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.oficios.splice(index,1);
					}
				}
			},
			async buscarOficio(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.ramaSearch>0){ datos.append('idRama', this.ramaSearch); }
				if(this.areaSearch>0){ datos.append('idArea', this.areaSearch); }
				this.oficios = [];
				let respServ = await fetch('./api/Oficio.php',{
					method: 'POST', body:datos
				});
				this.oficios = await respServ.json();
				
			},
			async codificar(){
				let datos = new FormData();
				datos.append('pedir', 'codificar')
				let respServ = await fetch('./api/Oficio.php',{
					method: 'POST', body:datos
				});
				let correlativo = await respServ.text();
				if(parseInt(correlativo)>0){
					let letRama = this.ramas.find(x => x.id == this.oficio.idRama).abreviatura;
					let letArea = this.areas.find(x => x.id == this.oficio.idArea).abreviatura;
					this.oficio.codigo = ('000'+ correlativo).slice(-3)+ `-${moment(this.oficio.fecha).format('YYYY')}-${letRama}-${letArea}-ESDERECHO`;
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