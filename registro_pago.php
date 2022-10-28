<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<title>Registro de pagos</title>
</head>
<body>
	<style>
		#divLogo{
			background-color: #7933F9;
			padding: 1rem 14rem;
		}
		#divLogo img{
			max-width: 100%;
			
		}
		#divFormulario label{ margin-top: 1rem;}
		#divDerecho label{ margin-top: 1rem;}
		.form-check-label{margin-top: 0!important; font-weight: normal;}

		label{font-weight: bold;}
	</style>
	<div class="container my-5" id="app">
		<div class="mb-3" id="divLogo">
			<img src="https://esderecho.pe/wp-content/uploads/2022/06/esDerecho_transparente.png" alt="">
		</div>
		<h1>Registro de pago</h1>
		<div class="row" v-if="interesado.idInteresado>0">
			<div class="col-12 col-md-5 p-3">
				<p>Por favor rellene y confirme sus datos</p>
				<div class="card">
					<div class="card-body">
						<div class="w-75 mx-auto">
							<img :src="dominio+'images/subidas/'+interesado.foto" class="img-fluid" alt="">
						</div>
						<div class="row row-cols-2">
							<div class="col">
								<label for="">Curso: </label>
								<p class="text-capitalize">{{interesado.nombre}}</p>
							</div>
							<div class="col">
								<label for="">Concepto</label>
								<p class="text-capitalize">{{interesado.concepto==''? '-': interesado.concepto}}</p>
							</div>
							<div class="col">
								<label for="fs-3">Total a pagar:</label>
							</div>
							<div class="col">
								<p class="fs-3">S/ {{monedaLatam(totalaPagar(interesado.aPagar, interesado.conCertificado))}}</p>
							</div>
						</div>
					</div>
				</div>

				<div class="card mt-2">
					<div class="card-body">
						<h4>Datos personales</h4>
						<label for="">Nombres y apellidos</label>
						<p class="text-capitalize">{{interesado.apellidos}} {{interesado.nombres}}</p>
						<label for="">DNI</label>
						<p>{{interesado.dni}}</p>
						<label for="">Correo electrónico</label>
						<p>{{interesado.correo}}</p>
						<label for="">Celular 1</label>
						<p>{{interesado.celular}}</p>
						
						

					</div>
				</div>		

					
			</div>

			<div class="col-12 col-md-6 p-3" id="divDerecho">
				<p>Los siguientes campos deben ser rellenados</p>
				<div class="card mt-2">
						<div class="card-body">
							<h4>Actualizacion campos personales</h4>
							<label for="">N° Whatsapp extra <span class="text-danger">*</span></label>
							<input type="text" class="form-control" autocomplete="off">
							<label for="">Correo electrónico emergencia <span class="text-danger">*</span></label>
							<input type="text" class="form-control" autocomplete="off">
							<label for="">Fecha de nacimiento <span class="text-danger">*</span></label>
							<input type="date" class="form-control" autocomplete="off">
						</div>
					</div>
				<div class="card mt-2">
					<div class="card-body">
						<h4>Pago</h4>
						<label for="">Entidad financiera <span class="text-danger">*</span></label>
						<select class="form-select" id="">
							<option v-for="banco in bancos" :value="banco.id" v-show="banco.id != 8">{{banco.entidad}}</option>
						</select>
						<label for="">N° de operación <span class="text-danger">*</span></label>
						<input type="text" class="form-control">
						<label for="">Fecha de depósito <span class="text-danger">*</span></label>
						<input type="text" class="form-control">
						<label for="">Monto depositado <span class="text-danger">*</span></label>
						<input type="text" class="form-control">
						<label for="">Comprobante <span class="text-muted">(Opcional)</span></label>
						<div class="row row-cols-2">
							<div class="col">
							<input type="file" @change="cargarPreview" class="form-control" id="filePreview"  accept="image/*">
						</div>
							<div class="col">
								<div><img class="img-fluid" id="imgPreview" :src="" alt="" /></div>
							</div>
						</div>
						<label for="">Observaciones y/o apuntes extras<span class="text-muted">(Opcional)</span></label>
						<input type="text" class="form-control">
						

					</div>
				</div>
				<div class="card mt-2">
					<div class="card-body">
						<h4>Delivery</h4>
						<div v-if="interesado.conCertificado==1">
							<p>Indique los datos para la entrega de su certificado</p>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="rdbDelivery" id="tienda" value="0" v-model="interesado.delivery" checked>
								<label class="form-check-label" for="tienda"> Recojo en el local </label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="rdbDelivery" id="delivery" value="1" v-model="interesado.delivery" >
								<label class="form-check-label" for="delivery"> Entrega por courier - agencia </label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="rdbDelivery" id="virtual" value="2" v-model="interesado.delivery" >
								<label class="form-check-label" for="virtual"> Certificado Virtual </label>
							</div>
							<div v-if="interesado.delivery==1">
								
								<label for="">Agencia <span class="text-danger">*</span></label>
								<select class="form-select" id="sltAgencia">
									<option value="1">Ninguno</option>
									<option value="2">SHALOM (Recojo en agencia)</option>
									<option value="3">OLVA COURIER (Recojo en agencia)</option>
									<option value="4">OLVA COURIER (Entrega a domicilio)</option>
								</select>
								<label for="">Departamento <span class="text-danger">*</span></label>
								<select class="form-select" id="sltDepartamentos" @change="cambiarDepartamento()" v-model="interesado.departamento">
									<option v-for="departamento in departamentos" :value="departamento.idDepa">{{departamento.departamento}}</option>
								</select>
								<label for="">Provincia <span class="text-danger">*</span></label>
								<select class="form-select" id="sltProvincias" @change="cambiarProvincia()" v-model="interesado.provincia">
									<option v-for="provincia in provincias" :value="provincia.idProv">{{provincia.provincia}}</option>
								</select>
								<label for="">Distrito <span class="text-danger">*</span></label>
								<select class="form-select" id="sltDistritos" v-model="interesado.distrito">
									<option v-for="distrito in distritos" :value="distrito.idDist">{{distrito.distrito}}</option>
								</select>
								<label for="">Dirección <span class="text-danger">*</span></label>
								<input type="text" class="form-control" v-model="interesado.direccion">
								<label for="">Referencia <span class="text-danger">*</span></label>
								<input type="text" class="form-control" v-model="interesado.referencia">
							</div>
						</div>
						<div v-else>
							<p>Ud. No solicitó la opción de certificación</p>
						</div>

						<div class="d-grid">
							<button class="btn btn-outline-secondary mt-2 btn-lg" @click="guardarInformacion"><i class="bi bi-upload"></i> Guardar y Enviar datos</button>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div v-else>El código que intenta usar ya se encuentra registrado {{interesado.length}}</div>
	</div>
	<script src="js/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/vue@3"></script>
	<script>
	
  const { createApp } = Vue

  createApp({
    data() {
      return {
				interesado:{ idInteresado:-1, conCertificado:0, delivery:0, departamento:null, provincia:null, distrito:null, direccion:'', referencia:''},
				bancos:[], dominio:'', departamentos:[], provincias:[], distritos:[]
      }
    },
		mounted(){
			this.pedirDatos();
			dominio = 'localhost/inaprofsis/';
			//dominio = 'https://esderecho.pe/';
		},
		methods:{
			async pedirDatos(){
				let datos = new FormData();
				datos.append('pedir', 'listarInteresadoPago')
				datos.append('id', atob('<?= $_GET['id'] ?>'))
				let respServ = await fetch('./api/Interesados.php',{
					method: 'POST', body:datos
				});
				let temp = await respServ.json();
				this.interesado = temp[0]
				
				let data = new FormData();
				data.append('pedir', 'listar')
				let respServBancos = await fetch('./api/Bancos.php',{
					method: 'POST', body:data
				});
				this.bancos = await respServBancos.json();

				
				data.set('pedir', 'departamento')
				let respServDepartamentos = await fetch('./api/Ubigeo.php',{
					method: 'POST', body:data
				});
				this.departamentos = await respServDepartamentos.json();
			},
		
			
			fechaLatam(fechita){
				if(fechita == '' || fechita == null){
					return '';
				}else{
					return moment(fechita).format('DD/MM/YYYY')
				}
			},
			monedaLatam(monedita){
				if(monedita==null){ return '-'; }
				else{ return parseFloat(monedita).toFixed(2); }
			},
			cargarPreview(){
				document.getElementById('imgPreview').src= URL.createObjectURL(document.getElementById('filePreview').files[0])
			},
			async guardarInformacion(){
				if( confirm('Está a punto de guardar sus datos.\nEste proceso solo se puede hacer una vez. \n¿Está todo correcto?') ){
					let datos = new FormData();
				datos.append('pedir', 'add')
				datos.append('id', atob('<?= $_GET['id'] ?>'))
				let respServ = await fetch('./api/Pagos.php',{
					method: 'POST', body:datos
				});
				let temp = await respServ.text();
				}
			},
			totalaPagar(aPagar, conCertificado){
				if(conCertificado=='0'){
					return aPagar;
				}else{
					return aPagar + this.interesado.pCertificado;
				}
			},
			async cambiarDepartamento(){
				this.interesado.provincia = null;
				this.interesado.distrito = null;
				let data = new FormData();
				data.append('pedir', 'provincia')
				data.append('idDepartamento', this.interesado.departamento)
				let respServProvincias = await fetch('./api/Ubigeo.php',{
					method: 'POST', body:data
				});
				this.provincias = await respServProvincias.json();
			},
			async cambiarProvincia(){
				this.interesado.distrito = null;
				let data = new FormData();
				data.append('pedir', 'distrito')
				data.append('idProvincia', this.interesado.provincia)
				let respServDistritos = await fetch('./api/Ubigeo.php',{
					method: 'POST', body:data
				});
				this.distritos = await respServDistritos.json();
			}
		}
  }).mount('#app')
</script>
</body>
</html>