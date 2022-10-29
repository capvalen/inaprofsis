<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Alumno'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
		.text-naranja{color:#ff8f1b}
		.text-ligero{color: #d9d9d9!important;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Alumnos</h1>
					
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
							<button class="btn btn-outline-secondary" type="button" @click="buscarAlumno()" id="txtBuscar"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive-md">
					<p>Listado de alumnos:</p>
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
							<tr v-if="alumnos.length>0" v-for="(alumno, index) in alumnos" :key="alumno.id">
								<td>{{index+1}}</td>
								<td class="text-capitalize">
									<span class="me-2" :class="{'text-ligero': alumno.idMorosidad==1, 'text-danger': alumno.idMorosidad==2, 'text-naranja': alumno.idMorosidad==3, 'text-warning': alumno.idMorosidad==4, 'text-success': alumno.idMorosidad==5 }"><i class="bi bi-circle-fill"></i></span> 
									<a class="text-decoration-none" :href="'alumnoDetalle.php?id='+alumno.id">{{alumno.apellidos}} {{alumno.nombres}}</a></td>
								<td>{{alumno.nomEspecialidad}}</td>
								<td>{{fechaLatam(alumno.fechaNacimiento)}}</td>
								<td>{{alumno.correo1}}</td>
								<td>{{alumno.celular1}}</td>
								<td>
									<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarAlumno(index)"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarAlumno(alumno.id, index)"><i class="bi bi-x-circle-fill"></i></button>
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
					<input type="text" class="form-control"  v-model="alumno.nombres">
					<label for="">Apellidos</label>
					<input type="text" class="form-control"  v-model="alumno.apellidos">
					<label for="">D.N.I.</label>
					<input type="text" class="form-control"  v-model="alumno.dni">
					<label for="">N° Registro Conciliador</label>
					<input type="text" class="form-control"  v-model="alumno.conciliador">
					
					<label for="">Celular 1</label>
					<input type="text" class="form-control"  v-model="alumno.celular1">
					<label for="">Celular 2</label>
					<input type="text" class="form-control"  v-model="alumno.celular2">
					<label for="">Whastapp</label>
					<input type="text" class="form-control"  v-model="alumno.whatsapp">
					<label for="">Correo 1</label>
					<input type="text" class="form-control"  v-model="alumno.correo1">
					<label for="">Correo 2</label>
					<input type="text" class="form-control"  v-model="alumno.correo2">
					<label for="">Fecha de nacimiento</label>
					<input type="date" class="form-control"  v-model="alumno.fechaNacimiento">
					<label for="">Departamento</label>
					<select class="form-select" v-model="alumno.idDepartamento" @change="cambioDepa($event)">
						<option v-for="departamento in departamentos" :value="departamento.idDepa">{{departamento.departamento}}</option>
					</select>
					<label for="">Provincia</label>
					<select class="form-select" v-model="alumno.idProvincia" @change="cambioProvi($event)">
						<option v-for="provincia in provincias"  :value="provincia.idProv">{{provincia.provincia}}</option>
					</select>
					<label for="">Distrito</label>
					<select class="form-select" v-model="alumno.idDistrito">
						<option v-for="distrito in distritos"  :value="distrito.idDist">{{distrito.distrito}}</option>
					</select>
					<label for="">Dirección</label>
					<input type="text" class="form-control"  v-model="alumno.direccion">
					<label for="">Lugar de trabajo</label>
					<input type="text" class="form-control"  v-model="alumno.lugarTrabajo">
					<label for="">N° Hijos</label>
					<input type="number" class="form-control"  v-model="alumno.hijos">
					<label for="">Especialidad</label>
					<div class="container-fluid row px-0">
						<div class="col">
							<select class="form-select" v-model="alumno.idEspecialidad" id="sltEspecialidad1">
								<option v-for="especialidad in especialidades" :value="especialidad.id">{{especialidad.descripcion}}</option>
							</select>
						</div>
						<div class="col-1">
							<button class="btn btn-outline-primary border-0" @click="agregarEspecialidad"><i class="bi bi-plus-circle"></i></button>
						</div>
					</div>
					<div id="especialidades" class="my-2">
						<button v-for="(aluEspecial, index) in aluEspecialidades" type="button" class="btn btn-outline-secondary position-relative mb-2 me-2" @click="borrarEspecialidad(index)">
							{{aluEspecial.descripcion}}
							<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
							</span>
						</button>
					</div>
					<label for="">Morosidad</label>
					<select class="form-select" v-model="alumno.idMorosidad">
						<option value="1">Niguno</option>
						<option value="2">Rojo</option>
						<option value="3">Naranja</option>
						<option value="4">Amarillo</option>
						<option value="5">Verde</option>
					</select>
					<label for="">Detalles</label>
					<textarea class="form-control" rows="3"  v-model="alumno.detalle"></textarea>
					<div class="d-grid mt-2" v-if="!actualizacion">
						<button class="btn btn-outline-primary" @click="agregarAlumno()"><i class="bi bi-cloud-plus"></i> Agregar alumno</button>
					</div>
					<div class="d-grid mt-2" v-else>
						<button class="btn btn-outline-success" @click="actualizarAlumno()"><i class="bi bi-pencil-square"></i> Actualizar alumno</button>
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
				alumnos:[], especialidades:[], actualizacion:false, especialidadSearch:-1, texto:'',departamentos:[], provincias:[], distritos:[], aluEspecialidades:[],
				alumno :{
					idEspecialidad:1,
					nombres:'', apellidos:'', dni:'', conciliador:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', whatsapp:'', direccion:'', lugarTrabajo:'', hijos:0,  idMorosidad:1, detalle:'', idDepartamento:-1, idProvincia: null,idDistrito:null
				}
			}
		},
		mounted(){
			this.pedirAlumnos();
			this.cargarDatos();
		},
		methods:{
			limpiarPrincipal(){
				this.alumno = {
					idEspecialidad:1,
					nombres:'', apellidos:'', dni:'', conciliador:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', whatsapp:'', direccion:'', lugarTrabajo:'', hijos:0,  idMorosidad:1, detalle:'', idDepartamento:-1, idProvincia: null,idDistrito:null
				}
			},
			async pedirAlumnos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.alumnos = resp;
			},
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Especialidad.php',{
					method: 'POST', body:data
				});
				this.especialidades = await respServ.json()

				data.set('pedir', 'departamento');
				let respServDepartamento = await fetch('./api/Ubigeo.php',{
					method: 'POST', body:data
				});
				this.departamentos = await respServDepartamento.json()
			},
			async agregarAlumno(){
				let data = new FormData();
				data.append('pedir', 'add')
				data.append('alumno', JSON.stringify(this.alumno));
				data.append('aluEspecialidades', JSON.stringify(this.aluEspecialidades));
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) >=1){
					this.alumnos.push( {'id': 'resp', ...this.alumno, 'nomEspecialidad': document.getElementById('sltEspecialidad1').options[document.getElementById('sltEspecialidad1').selectedIndex].text });
					this.limpiarPrincipal();
					alert('alumno guardado exitosamente')
				}
			},
			async editarAlumno(mIndex){
				this.queIndex = mIndex;
				this.alumno = JSON.parse(JSON.stringify(this.alumnos[mIndex]));
				this.aluEspecialidades = JSON.parse(JSON.stringify(this.alumnos[mIndex].especialidades))
				/* let data = new FormData();
				data.append('pedir', 'listarEspecialidades')
				data.append('idAlumno', this.alumno.id);
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text() */
				this.actualizacion=true;
			},
			async actualizarAlumno(){
				let data = new FormData();
				data.append('pedir', 'update')
				data.append('alumno', JSON.stringify(this.alumno));
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.text()
				if(parseInt(resp) ==1){
					this.alumnos[this.queIndex] = this.alumno;
					this.limpiarPrincipal();
					this.actualizacion=false;
					alert('alumno actualizado exitosamente')
				}
			},
			async eliminarAlumno(id, index){
				if( confirm(`¿Desea eliminar el alumno de la entidad ${this.alumnos[index].nombres} ${this.alumnos[index].apellidos}?`) ){
					let data = new FormData();
					data.append('pedir', 'delete')
					data.append('id', id)
					data.append('alumno', JSON.stringify(this.alumno));
					let respServ = await fetch('./api/Alumno.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(resp == 'ok'){
						this.alumnos.splice(index,1);
					}
				}
			},
			async buscarAlumno(){
				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('texto', this.texto)
				if(this.especialidadSearch>0){ datos.append('idEspecialidad', this.especialidadSearch); }				
				this.alumnos = [];
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:datos
				});
				this.alumnos = await respServ.json();
				
			},
			async cambioDepa(e){
				this.alumno.idProvincia=null
				this.alumno.idDistrito=null
				//console.log(e.target.value);
				let datos =  new FormData();
				datos.append('pedir', 'provincia')
				datos.append('idDepartamento', e.target.value)
				let respServ = await fetch('./api/Ubigeo.php',{
					method: 'POST', body:datos
				});
				this.provincias = await respServ.json();
			},
			async cambioProvi(e){
				this.alumno.idDistrito=null
				//console.log(e.target.value);
				let datos =  new FormData();
				datos.append('pedir', 'distrito')
				datos.append('idProvincia', e.target.value)
				let respServ = await fetch('./api/Ubigeo.php',{
					method: 'POST', body:datos
				});
				this.distritos = await respServ.json();
			},
			async cuentasDocente(index){
				this.cuentas=[];
				this.indexGlobal = index;
				this.idDocenteGlobal = this.docentes[index].id;
				this.docente.nombres = this.docentes[index].nombres;
				this.docente.apellidos = this.docentes[index].apellidos;
				let datos =  new FormData();
				datos.append('pedir', 'listarCuentas')
				datos.append('idDocente', this.idDocenteGlobal)
				let respServ = await fetch('./api/Docente.php',{
					method: 'POST', body:datos
				});
				this.cuentas = await respServ.json();
				this.crearCuenta=false;
				modalCuentas.show();
			},
			fechaLatam(fechita){
				if(fechita == '' || fechita == null){
					return '';
				}else{
					return moment(fechita).format('DD/MM/YYYY')
				}
			},
			agregarEspecialidad(){
				var idEsp = document.getElementById('sltEspecialidad1').value;
				let coincidencia = this.aluEspecialidades.filter(y=> y.id==idEsp)
				if(coincidencia.length==0){
					let queEs = this.especialidades.filter(x=> x.id==idEsp);
					this.aluEspecialidades.push({
						id: idEsp , descripcion: queEs[0].descripcion
					});
					//actualiza en automático si actualizacion es true
					if(this.actualizacion){
						document.getElementById('sltEspecialidad1').value=null;
						this.updateEspecialidad();
					}
				}
			},
			async updateEspecialidad(){
				let data = new FormData();
				data.append('pedir', 'refreshEspecialidad'),
				data.append('idAlumno', this.alumno.id),
				data.append('aluEspecialidades', JSON.stringify(this.aluEspecialidades))
				let respServ = await fetch('./api/Alumno.php',{
					method: 'POST', body:data
				});
				let queResp = await respServ.text()
				console.log(queResp);
			},
			borrarEspecialidad(index){
				this.aluEspecialidades.splice(index, 1);
				this.updateEspecialidad();
			}
		}
	}).mount('#app')
</script>
</body>
</html>