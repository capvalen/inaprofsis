<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Convenios'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Convenios</h1>	
					
					<div class="row ">
						<div class="col-12 col-md-6">
							<label for=""><i class="bi bi-funnel"></i> Filtros</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Entidad" autocomplete="off" v-model="texto">
							</div>
						</div>
						<div class="col-10 col-md">
							<label for=""> Año</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Año" autocomplete="off" v-model="anioSearch">
							</div>
						</div>
						<div class="col-10 col-md">
							<label for=""> Categoría</label>
							<select class="form-select" id=""  v-model="idCategoria">
								<option value="-1">Todos</option>
								<option v-for="categoria in categorias" :value="categoria.id">{{categoria.descripcion}}</option>
							</select>
						</div>
						<div class="col-2 col-md d-flex align-content-end align-content-md-center flex-wrap">
							<button class="btn btn-outline-secondary" type="button" @click="buscarConvenios()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>

				</div>

				<div class="table-responsive-md">
					<p>Listado de convenios por año:</p>
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Entidad</th>
							<th>Representante</th>
							<th>Fecha</th>
							<th>Vence</th>
							<th>Periodo</th>
							<th>Celular</th>
							<th>@</th>
						</thead>
						<tbody>
							<tr v-for="(convenio, index) in convenios" :key="convenio.id">
								<td>{{index+1}}</td>
								<td>{{convenio.entidad}}</td>
								<td>{{convenio.representante}}</td>
								<td>{{convenio.fecha}}</td>
								<td>{{convenio.fechaFin}}</td>
								<td>{{convenio.periodo}}</td>
								<td>{{convenio.celular}}</td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarConvenio(index, convenio.id)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarConvenio(convenio.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<label for="">Entidad</label>
					<input type="text" class="form-control" v-model="convenio.entidad">
					<label for="">Representante</label>
					<input type="text" class="form-control" v-model="convenio.representante">
					<label for="">Fecha de suscripción</label>
					<input type="date" class="form-control" v-model="convenio.fecha">
					<label for="">Fecha de vencimiento</label>
					<input type="date" class="form-control" v-model="convenio.fechaFin">
					<label for="">Periodo de convenio</label >
					<input type="text" class="form-control" v-model="convenio.periodo">
					<label for="">Acuerdos del convenio</label>
					<textarea class="form-control" rows="3" v-model="convenio.acuerdos"></textarea>
					<label for="">Autoridades por año</label>
					<textarea class="form-control" rows="3" v-model="convenio.autoridades"></textarea>
					<label for="">Teléfono</label>
					<input type="text" class="form-control" v-model="convenio.telefono">
					<label for="">Celular</label>
					<input type="text" class="form-control" v-model="convenio.celular">
					<label for="">Web <a :href="retornaLink(convenio.web)" target="_blank" ><i class="bi bi-box-arrow-up-right"></i></a></label>
					<input type="text" class="form-control" v-model="convenio.web">
					<label for="">Categoría</label>
					<select class="form-select" id=""  v-model="convenio.idCategoria">
						<option v-for="categoria in categorias" :value="categoria.id">{{categoria.descripcion}}</option>
					</select>
					<label for="">Observaciones</label>
					<textarea class="form-control" rows="3" v-model="convenio.observaciones"></textarea>
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarConvenio()"><i class="bi bi-cloud-plus"></i> Agregar convenio</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarConvenio()"><i class="bi bi-pencil-square"></i> Actualizar convenio</button>
					</div>
					
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php pie(); ?>
<script>
  const { createApp } = Vue

  createApp({
    data() {
      return {
        categorias:[], convenios:[], actualizacion:false, anioSearch:'', texto:'',idCategoria:-1,
				convenio :{
					entidad:'',representante:'',fecha:null,periodo:'',acuerdos:'',
					autoridades:'',telefono:'',celular:'',web:'',idCategoria: 1,observaciones:'', fechaFin:null
				}
      }
    },
		mounted(){
			this.pedirConvenios();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.convenio = {
					entidad:'',representante:'',fecha:null,periodo:'',acuerdos:'',
					autoridades:'',telefono:'',celular:'',web:'',idCategoria: 1,observaciones:''
				};
			},
			async pedirConvenios(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Convenio.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.convenios = resp;
			},
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Categorias.php',{
					method: 'POST', body:data
				});
				this.categorias = await respServ.json()
			},
			async agregarConvenio(){
				let data = new FormData();
				data.append('pedir', 'add')
				data.append('convenio', JSON.stringify(this.convenio));
				let respServ = await fetch('./api/Convenio.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.convenios.push( {'id': 'resp', ...this.convenio});
					this.limpiarPrincipal();
					alert('Convenio guardado exitosamente')
				}
			},
			editarConvenio(mIndex,id){
				/* let temp = [].slice.call(this.convenios)
				this.convenio = temp[mIndex]; */
				/* this.convenios.forEach((element, index) => {
					if( index == mIndex){
						this.convenio = element;
					}
				}); */
				this.queIndex = mIndex;
				this.convenio = JSON.parse(JSON.stringify(this.convenios[mIndex]));
				// Array.from([mIndex]); //.find( x=> x.id == id )
				this.actualizacion=true;
			},
			async actualizarConvenio(){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('convenio', JSON.stringify(this.convenio));
				let respServ = await fetch('./api/Convenio.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.convenios[this.queIndex] = this.convenio;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('Convenio actualizado exitosamente')
				}
			},
			async eliminarConvenio(id, index){
				if( confirm(`¿Desea eliminar el convenio de la entidad ${this.convenios[index].entidad}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					data.append('convenio', JSON.stringify(this.convenio));
					let respServ = await fetch('./api/Convenio.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.convenios.splice(index,1);
					}
				}
			},
			async buscarConvenios(){
				if(this.texto=='' && this.anioSearch=='' && this.idCategoria==-1 ){
					this.pedirConvenios();
				}else{
					let datos = new FormData();
					datos.append('pedir', 'listar')
					datos.append('texto', this.texto)
					if(this.anioSearch!=''){ datos.append('anios', this.anioSearch) }
					if(this.idCategoria!=-1){ datos.append('idCategoria', this.idCategoria) }

					this.convenios = [];
					let respServ = await fetch('./api/Convenio.php',{
						method: 'POST', body:datos
					});
					this.convenios = await respServ.json();
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