<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Cursos'); ?>
<body>

	<?php menu(); ?>
	<style>
		label{font-size:0.8rem;}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12">
				<div class="row col p-4">
					<h1>Curso: <small class="text-muted">{{curso.nombre}}</small></h1>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row row-cols-2 row-cols-md-5">
							<div class="col">
								<p><strong>Año:</strong> <span>{{curso.anio}}</span></p>
							</div>
							<div class="col">
								<p><strong>Prog.</strong> <span>{{curso.desPrograma}}</span></p>
							</div>
							<div class="col">
								<p><strong>Eve.</strong> <span>{{curso.desEvento}}</span></p>
							</div>
							<div class="col">
								<p><strong>Cod.</strong> <span v-if="curso.codigo==''">-</span> <span v-else>{{curso.codigo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Mod.</strong> <span>{{curso.desModalidad}}</span></p>
							</div>
							<div class="col">
								<p><strong>Inicio</strong> <span>{{fechaLatam(curso.inicio)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Horas</strong> <span>{{curso.desHoras}}</span></p>
							</div>
							<div class="col">
								<p><strong>Conv.</strong> <span>{{curso.desConvenio}}</span></p>
							</div>
							<div class="col">
								<p><strong>Doc.</strong> <span>{{curso.nomDocente}}</span></p>
							</div>
							<div class="col">
								<p><strong>Doc. Reemp.</strong> <span>{{curso.nomDocenteReemplazo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Temario Archivo </strong> 
									<span v-if="curso.temarioArchivo==''">-</span>
									<span v-else><a :href="curso.temarioArchivo" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Temario Link: </strong> 
									<span v-if="curso.temarioLink==''">-</span>
									<span v-else><a :href="curso.temarioLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Cert.</strong> <span>{{curso.nomCertificado}}</span></p>
							</div>
							<div class="col">
								<p><strong>Brochure: </strong> 
									<span v-if="curso.brochureLink==''">-</span>
									<span v-else><a :href="curso.brochureLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Etapa</strong> <span>{{curso.etapaNombre}}</span></p>
							</div>
							<div class="col">
								<p><strong>Data: </strong> 
									<span v-if="curso.dataLink==''">-</span>
									<span v-else><a :href="curso.dataLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Vacantes</strong> <span>{{curso.vacantes}}</span></p>
							</div>
							<div class="col">
								<p><strong>Lista alumnos: </strong> 
									<span v-if="curso.checkAlumnos==0"><i class="bi bi-x-lg"></i></span>
									<span v-else><i class="bi bi-check-lg"></i></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Lista afianzamiento: </strong> 
									<span v-if="curso.checkAfianzamiento==0"><i class="bi bi-x-lg"></i></span>
									<span v-else><i class="bi bi-check-lg"></i></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Lista aprobados: </strong> 
									<span v-if="curso.checkAprobados==0"><i class="bi bi-x-lg"></i></span>
									<span v-else><i class="bi bi-check-lg"></i></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Autorización: </strong> 
									<span v-if="curso.autorizacion==''">-</span>
									<span v-else><a :href="curso.autorizacion" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Resp. #1</strong> <span>{{curso.nomResponsable1}}</span></p>
							</div>
							<div class="col">
								<p><strong>Resp. #2</strong> <span>{{curso.nomResponsable2}}</span></p>
							</div>
							<div class="col">
								<p><strong>Prospecto: </strong> 
									<span v-if="curso.prospectoLink==''">-</span>
									<span v-else><a :href="curso.prospectoLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Grupo:</strong> <span>{{curso.grupo}}</span></p>
							</div>
							<div class="col">
								<p><strong>Catálogo: </strong> 
									<span v-if="curso.catalogoLink==''">-</span>
									<span v-else><a :href="curso.catalogoLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>
							<div class="col">
								<p><strong>Video: </strong> 
									<span v-if="curso.videoLink==''">-</span>
									<span v-else><a :href="curso.videoLink" target="_blank">Link <i class="bi bi-box-arrow-up-right"></i></a></span>
								</p>
							</div>


						</div>
						<div class="row">
							<div class="col">
								<p><strong>Detalles</strong> <span v-html="curso.detalles.replaceAll('\n', '<br>')"></span></p>
							</div>
							<div class="col">
								<p><strong>Cambios</strong> <span v-html="curso.cambios.replaceAll('\n', '<br>')"></span></p>
							</div>
						</div>
					</div>
				</div>

				<div class="card my-3">
					<div class="card-body">
						<p><strong>Listado de precios:</strong></p>
						<div class="row row-cols-2 row-cols-md-4">
							<div class="col">
								<p><strong>General</strong> <span>S/ {{monedaLatam(curso.pGeneral)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Ex. Alumnos</strong> <span>S/ {{monedaLatam(curso.pExalumnos)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Corporativo</strong> <span>S/ {{monedaLatam(curso.pCorporativo)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Pronto pago</strong> <span>S/ {{monedaLatam(curso.pPronto)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Remate</strong> <span>S/ {{monedaLatam(curso.pRemate)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Media beca</strong> <span>S/ {{monedaLatam(curso.pMediaBeca)}}</span></p>
							</div>
							<div class="col">
								<p><strong>Especial</strong> <span>S/ {{monedaLatam(curso.pEspecial)}}</span></p>
							</div>
						</div>
					</div>
				</div>


				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<p>Lista de matriculados</p>
							<button class="btn btn-sm btn-outline-success"><i class="bi bi-person-bounding-box"></i> Matricular alumno</button>
						</div>
						<div class="table-responsive-md">
		
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Nombre</th>
									<th>Programa</th>
									<th>Evento</th>
									<th>Año</th>
									<th>Fecha</th>
									<th>@</th>
		
								</thead>
								<tbody>
									<tr v-for="(curso, index) in cursos">
										<td>{{index+1}}</td>
										<td><a class="text-decoration-none" :href="'cursoDetalle.php?id='+curso.id">{{curso.nombre}}</a></td>
										<td>{{curso.desPrograma}}</td>
										<td>{{curso.desEvento}}</td>
										<td>{{curso.anio}}</td>
										<td>{{fechaLatam(curso.inicio)}}</td>
										<td>
											<button type="button" class="btn btn-outline-primary btn-sm border-0" @click="editarCurso(index)"><i class="bi bi-pencil-square"></i></button>
											<button type="button" class="btn btn-outline-danger btn-sm border-0" @click="eliminarCurso(curso.id, index)"><i class="bi bi-x-circle-fill"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
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
				cursos:[],
				curso:{
					anio: '<?= date('Y');?>', idPrograma:1, idEvento:1, nombre:'', codigo:'', idModalidad:1, inicio:'', fechasLink:'', idHora:1, idConvenio:1, pGeneral:0, pExalumnos:0, pCorporativo:0, pPronto:0, pRemate:0, pMediaBeca:0, pEspecial:0, idDocente:1, idDocenteReemplazo:1, temarioLink:'', temarioArchivo:'', idTipoCertificado:1, brochureLink:'', idEtapa:1, detalles:'', dataLink:'', vacantes:0, autorizacion:'', cambios:'', checkAlumnos:0, checkAfianzamiento:0, checkAprobados:0, idResponsable1:1, idResponsable2:1, prospectoLink:'', grupo:'', catalogoLink:'', videoLink:''
				}
      }
    },
		mounted(){
			this.pedirCurso();
			
		},
		methods:{
			
			async pedirCurso(){
				let data = new FormData();
				data.append('pedir', 'listar')
				data.append('id', '<?= $_GET['id']?>')
				let respServ = await fetch('./api/Curso.php',{
					method: 'POST', body:data
				});
				let resp = await respServ.json();
				this.cursos = resp;
				this.curso = this.cursos[0];
				console.log(this.cursos);
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