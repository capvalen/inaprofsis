<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Alumno'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
		.text-naranja{color:#ff8f1b}
		.tdLargo{white-space: nowrap}
		.text-ligero{color: #d9d9d9!important;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12">
				<div class="row col p-4">
					<h1>Alumno: <small class="text-muted text-capitalize">{{alumno.nombres}} {{alumno.apellidos}}</small></h1>
				</div>

				<div class="card">
					<div class="card-body">
				
					<p><strong>Datos Generales:</strong></p>
					<div class="row row-cols-2 row-cols-md-5">
						<div class="col">
							<p><strong>Código:</strong> <span>{{alumno.id}}</span></p>
						</div>
						<div class="col">
							<p><strong>DNI:</strong> <span>{{alumno.dni}}</span></p>
						</div>
						<div class="col">
							<p><strong>F. Nacim.:</strong> <span>{{fechaLatam(alumno.fechaNacimiento)}}</span></p>
						</div>
						<div class="col">
							<p><strong>Celular 1:</strong> <span>{{alumno.celular1}}</span></p>
						</div>
						<div class="col">
							<p><strong>Celular 2:</strong> <span>{{alumno.celular2}}</span></p>
						</div>
						<div class="col">
							<p><strong>Whatsapp:</strong> <span>{{alumno.whatsapp}}</span></p>
						</div>
						<div class="col">
							<p><strong>Correo 1:</strong> <span>{{alumno.correo1}}</span></p>
						</div>
						<div class="col">
							<p><strong>Correo 2:</strong> <span>{{alumno.correo2}}</span></p>
						</div>
						<div class="col">
							<p class="text-capitalize"><strong>Dirección:</strong> <span>{{alumno.direccion}}</span></p>
						</div>
						<div class="col">
							<p><strong>Lugar trabajo:</strong> <span>{{alumno.lugarTrabajo}}</span></p>
						</div>
						<div class="col">
							<p><strong>N° Hijos:</strong> <span>{{alumno.hijos}}</span></p>
						</div>
						<div class="col">
							<p><strong>Morosidad:</strong> <span :class="{'text-ligero': alumno.idMorosidad==1, 'text-danger': alumno.idMorosidad==2, 'text-naranja': alumno.idMorosidad==3, 'text-warning': alumno.idMorosidad==4, 'text-success': alumno.idMorosidad==5 }"><i class="bi bi-circle-fill"></i></span> </span></p>
						</div>
						<div class="col">
							<p><strong>Especialidad:</strong> <span>{{alumno.nomEspecialidad}}</span></p>
						</div>
						<div class="col">
							<p><strong>Registrado:</strong> <span>{{fechaLatam(alumno.registro)}}</span></p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<p><strong>Detalles</strong> <span v-html="alumno.detalle.replaceAll('\n', '<br>')"></span></p>
						</div>
					</div>
						
					</div>
				</div>

				<ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="Matriculas-tab" data-bs-toggle="tab" data-bs-target="#Matriculas-tab-pane" type="button" role="tab" aria-controls="Matriculas-tab-pane" aria-selected="true">Cursos Matriculados</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="Pagos-tab" data-bs-toggle="tab" data-bs-target="#Pagos-tab-pane" type="button" role="tab" aria-controls="Pagos-tab-pane" aria-selected="false">Historial de Pagos</button>
					</li>
				</ul>

				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="Matriculas-tab-pane" role="tabpanel" aria-labelledby="Matriculas-tab" tabindex="0">
						<div class="table-responsive" v-if="cursos.length>0">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>N°</th>
										<th>Nombre curso</th>
										<th>Tipo Cert.</th>
										<th>Est. Cert.</th>
										<th>Cod. Cert.</th>
										<th>Fecha</th>
										<th>Costo</th>
										<th>Entidad</th>
										<th>N° Operacion</th>
										<th>Vb Colaborador</th>
										<th>Vb Banco</th>
										<th>Courier</th>
										<th>Distrito / Provincia</th>
										<th>Dirección</th>
										<th>Referencia</th>
										<th>Pagó</th>
										<th>Debe</th>
										<th>Certificado</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(curso, index) in cursos" :key="curso.id">
										<td>{{index+1}}</td>
										<td class="tdLargo"><a :href="'cursoDetalle.php?id='+curso.idCurso">{{curso.nombre}}</a></td>
										<td>
											<span v-if="curso.tipoCertificado==1">Virtual</span>
											<span v-else>Físico</span>
										</td>
										<td>
											<span class="tooltips" v-if="curso.estadoIdCertificado==1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sin generar"><i class="bi bi-circle"></i></span>
											<span class="text-warning tooltips" v-if="curso.estadoIdCertificado==2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Emitido"><i class="bi bi-circle-half"></i></span>
											<span class="text-sucess tooltips" v-if="curso.estadoIdCertificado==3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Entregado"><i class="bi bi-circle-fill"></i></span>
										</td>
										<td>{{curso.codigoCertificado}}</td>
										<td>{{fechaLatam(curso.fecha)}}</td>
										<td>{{curso.precio}}</td>
										<td>{{curso.entidad}}</td>
										<td>{{curso.nOperacion=='0' ? '':curso.nOperacion }}</td>
											<td class="tdLargo">
												<span class="tooltips" v-if="curso.vbColaborador==0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sin Verificar"><i class="bi bi-circle"></i></span>
												<span class="text-warning tooltips" v-if="curso.vbColaborador==1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Verificado"><i class="bi bi-check-lg"></i></span>
												<span class="text-sucess tooltips" v-if="curso.vbColaborador==2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Rechazado"><i class="bi bi-x-lg"></i></span>
												<span class="ms-1">{{curso.nomUsuario}}</span>
											</td>
											<td>
												<span class="tooltips" v-if="curso.vbBanco==0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sin Verificar"><i class="bi bi-circle"></i></span>
												<span class="text-warning tooltips" v-if="curso.vbBanco==1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Verificado"><i class="bi bi-check-lg"></i></span>
												<span class="text-sucess tooltips" v-if="curso.vbBanco==2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Rechazado"><i class="bi bi-x-lg"></i></span>
											</td>
											<td>{{curso.courier}}</td>
											<td>{{curso.distrito}}</td>
											<td>{{curso.direccion}}</td>
											<td>{{curso.referencia}}</td>

										<td>{{curso.pago}}</td>
										<td>
											<span class="text-danger" v-if="curso.debe>0">{{curso.debe}}</span>
											<span v-else>{{curso.debe}}</span>
										</td>
										<td>{{curso.estado}}</td>
										<td class="tdLargo">
											<button class="btn btn-outline-primary btn-sm mx-1 m" data-bs-toggle="modal" data-bs-target="#modalAddCargo"  @click="prepararPrePago(curso.id)"><i class="bi bi-plus-lg"></i> Agregar pago/cargo</button>
											<button class="btn btn-outline-danger btn-sm mx-1" @click="anularMatricula(curso.id, curso.nombre)"><i class="bi bi-bug"></i> Anular matrícula</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div v-else>
							<p>El alumno no tiene matriculado ningún curso</p>
						</div>						
					</div>

					<div class="tab-pane fade" id="Pagos-tab-pane" role="tabpanel" aria-labelledby="Pagos-tab" tabindex="0">
						<div class="table-responsive" v-if="pagos.length>0">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>N°</th>
										<th>Nombre del Curso</th>
										<th>Cargo</th>
										<th>Monto</th>
										<th>Pagó</th>
										<th>Fecha</th>
										<th>Banco</th>
										<th>N° Operación</th>
										<th>Vb Co.</th>
										<th>Vb Banco</th>
										<th>Observaciones</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(pago, index) in pagos">
										<td>{{index+1}}</td>
										<td class="tdLargo">{{pago.nombre}}</td>
										<td>{{pago.descripcion}}</td>
										<td>{{pago.monto}}</td>
										<td>{{pago.pagado}}</td>
										<td>{{fechaLatam(pago.fecha)}}</td>
										<td class="tdLargo">{{pago.entidad}}</td>
										<td>{{pago.nOperacion}}</td>
										<td class="tdLargo">
											<span class="text-muted" v-if="pago.vbColaborador==0"><i class="bi bi-circle"></i></span>
											<span class="text-success" v-if="pago.vbColaborador==1"><i class="bi bi-check2"></i></span>
											<span class="text-danger" v-if="pago.vbColaborador==2"><i class="bi bi-x-lg"></i></span>
											<span class="ms-1">{{pago.nomUsuario}}</span>
										</td>
										<td>
											<span class="text-muted" v-if="pago.vbBanco==0"><i class="bi bi-circle"></i></span>
											<span class="text-success" v-if="pago.vbBanco==1"><i class="bi bi-check2"></i></span>
											<span class="text-danger" v-if="pago.vbBanco==2"><i class="bi bi-x-lg"></i></span>
										</td>
										<td>{{pago.observaciones}}</td>
										<td class="tdLargo">
											<button class="btn btn-outline-warning mx-1" v-if="pago.vbColaborador==0" @click="aprobarPrimero(pago.id, pago.pagado)"><i class="bi bi-check2-square"></i> 1° Aprobación</button>
											<button class="btn btn-outline-success mx-1" v-if="pago.vbColaborador==1 && pago.vbBanco==0" @click="aprobarSegundo(pago.id, pago.pagado)"><i class="bi bi-check2-square"></i> 2° Aprobación</button>
											<button class="btn btn-outline-danger mx-1" v-if="pago.vbColaborador==0 || pago.vbBanco==0" @click="anularNoAprobar(pago.id, pago.pagado, pago.monto, pago.idMatricula)"><i class="bi bi-exclamation-square"></i> Anular pago</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<p v-else>Pagos realizados</p>
					</div>


				</div>


			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modalAddCargo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Agregar un cargo</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Elija el cargo que se va a aumentar</p>
						<select name="" id="sltNuevoCargo" class="form-select mb-3" v-model="cargoExtra.idCargos">
							<option value="1">Matrícula</option>
							<option value="2">Certificado</option>
							<option value="3">Examen extemporáneo</option>
							<option value="4">Delivery</option>
							<option value="5">Otros</option>
						</select>
						<div v-if="cargoExtra.idCargos=='4'">
							<p>Departamento</p>
							<select name="" id="sltDepartamentos" class="form-select mb-3" @change="mostrarProvincias()" v-model="cargoExtra.idDepartamento">
								<option v-for="departamento in departamentos" :value="departamento.idDepa">{{departamento.departamento}}</option>
							</select>
							<p>Provincia</p>
							<select name="" id="sltProvincias" class="form-select mb-3" @change="mostrarDistritos()" v-model="cargoExtra.idProvincia">
								<option v-for="provincia in provinciasTemp" :value="provincia.idProv">{{provincia.provincia}}</option>
							</select>
							<p>Distrito</p>
							<select name="" id="sltDistritos" class="form-select mb-3"  v-model="cargoExtra.idDistrito">
								<option v-for="distrito in distritosTemp" :value="distrito.idDist">{{distrito.distrito}}</option>
							</select>
							<p>Dirección</p>
							<input type="text" class="form-control mb-3"  v-model="cargoExtra.direccion">

						</div>
						<p>Fecha:</p>
						<input type="date" class="form-control mb-3"  v-model="cargoExtra.fecha">
						<p>Entidad bancaria:</p>
						<select name="" id="sltNuevoCargo" class="form-select mb-3" v-model="cargoExtra.idBanco">
							<option v-for="banco in bancos" :value="banco.id">{{banco.entidad}}</option>
						</select>
						<div v-if="cargoExtra.idBanco>1">
							<p >N° operación: <span class="fst-italic"><i class="bi bi-exclamation-circle-fill"></i> Sólo numeros</span></p>
							<input type="number" class="form-control mb-3" v-model="cargoExtra.nOperacion">
						</div>
						<p>Monto a agregar:</p>
						<input type="number" class="form-control mb-3" value="0" v-model="cargoExtra.monto">
						<p>Monto que paga el cliente:</p>
						<input type="number" class="form-control mb-3" value="0" v-model="cargoExtra.pagado">
						<p>Nota para recordar:</p>
						<input type="text" class="form-control mb-3" v-model="cargoExtra.observaciones">
					</div>
					<div class="modal-footer ">
						<div class="alert alert-danger" v-if="alerta.length>0" role="alert"><i class="bi bi-bug"></i> {{alerta}}</div>
						<button type="button" class="btn btn-outline-warning me-auto" v-if="!sePuedeGuardar" @click="verificarPago"><i class="bi bi-box2" ></i> Verificar pago</button>
						<button type="button" class="btn btn-outline-primary ms-auto" v-if="sePuedeGuardar" @click="registrarCargoExtra"><i class="bi bi-plus-lg"></i> Agregar cargo</button>
					</div>
				</div>
			</div>
		</div>

		
	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script>
	var modalAddCargo;
  const { createApp } = Vue

  createApp({
    data() {
      return {
				alumnos:[], bancos:[], departamentos:[], provincias:[], distritos:[], provinciasTemp:[], distritosTemp:[], sePuedeGuardar:false, alerta:'', pagos:[],
				cargoExtra:{
					idAlumno:'<?=$_GET['id']?>',idMatricula:-1, idCargos:1, fecha:moment().format('YYYY-MM-DD'), idBanco:1, nOperacion:'',monto:0, pagado:0, observaciones:'', idUsuario:1, idDepartamento:15, idProvincia:'', idDistrito:'', direccion:''
				},
				alumno:{
					idEspecialidad:1,
					nombres:'', apellidos:'', dni:'', conciliador:'', fechaNacimiento:'', celular1:'', celular2:'', correo1:'', correo2:'', whatsapp:'', direccion:'', lugarTrabajo:'', hijos:0,  idMorosidad:1, detalle:''
				}, cursos:[]
      }
    },
		mounted(){
			this.pedirAlumno();
			this.pedirDatos();
			this.pedirPagos();
			modalAddCargo = new bootstrap.Modal(document.getElementById('modalAddCargo'))
		},
		methods:{
			
			async pedirDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServ = await fetch('./api/Bancos.php',{
					method: 'POST', body:data
				});
				this.bancos = await respServ.json();
				let respDepas = await fetch('./api/Departamentos.php',{
					method: 'POST', body:data
				});
				let temp = await respDepas.json();
				this.departamentos = temp[0];
				this.provincias = temp[1];
				this.distritos = temp[2];
				this.mostrarProvincias()
			},
			pedirAlumno(){
				let data = new FormData();
				data.append('pedir', 'matriculas')
				data.append('id', '<?= $_GET['id']?>')
				fetch('./api/Alumno.php',{
					method: 'POST', body:data
				})
				.then(respuesta =>{
					respuesta.json()
					.then(resp=>{
						this.matricula = resp;
						this.alumno = this.matricula[0];
						this.cursos = this.matricula[1];
					})
					.then( ()=>{
						var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
							var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
								return new bootstrap.Tooltip(tooltipTriggerEl)
							})
					})
				});
				
				
			},
			async pedirPagos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Pagos.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.pagos = resp;
			},
			prepararPrePago(id){
				this.cargoExtra.idMatricula = id;
				this.cargoExtra.fecha = moment().format('YYYY-MM-DD');
				this.cargoExtra.idBanco = 1;
				this.cargoExtra.monto = 0;
				this.cargoExtra.pagado = 0;
				this.cargoExtra.observaciones = '';

				this.sePuedeGuardar=false;
			},
			async verificarPago(){
				this.alerta='';
				this.cargoExtra.nOperacion = Math.abs(this.cargoExtra.nOperacion);
				if(this.cargoExtra.nOperacion==NaN){ this.cargoExtra.nOperacion=0;}
				if(this.cargoExtra.nOperacion==null){ this.cargoExtra.nOperacion=0;}
				let data = new FormData();
				data.append('pedir', 'verificar')
				data.append('idBanco', this.cargoExtra.idBanco )
				data.append('nOperacion', this.cargoExtra.nOperacion )
				let respServ = await fetch('./api/Pagos.php',{
					method: 'POST', body:data
				});
				var resp = await respServ.json();
				if(resp.length==0){
					this.sePuedeGuardar=true;
				}else{
					this.alerta = 'El voucher que intenta ingresar fue registrado el ' + this.fechaLatam(resp.fecha) + ' por el alumno: ' + resp.apellidos + ' ' + resp.nombres + ' para el curso: ' + resp.nomCurso;
					this.sePuedeGuardar=false;
				}
				console.log(resp);
			},
			mostrarProvincias(){
				this.cargoExtra.idProvincia='';
				this.cargoExtra.idDistrito='';
				this.provinciasTemp= this.provincias.filter( prov => prov.idDepa==this.cargoExtra.idDepartamento)
			},
			mostrarDistritos(){
				this.cargoExtra.idDistrito='';
				this.distritosTemp= this.distritos.filter( dist => dist.idProv==this.cargoExtra.idProvincia)
			},
			async registrarCargoExtra(){
				if( this.cargoExtra.idCargos=='4' && ( this.cargoExtra.idDepartamento=='' || this.cargoExtra.idProvincia=='' || this.cargoExtra.idDistrito=='' || this.cargoExtra.direccion=='' ) ){
					alert('Debe seleccionar todos los campos de dirección')
				}else{
					let data = new FormData();
					data.append('pedir', 'add')
					data.append('cargoExtra', JSON.stringify(this.cargoExtra) )
					let respServ = await fetch('./api/Pagos.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text();
					if(parseInt(resp)>0){
						this.pedirAlumno();
						this.pedirPagos();
					}else{
						alert('Hubo un error al guardar sus datos, revise nuevamente')
					}
					modalAddCargo.hide();
				}
			},
			async anularMatricula(id, nombre){
				if(confirm(`¿Desea anular completamente la matrícula del curso: ${nombre}?`)){
					let data = new FormData();
					data.append('pedir', 'deleteMatricula')
					data.append('id', id)
					let respServ = await fetch('./api/Alumno.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text();
					if(resp =='ok'){
						this.pedirAlumno();
					}else{
						alert('Hubo un error al guardar sus datos, revise nuevamente')
					}
				}
			},
			async aprobarPrimero(id, pagado){
				if(confirm(`¿Desea realizar la primera aprobación para este pago de S/ ${pagado}?`)){
					let data = new FormData();
					data.append('pedir', 'aprobar1')
					data.append('id', id)
					data.append('idUsuario', 1) //cambiar idUsuario
					let respServ = await fetch('./api/Pagos.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text();
					if(resp =='ok'){
						this.pedirAlumno();
						this.pedirPagos();
					}else{
						alert('Hubo un error al guardar sus datos, revise nuevamente')
					}
				}
			},
			async aprobarSegundo(id, pagado){
				if(confirm(`¿Ha confirmado que el pago de S/ ${pagado} se encuentra en sus cuentas?`)){
					let data = new FormData();
					data.append('pedir', 'aprobar2')
					data.append('id', id)
					data.append('idUsuario', 1) //cambiar idUsuario
					let respServ = await fetch('./api/Pagos.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text();
					if(resp =='ok'){
						this.pedirAlumno();
						this.pedirPagos();
					}else{
						alert('Hubo un error al guardar sus datos, revise nuevamente')
					}
				}
			},
			async anularNoAprobar(id, pagado, monto, idMatricula){
				if(confirm(`¿Esta seguro que desea anular el monto de S/ ${pagado}?`)){
					let data = new FormData();
					data.append('pedir', 'anularPago')
					data.append('id', id)
					data.append('idMatricula', idMatricula)
					data.append('monto', monto)
					data.append('pagado', pagado)
					data.append('idUsuario', 1) //cambiar idUsuario
					let respServ = await fetch('./api/Pagos.php',{
						method: 'POST', body:data
					});
					let resp = await respServ.text();
					if(resp =='ok'){
						this.pedirAlumno();
						this.pedirPagos();
					}else{
						alert('Hubo un error al guardar sus datos, revise nuevamente')
					}
				}
			},
			fechaLatam(fechita){
				if(fechita == null){
					return '';
				}else{
					return moment(fechita, 'YYYY-MM-DD').format('DD/MM/YYYY')
				}
			},
			
			monedaLatam(monedita){
				return parseFloat(monedita).toFixed(2);
			},
			
		}
  }).mount('#app')
</script>
</body>
</html>