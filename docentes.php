<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Docentes'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Docentes</h1>
					
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
							<button class="btn btn-outline-secondary" type="button" @click="buscarDocente()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de docentes:</p>
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
							<tr v-if="docentes.length>0" v-for="(docente, index) in docentes" :key="docente.id">
								<td>{{index+1}}</td>
								<td class="text-capitalize">{{docente.apellidos}} {{docente.nombres}}</td>
								<td>{{docente.nomEspecialidad}}</td>
								<td>{{fechaLatam(docente.fechaNacimiento)}}</td>
								<td>{{docente.correo1}}</td>
								<td>{{docente.celular1}}</td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarDocente(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarDocente(docente.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<label for="">Especialidad</label>
					<select class="form-select" v-model="docente.idEspecialidad">
						<option v-for="especialidad in especialidades" :value="especialidad.id">{{especialidad.descripcion}}</option>
					</select>
					<label for="">Nombres</label>
					<input type="text" class="form-control"  v-model="docente.nombres">
					<label for="">Apellidos</label>
					<input type="text" class="form-control"  v-model="docente.apellidos">
					<label for="">D.N.I.</label>
					<input type="text" class="form-control"  v-model="docente.dni">
					<label for="">Fecha de nacimiento</label>
					<input type="date" class="form-control"  v-model="docente.fechaNacimiento">
					<label for="">Celular 1</label>
					<input type="text" class="form-control"  v-model="docente.celular1">
					<label for="">Celular 2</label>
					<input type="text" class="form-control"  v-model="docente.celular2">
					<label for="">Correo 1</label>
					<input type="text" class="form-control"  v-model="docente.correo1">
					<label for="">Correo 2</label>
					<input type="text" class="form-control"  v-model="docente.correo2">
					<label for="">N° Registro Conciliador 1</label>
					<input type="text" class="form-control"  v-model="docente.registroConciliador1">
					<label for="">N° Registro Conciliador 2</label>
					<input type="text" class="form-control"  v-model="docente.registroConciliador2">
					<label for="">N° Registro Capacitador</label>
					<input type="text" class="form-control"  v-model="docente.registroCapacitador">
					<label for="">Dirección</label>
					<input type="text" class="form-control"  v-model="docente.direccion">
					<label for="">Lugar de trabajo</label>
					<input type="text" class="form-control"  v-model="docente.lugarTrabajo">
					<label for="">N° Hijos</label>
					<input type="text" class="form-control"  v-model="docente.hijos">
					<label for="">Particuliaridades del docente</label>
					<textarea class="form-control" rows="3"  v-model="docente.particularidades"></textarea>
					<label for="">Hoja de vida</label>
					<input type="file" class="form-control"  >
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarDocente()"><i class="bi bi-cloud-plus"></i> Agregar docente</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarDocente()"><i class="bi bi-pencil-square"></i> Actualizar docente</button>
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
				docentes:[], especialidades:[], actualizacion:false, especialidadSearch:-1, texto:'',
				docente :{
					idEspecialidad:1,
					nombres:'', apellidos:'', dni:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', registroConciliador1:'', registroConciliador2:'', registroCapacitador:'', direccion:'', lugarTrabajo:'', hijos:'', particularidades:'', hojaVida:'', 
				}
      }
    },
		mounted(){
			this.pedirDocentes();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.docente = {
					idEspecialidad:1,
					nombres:'', apellidos:'', dni:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', registroConciliador1:'', registroConciliador2:'', registroCapacitador:'', direccion:'', lugarTrabajo:'', hijos:'', particularidades:'', hojaVida:'', 
				}
			},
			async pedirDocentes(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Docente.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.docentes = resp;
			},
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Especialidad.php',{
					method: 'POST', body:data
				});
				this.especialidades = await respServ.json()
			},
			async agregarDocente(){
				let data = new FormData();
				data.append('pedir', 'add')
				data.append('docente', JSON.stringify(this.docente));
				let respServ = await fetch('./api/Docente.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.docentes.push( {'id': 'resp', ...this.docente});
					this.limpiarPrincipal();
					alert('Docente guardado exitosamente')
				}
			},
			editarDocente(mIndex){
				this.queIndex = mIndex;
				this.docente = JSON.parse(JSON.stringify(this.docentes[mIndex]));
				this.actualizacion=true;
			},
			async actualizarDocente(){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('docente', JSON.stringify(this.docente));
				let respServ = await fetch('./api/Docente.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.docentes[this.queIndex] = this.docente;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('Docente actualizado exitosamente')
				}
			},
			async eliminarDocente(id, index){
				if( confirm(`¿Desea eliminar el docente de la entidad ${this.docentes[index].nombres} ${this.docentes[index].apellidos}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					data.append('docente', JSON.stringify(this.docente));
					let respServ = await fetch('./api/Docente.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.docentes.splice(index,1);
					}
				}
			},
			async buscarDocente(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.especialidadSearch>0){ datos.append('idEspecialidad', this.especialidadSearch); }				
				this.docentes = [];
				let respServ = await fetch('./api/Docente.php',{
					method: 'POST', body:datos
				});
				this.docentes = await respServ.json();
				
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