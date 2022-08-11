<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Colaboradores'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Colaboradores</h1>
					
					<div class="row ">
						<div class="col-12 col-md-6">
							<label for=""><i class="bi bi-funnel"></i> Filtros</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Nombre, apellidos, código" autocomplete="off" v-model="texto">
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
							<button class="btn btn-outline-secondary" type="button" @click="buscarColaborador()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de colaboradores:</p>
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Apellidos y nombres</th>
							<th>Especialidad</th>
							<th>F. Nacimiento</th>
							<th>Correo</th>
							<th>Celular</th>
							<th>@</th>
						</thead>
						<tbody>
							<tr v-if="colaboradores.length>0" v-for="(colaborador, index) in colaboradores" :key="colaborador.id">
								<td>{{index+1}}</td>
								<td class="text-capitalize"><a class="text-decoration-none" :href="'colaboradorPerfil.php?id='+colaborador.id">{{colaborador.apellidos}} {{colaborador.nombres}}</a></td>
								<td>{{colaborador.nomEspecialidad}}</td>
								<td>{{fechaLatam(colaborador.fechaNacimiento)}}</td>
								<td>{{colaborador.correo1}}</td>
								<td>{{colaborador.celular1}}</td>
								<td v-if="colaborador.id!=1">
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarColaborador(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarColaborador(colaborador.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					
					<label for="">Nombres</label>
					<input type="text" class="form-control"  v-model="colaborador.nombres">
					<label for="">Apellidos</label>
					<input type="text" class="form-control"  v-model="colaborador.apellidos">
					<label for="">Cargo</label>
					<select class="form-select" v-model="colaborador.idCargo">
						<option value="1">Administrador</option>
						<option value="2">Asistente</option>
						<option value="3">Sólo lectura</option>
					</select>
					<label for="">D.N.I.</label>
					<input type="text" class="form-control"  v-model="colaborador.dni">
					<label for="">Fecha de nacimiento</label>
					<input type="date" class="form-control"  v-model="colaborador.fechaNacimiento">
					<label for="">Whatsapp</label>
					<input type="text" class="form-control"  v-model="colaborador.whatsapp">
					<label for="">Celular 1</label>
					<input type="text" class="form-control"  v-model="colaborador.celular1">
					<label for="">Celular 2</label>
					<input type="text" class="form-control"  v-model="colaborador.celular2">
					<label for="">Correo 1</label>
					<input type="text" class="form-control"  v-model="colaborador.correo1">
					<label for="">Correo 2</label>
					<input type="text" class="form-control"  v-model="colaborador.correo2">
					<label for="">Carrera</label>
					<input type="text" class="form-control"  v-model="colaborador.carrera">
					<label for="">Especialidad</label>
					<select class="form-select" v-model="colaborador.idEspecialidad">
						<option v-for="especialidad in especialidades" :value="especialidad.id">{{especialidad.descripcion}}</option>
					</select>
					<label for="">Dirección</label>
					<input type="text" class="form-control"  v-model="colaborador.direccion">
					<label for="">N° Hijos</label>
					<input type="number" class="form-control"  v-model="colaborador.hijos">
					<label for="">Nombres de hijos</label>
					<textarea class="form-control" rows="3"  v-model="colaborador.nombresHijos"></textarea>
					<label for="">Detalles</label>
					<textarea class="form-control" rows="3"  v-model="colaborador.detalles"></textarea>
					<label for="">Hoja de vida</label>
					<input type="text" class="form-control"  v-model="colaborador.hojaVida">
					<label for="">Periodo de trabajo</label>
					<input type="text" class="form-control"  v-model="colaborador.periodo">
					<label for="">Fecha de pago</label>
					<input type="date" class="form-control"  v-model="colaborador.pago">
					<label for="">Remuneración</label>
					<input type="number" class="form-control"  v-model="colaborador.remuneracion">
					
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarColaborador()"><i class="bi bi-cloud-plus"></i> Agregar colaborador</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarColaborador()"><i class="bi bi-pencil-square"></i> Actualizar colaborador</button>
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
				colaboradores:[], especialidades:[], actualizacion:false, especialidadSearch:-1, texto:'',
				colaborador :{
					idEspecialidad:1, idCargo:3,
					nombres:'', apellidos:'', dni:'', whatsapp:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', carrera:'', direccion:'', hijos:0, nombresHijos:'',  periodo:'', detalles:'', hojaVida:'', pago:'', remuneracion:0
				}
      }
    },
		mounted(){
			this.pedirColaboradores();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.colaborador = {
					idEspecialidad:1, idCargo:3,
					nombres:'', apellidos:'', dni:'', whatsapp:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', carrera:'', direccion:'', hijos:0, nombresHijos:'',  periodo:'', detalles:'', hojaVida:'', pago:'', remuneracion:0
				}
			},
			async pedirColaboradores(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.colaboradores = resp;
			},
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Especialidad.php',{
					method: 'POST', body:data
				});
				this.especialidades = await respServ.json()
			},
			async agregarColaborador(){
				if(this.colaborador.fechaNacimiento==''){this.colaborador.fechaNacimiento=null;}
				if(this.colaborador.pago==''){this.colaborador.pago=null;}
				let data = new FormData();
				data.append('pedir', 'add')
				data.append('colaborador', JSON.stringify(this.colaborador));
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.colaboradores.push( {'id': 'resp', ...this.colaborador});
					this.limpiarPrincipal();
					alert('Colaborador guardado exitosamente')
				}
			},
			editarColaborador(mIndex){
				this.queIndex = mIndex;
				this.colaborador = JSON.parse(JSON.stringify(this.colaboradores[mIndex]));
				this.actualizacion=true;
			},
			async actualizarColaborador(){
				if(this.colaborador.fechaNacimiento==''){this.colaborador.fechaNacimiento=null;}
				if(this.colaborador.pago==''){this.colaborador.pago=null;}
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('colaborador', JSON.stringify(this.colaborador));
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.colaboradores[this.queIndex] = this.colaborador;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('Colaborador actualizado exitosamente')
				}
			},
			async eliminarColaborador(id, index){
				if( confirm(`¿Desea eliminar el colaborador de la entidad ${this.colaboradores[index].nombres} ${this.colaboradores[index].apellidos}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					data.append('colaborador', JSON.stringify(this.colaborador));
					let respServ = await fetch('./api/Colaborador.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.colaboradores.splice(index,1);
					}
				}
			},
			async buscarColaborador(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.especialidadSearch>0){ datos.append('idEspecialidad', this.especialidadSearch); }				
				this.colaboradores = [];
				let respServ = await fetch('./api/Colaborador.php',{
					method: 'POST', body:datos
				});
				this.colaboradores = await respServ.json();
				
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