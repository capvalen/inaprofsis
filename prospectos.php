<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<title>Registro de Prospectos</title>
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
		#divFormulario label{ margin-top: 1rem; font-weight: bold;
		}
	</style>
	<div class="container mt-5" id="app">
		<div class="mb-3" id="divLogo">
			<img src="https://esderecho.pe/wp-content/uploads/2022/06/esDerecho_transparente.png" alt="">
		</div>
		<h1>Pre-Registro de cursos interesados</h1>
		<div class="row">
			<div class="col-12 col-md-8 col-lg-5 p-3">
				<div class="card">
					<div class="card-body">
						
						<p>Por favor seleccione el curso que está interesado</p>
						<select class="form-select" id="" @change="cambiarCurso()" v-model="interesado.id">
							<option value="-1">Seleccione un curso</option>
							<option class="text-capitalize" v-for="(curso, index) in proCursos" :value="curso.idCurso">{{curso.nombre}}</option>
						</select>
						<div v-if="interesado.index>-1" class="mt-3 p-3" id="divFormulario">
							<h5>Sus datos personales</h5>
							<label for="">D.N.I. <span class="text-danger">*</span></label>
							<p class="mb-0"><small>Tendremos en cuenta para el acceso a tu aula virtual</small></p>
							<input type="text" class="form-control" id="txtDNI" v-model="interesado.dni" @change="buscarPorDNI()">
							<label for="">Nombres <span class="text-danger">*</span></label>
							<input type="text" class="form-control" v-model="interesado.nombres">
							<label for="">Apellidos <span class="text-danger">*</span></label>
							<input type="text" class="form-control" v-model="interesado.apellidos">
							<label for="">N° Celular (Whatsapp) <span class="text-danger">*</span></label>
							<input type="text" class="form-control" v-model="interesado.celular">
							<label for="">Correo electrónico <span class="text-danger">*</span></label>
							<input type="text" class="form-control" v-model="interesado.correo">
							<label for="">Colegio Profesional</label>
							<p class="mb-0"><small>Ejm: Colegio de economistas del Callao</small></p>
							<input type="text" class="form-control" v-model="interesado.colegio">
							<label for="">Su especialidad </label>
							<input type="text" class="form-control" v-model="interesado.especialidad">
							<label for="">Su ciudad <span class="text-danger">*</span></label>
							<input type="text" class="form-control" v-model="interesado.ciudad">
							<label for="">¿Cómo se enteró del evento?</label>
							<select class="form-select" id="" v-model="interesado.lugar">
								<option value="-1">Seleccione uno</option>
								<option class="text-capitalize" v-for="(lugar, index) in lugares" :value="index">{{lugar}}</option>
							</select>
							<label for="">¿Desea reservar una llamada?</label>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" @click="interesado.llamada = !interesado.llamada" value="" id="chkLlamada" :checked="interesado.llamada">
								<label class="form-check-label mt-0" for="chkLlamada">
									<span v-if="interesado.llamada">Sí, acepto que me llamen</span>
									<span v-else>No deseo llamadas</span>
								</label>
							</div>
							<div class="row" v-if="interesado.llamada">
							<label style="font-weight:normal"><small>Soy consciente que estoy reservando el tiempo para una llamada con el equipo. Prometo respetar su tiempo contestando la llamada y asistiendo puntual a la cita.</small></label>
							</div>
							<div class="row row-cols-2" v-if="interesado.llamada">
						
								<div class="col"><input type="date" class="form-control" v-model="interesado.dia"></div>
								<div class="col"><input type="time" class="form-control" v-model="interesado.hora"></div>
							</div>
							<div class="d-grid my-3">
								<button class="btn btn-outline-primary" @click="guardarDatos" type="button">Enviar mis datos</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg pt-3 " v-if="interesado.index>-1">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center">Datos generales</h4>
						<p><strong>Curso:</strong> <span class="text-capitalize">{{proCursos[interesado.index].nombre}}</span></p>
						<p><strong>Fecha de inicio:</strong> <span>{{fechaLatam(proCursos[interesado.index].inicio)}}</span></p>
						<p><strong>Modalidad:</strong> <span>{{proCursos[interesado.index].modalidad}}</span></p>
						
						<div class="text-center">
							<img  class="img-fluid w-75 " :src="'./images/subidas/'+proCursos[interesado.index].foto" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/vue@3"></script>
	<script>
	
  const { createApp } = Vue

  createApp({
    data() {
      return {
				proCursos:[],
				lugares:['Ninguno','Facebook', 'Instagram', 'Whatsapp', 'Llamadas', 'Tiktok', 'Oficinas'],
				interesado:{ index:-1, idCurso:0, nombres:'', apellidos:'',dni:'', celular:'',correo:'',colegio:'', llamada:true, dia: moment().add(1, 'day').format('YYYY-MM-DD'), hora: moment().format('HH:mm'), especialidad: '', ciudad:'', lugar:0 }
      }
    },
		mounted(){
			this.pedirProCursos();
			
		},
		methods:{
			async pedirProCursos(){
				let data = new FormData();
				data.append('pedir', 'listarPro')
				let respServ = await fetch('./api/ProCurso.php',{
					method: 'POST', body:data
				});
				this.proCursos = await respServ.json();
			
			},
			cambiarCurso(){
				let index = event.target.selectedIndex-1;
				this.interesado.index = index;
				this.interesado.idCurso = event.target.value;
				console.log('que foto', this.proCursos[index].foto);
			},
			async guardarDatos(){
				if(this.interesado.nombres=='' || this.interesado.apelldios=='' || this.interesado.dni=='' || this.interesado.ciudad=='' ){
					alert('Debe rellenar todos los campos indicados')
				}else{
					let data = new FormData();
					data.append('pedir', 'add')
					data.append('interesado', JSON.stringify(this.interesado));
					let respServ = await fetch('./api/Interesados.php', {
						method: 'POST', body:data
					});
					let resp = await respServ.text()
					if(parseInt(resp) >=1){
						alert('Informe guardado exitosamente')
						location.reload();
					}
				}
			},
			buscarPorDNI(){
				if(this.interesado.dni.length!=8){
					/* document.getElementById('txtDNI'). */
				}
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
		}
  }).mount('#app')
</script>
</body>
</html>