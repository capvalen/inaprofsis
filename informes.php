<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Informes'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Informes</h1>
					
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
							<button class="btn btn-outline-secondary" type="button" @click="buscarInforme()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de informes:</p>
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
							<tr v-if="informes.length>0" v-for="(informe, index) in informes" :key="informe.id">
								<td>{{index+1}}</td>
								<td class="text-capitalize">Informe académico {{informe.codigo}}</td>
								<td>{{informe.asunto}}</td>
								<td>{{fechaLatam(informe.fecha)}}</td>
								<td>{{informe.dirigido}}</td>
								<td>{{informe.documento}}</td>
								<td>
									<!-- <button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarInforme(index)"><i class="bi bi-pencil-square"></i></button> -->
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarInforme(informe.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<select v-model="informe.idRama" class="form-select">
						<option v-for="rama in ramas" :value="rama.id">{{rama.descripcion}}</option>
					</select>
					<label for="">Área</label>
					<select v-model="informe.idArea" class="form-select">
						<option v-for="area in areas" :value="area.id">{{area.descripcion}}</option>
						</select>
					<label for="">Fecha</label>
					<input type="date" class="form-control" v-model="informe.fecha">
					<label for="">Dirigido a</label>
					<input type="text" class="form-control" v-model="informe.dirigido">
					<label for="">De</label>
					<input type="text" class="form-control" v-model="informe.de">
					<label for="">Cargo</label>
					<input type="text" class="form-control" v-model="informe.cargo">
					<label for="">Asunto</label>
					<input type="text" class="form-control" v-model="informe.asunto">
					<label for="">Documento</label>
					<input type="file" class="form-control" v-model="informe.documento">
					<button class="btn btn-outline-primary my-2" @click="codificar" v-if="!sePuedeGuardar">Codificar</button>
					<input type="text" class="form-control" v-model="informe.codigo" placeholder="Código">
					
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarInforme()" v-if="sePuedeGuardar"><i class="bi bi-cloud-plus"></i> Agregar informe</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarInforme()"><i class="bi bi-pencil-square"></i> Actualizar informe</button>
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
				informes:[], ramas:[], areas:[], actualizacion:false,sePuedeGuardar:false, ramaSearch:-1, areaSearch:-1, texto:'',
				informe :{
					idRama:1, idArea:1,
					fecha: moment().format('YYYY-MM-DD'), dirigido:'', de:'', cargo:'', asunto:'', documento:'', codigo:''
				}
      }
    },
		mounted(){
			this.pedirInformes();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.informe = {
					idRama:1, idArea:1,
					fecha: moment().format('YYYY-MM-DD'), dirigido:'', de:'', cargo:'', asunto:'', documento:'', codigo:''
				}
			},
			async pedirInformes(){
				let data = new FormData();
				data.append('pedir', 'listar')
				/* let respServ = await fetch('./api/Informe.php',{
					method: 'POST', body:data
				});
				this.informes = await respServ.json(); */

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
				let respServ = await fetch('./api/Informe.php',{
					method: 'POST', body:data
				});
				this.informes = await respServ.json()
			},
			async agregarInforme(){
				if(this.informe.fecha==''){this.informe.fecha=null;}

				let data = new FormData();
				data.append('pedir', 'add')
				data.append('informe', JSON.stringify(this.informe));
				let respServ = await fetch('./api/Informe.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.informes.push( {'id': 'resp', ...this.informe});
					this.limpiarPrincipal();
					alert('Informe guardado exitosamente')
				}
			},
			editarInforme(mIndex){
				this.queIndex = mIndex;
				this.informe = JSON.parse(JSON.stringify(this.informes[mIndex]));
				this.actualizacion=true;
				this.sePuedeGuardar=true;
			},
			async actualizarInforme(){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('informe', JSON.stringify(this.informe));
				let respServ = await fetch('./api/Informe.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.informes[this.queIndex] = this.informe;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('Informe actualizado exitosamente')
				}
			},
			async eliminarInforme(id, index){
				if( confirm(`¿Desea eliminar el informe de la entidad ${this.informes[index].codigo}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					let respServ = await fetch('./api/Informe.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.informes.splice(index,1);
					}
				}
			},
			async buscarInforme(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.ramaSearch>0){ datos.append('idRama', this.ramaSearch); }
				if(this.areaSearch>0){ datos.append('idArea', this.areaSearch); }
				this.informes = [];
				let respServ = await fetch('./api/Informe.php',{
					method: 'POST', body:datos
				});
				this.informes = await respServ.json();
				
			},
			async codificar(){
				let datos = new FormData();
				datos.append('pedir', 'codificar')
				let respServ = await fetch('./api/Informe.php',{
					method: 'POST', body:datos
				});
				let correlativo = await respServ.text();
				if(parseInt(correlativo)>0){
					let letRama = this.ramas.find(x => x.id = this.informe.idRama).abreviatura;
					let letArea = this.areas.find(x => x.id = this.informe.idArea).abreviatura;
					this.informe.codigo = ('000'+ correlativo).slice(-3)+ `-${moment(this.informe.fecha).format('YYYY')}-${letRama}-${letArea}-INAPROF`;
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