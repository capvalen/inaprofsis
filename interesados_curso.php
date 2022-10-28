<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Interesados'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 ">
				<div class="row col px-5">
					<h1>Interesados del curso: <span class="text-capitalize">{{curso.nombre}}</span></h1>
					<p>Lista de interesados del curso</p>

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>N°</th>
									<th>Nombres</th>
									<th>DNI</th>
									<th>Celular</th>
									<th>Correo</th>
									<th>Especialidad</th>
									<th>Ciudad</th>
									<th>Se entera</th>
									<th>Llamada</th>
									<th>Fecha llamada</th>
									<th>¿Con Certifificado?</th>
									<th>Total (S/)</th>
									<th>Concepto</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(interesado, index) in interesados" :data-id="interesado.id">
									<td>{{index+1}}</td>
									<td class="text-capitalize">
										<a href="#!" class="text-decoration-none" @click="abrirModalActividades"><i class="bi bi-list-check"></i> {{interesado.apellidos}} {{interesado.nombres}}</a>
									</td>
									<td>{{interesado.dni}}</td>
									<td>{{interesado.celular}}</td>
									<td>{{interesado.correo}}</td>
									<td>{{interesado.especialidad}}</td>
									<td>{{interesado.ciudad}}</td>
									<td>{{interesado.lugar}}</td>
									<td>
										<span v-if="interesado.llamada==1">Sí</span>
										<span v-else>No</span>
									</td>
									<td>
										<span v-if="interesado.llamada==1">{{fechaLatamHora(interesado.dia+' '+interesado.hora)}}</span>
									</td>
									<td>
										<div class="form-check" >
											<input class="form-check-input si" type="checkbox" v-model="interesado.conCertificado==1? true: false" v-if="interesado.conCertificado==1" value="true" @click="interesado.conCertificado=0; guardarPago(interesado.idCursoInteresado, index)" checked >
											<input class="form-check-input no" type="checkbox" v-model="interesado.conCertificado==1? true: false" v-else value="false" @click="interesado.conCertificado=1; guardarPago(interesado.idCursoInteresado, index)" >
											<label class="form-check-label" for="flexCheckDefault">
												<span v-if="interesado.conCertificado==1">Si</span>
												<span v-else>No</span>
											</label>
										</div>
									</td>
									<td class="col-1">
										<input type="number" class="form-control" :value="interesado.aPagar" @keypress.enter="guardarPago(interesado.idCursoInteresado, index)">
									</td>
									<td>
										<input type="text" v-model="interesado.concepto" class="form-control text-capitalize" @keypress.enter="guardarPago(interesado.idCursoInteresado, index)">
									</td>
									<td style="white-space: nowrap;">
										<button class="btn btn-outline-primary ms-1" @click="copiarLink(interesado.idCursoInteresado)"><i class="bi bi-pen"></i></button>
										<button class="btn btn-outline-warning ms-1" @click="copiarLink(interesado.idCursoInteresado)"><i class="bi bi-clipboard2"></i></button>
										<button v-if="interesado.celular!=''" @click="abrirWhatsapp(interesado.idCursoInteresado, interesado.celular)" class="btn btn-outline-success ms-1"><i class="bi bi-whatsapp"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				
				
				
			</div>
		</div>

		
		<!-- Modal para listar actividades -->
		<div class="modal fade" id="modalActividades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<label for=""></label>
						<select name="" id="">
							<option value="1">No esta interesado</option>
							<option value="1">No esta interesado</option>
						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php pie(); ?>
<script src="js/moment.min.js"></script>
<script>
	var modalActividades='';
	//var dominio = 'localhost/inaprofsis/';
	var dominio = 'https://esderecho.pe/intranet/';
  const { createApp } = Vue

  createApp({
    data() {
      return {
				interesados:[],
				curso :{
					id:-1, nombre:'', foto:''
				}, aPagar:0
      }
    },
		mounted(){
			this.cargarDatos();
			modalActividades = new bootstrap.Modal(document.getElementById('modalActividades'))

		},
		methods:{
			async cargarDatos(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('id', '<?= $_GET['idCurso']?>')
				let respServColaboradores = await fetch('./api/Curso.php',{
					method: 'POST', body:data
				});
				let temp = await respServColaboradores.json();
				this.curso = temp[0];

				let datos = new FormData();
				datos.append('pedir', 'listar')
				datos.append('id', '<?= $_GET['idCurso']?>')
				let respServInt = await fetch('./api/Interesados.php',{
					method: 'POST', body:datos
				});
				this.interesados = await respServInt.json();
			},
			
			fechaLatam(fechita){
				if(fechita == '' || fechita == null){
					return '';
				}else{
					return moment(fechita).format('DD/MM/YYYY')
				}
			},
			fechaLatamHora(fechita){
				if(fechita == '' || fechita == null){
					return '';
				}else{
					return moment(fechita).format('DD/MM/YYYY hh:mm a')
				}
			},
			async copiarLink(idCursoInteresado){
				let link = dominio+ 'registro_pago.php?id='+encodeURIComponent(btoa(idCursoInteresado));
				window.navigator.clipboard
          .writeText( link )
          .then(
              success => console.log("texto copiado"), 
              err => console.log("error copying text")
          );
			},
			abrirWhatsapp(idCursoInteresado, celular){
				let link = dominio+ 'registro_pago.php?id='+encodeURIComponent(btoa(idCursoInteresado));
				window.open('https://wa.me/51' + celular.trim()+"?text=" + encodeURIComponent("Su link de registro de pago es el siguiente: "+link+" solo puede registrar 1 sola vez"), '_blank')
			},
			monedaLatam(monedita){
				if(monedita==null){ return '-'; }
				else{ return parseFloat(monedita).toFixed(2); }
			},
			async guardarPago(idCursoInteresado, index){
				let data = new FormData();
				data.append('pedir', 'updatePago')
				data.append('id', idCursoInteresado)
				data.append('aPagar', this.interesados[index].aPagar )
				data.append('concepto', this.interesados[index].concepto )
				data.append('conCertificado', this.interesados[index].conCertificado )
				let respServColaboradores = await fetch('./api/Interesados.php',{
					method: 'POST', body:data
				});
				let respuesta = await respServColaboradores.text();
				console.log(respuesta);

			},
			abrirModalActividades(){
				modalActividades.show()
			},
			esCheck(caso){
				if(caso =='0'){ return false;}
				else{ return true;}
			}
		}
  }).mount('#app')
</script>
</body>
</html>