<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<?php cabecera('Configuraciones'); ?>

<body>

	<?php menu(); ?>
	<style>
		label {
			font-size: 0.8rem;
		}
	</style>
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<div class="row col px-5">
					<h1>Configuraciones</h1>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="areas-tab" data-bs-toggle="tab" data-bs-target="#areas-tab-pane" type="button" role="tab" aria-controls="areas-tab-pane" aria-selected="false">Áreas</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link " id="bancos-tab" data-bs-toggle="tab" data-bs-target="#bancos-tab-pane" type="button" role="tab" aria-controls="bancos-tab-pane" aria-selected="false">Bancos</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link " id="categorias-tab" data-bs-toggle="tab" data-bs-target="#categoria-tab-pane" type="button" role="tab" aria-controls="categoria-tab-pane" aria-selected="true">Categorías</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="especialidades-tab" data-bs-toggle="tab" data-bs-target="#especialidades-tab-pane" type="button" role="tab" aria-controls="especialidades-tab-pane" aria-selected="false">Especialidades</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="eventos-tab" data-bs-toggle="tab" data-bs-target="#eventos-tab-pane" type="button" role="tab" aria-controls="eventos-tab-pane" aria-selected="false">Eventos</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="horas-tab" data-bs-toggle="tab" data-bs-target="#horas-tab-pane" type="button" role="tab" aria-controls="horas-tab-pane" aria-selected="false">Horas</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="modalidades-tab" data-bs-toggle="tab" data-bs-target="#modalidades-tab-pane" type="button" role="tab" aria-controls="modalidades-tab-pane" aria-selected="false">Modalidades</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="programas-tab" data-bs-toggle="tab" data-bs-target="#programas-tab-pane" type="button" role="tab" aria-controls="programas-tab-pane" aria-selected="false">Programas</button>
						</li>
						
						
						<!-- <li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
						</li> -->
					</ul>
					<div class="tab-content p-4" id="myTabContent">

						<div class="tab-pane fade " id="bancos-tab-pane" role="tabpanel" aria-labelledby="bancos-tab" >
							<div class="mb-2"><button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalBanco"><i class="bi bi-coin"></i> Nuevo banco</button></div>
							<div class="list-group col col-md-6">
								<div v-for="(banco, index) in bancos" class="list-group-item list-group-item-action " :data-id="banco.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{banco.entidad}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarBanco(index)"><i class="bi bi-x"></i></button>
									</div>
									<p class="mb-1">N° Cuenta: {{banco.nCuenta==''? '-' : banco.nCuenta}}</p>
								</div>
							</div>
						</div>

						<div class="tab-pane fade " id="categoria-tab-pane" role="tabpanel" aria-labelledby="categoria-tab" >
							<div class="mb-2">
								<button class="btn btn-outline-warning" @click="nuevo.queEs='categoria'" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nueva categoria</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(categoria, index) in categorias" class="list-group-item list-group-item-action " :data-id="categoria.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{categoria.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="programas-tab-pane" role="tabpanel" aria-labelledby="programas-tab" tabindex="0">
							<div class="mb-2">
								<button class="btn btn-outline-warning" @click="nuevo.queEs='programa'" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nuevo programa</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(programa, index) in programas" class="list-group-item list-group-item-action " :data-id="programa.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{programa.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
									<p class="mb-1">Abreviatura: {{programa.abreviatura}}</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="eventos-tab-pane" role="tabpanel" aria-labelledby="eventos-tab" tabindex="0">
							<div class="mb-2">
								<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nuevo evento</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(evento, index) in eventos" class="list-group-item list-group-item-action " :data-id="evento.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{evento.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
									<p class="mb-1">Abreviatura: {{evento.abreviatura}}</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="especialidades-tab-pane" role="tabpanel" aria-labelledby="especialidades-tab" tabindex="0">
							<div class="mb-2">
								<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nueva especialidad</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(especialidad, index) in especialidades" class="list-group-item list-group-item-action " :data-id="especialidad.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{especialidad.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
									<p class="mb-1">Abreviatura: {{especialidad.abreviatura}}</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="modalidades-tab-pane" role="tabpanel" aria-labelledby="modalidades-tab" tabindex="0">
							<div class="mb-2">
								<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nueva modalidad</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(modalidad, index) in modalidades" class="list-group-item list-group-item-action " :data-id="modalidad.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{modalidad.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
									<p class="mb-1">Abreviatura: {{modalidad.abreviatura}}</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="horas-tab-pane" role="tabpanel" aria-labelledby="horas-tab" tabindex="0">
							<div class="mb-2">
								<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nueva hora</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(hora, index) in horas" class="list-group-item list-group-item-action " :data-id="hora.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{hora.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade show active" id="areas-tab-pane" role="tabpanel" aria-labelledby="areas-tab" tabindex="0">
							<div class="mb-2">
								<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalNuevo"><i class="bi bi-box-seam"></i> Nueva área</button>
							</div>
							<div class="list-group col col-md-6">
								<div v-for="(area, index) in areas" class="list-group-item list-group-item-action " :data-id="area.id">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1 lead text-capitalize">{{index+1}}. {{area.descripcion}}</h5>
										<button class="btn btn-outline-danger btn-sm border-0" @click="eliminarCaso(index)"><i class="bi bi-x"></i></button>
									</div>
									<p class="mb-1">Abreviatura: {{area.abreviatura}}</p>
								</div>
							</div>
						</div>

						<!-- <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div> -->

					</div>



				</div>
			</div>
		</div>

		<!-- Modal para add banco-->
		<div class="modal fade" id="modalBanco" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo banco</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<label for="">Nombre de la entidad</label>
						<input type="text" class="form-control" v-model="banco.entidad">
						<label for="">N° de cuenta</label>
						<input type="text" class="form-control" v-model="banco.nCuenta">
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-outline-primary btn-sm" @click="guardarBanco()"><i class="bi bi-save"></i> Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal para add categorias-->
		<div class="modal fade" id="modalNuevo" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<label for="">{{nuevo.nombre1}}</label>
						<input type="text" class="form-control" v-model="nuevo.descripcion">
						<div v-if="nuevo.verDato2">
							<label for="">{{nuevo.nombre2}}</label>
							<input type="text" class="form-control" v-model="nuevo.adicional">
						</div>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-outline-primary btn-sm" @click="guardarCaso()"><i class="bi bi-save"></i> Guardar</button>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php pie(); ?>
	<script>
		var modalBanco, modalNuevo;
		const {
			createApp
		} = Vue

		createApp({
			data() {
				return {
					bancos: [], programas:[], eventos:[], especialidades:[], modalidades:[], horas:[], areas:[],
					banco: {entidad: '', cuenta: ''},
					nuevo: {
						descripcion: '',
						adicional: '',
						nombre1: 'Descripción',
						nombre2: 'Adicional',
						verDato2: false,
						queEs: 'area'
					},
					categorias: [],

				}
			},
			mounted() {
				this.cargarCaso();
				modalBanco = new bootstrap.Modal(document.getElementById('modalBanco'));
				modalNuevo = new bootstrap.Modal(document.getElementById('modalNuevo'));
				const triggerTabList = document.querySelectorAll('#myTab button')
				triggerTabList.forEach(triggerEl => {
					const tabTrigger = new bootstrap.Tab(triggerEl)

					triggerEl.addEventListener('click', event => {
						event.preventDefault()
						switch (event.target.id) {
							case 'bancos-tab':
								this.cargarBancos(); break;
							case 'categorias-tab':
								this.nuevo.queEs='categoria';
								this.nuevo.nombre1='Categoría';
								this.nuevo.verDato2=false;
								this.cargarCategorias(); break;
							case 'programas-tab':
								this.nuevo.queEs='programa';
								this.nuevo.nombre1='Programa';
								this.nuevo.nombre2='Abreviatura';
								this.nuevo.verDato2=true;
								this.cargarCaso(); break;
							case 'eventos-tab':
								this.nuevo.queEs='evento';
								this.nuevo.nombre1='Evento';
								this.nuevo.nombre2='Abreviatura';
								this.nuevo.verDato2=true;
								this.cargarCaso(); break;
							case 'especialidades-tab':
								this.nuevo.queEs='especialidad';
								this.nuevo.nombre1='Especialidades';
								this.nuevo.nombre2='Abreviatura';
								this.nuevo.verDato2=true;
								this.cargarCaso(); break;
							case 'modalidades-tab':
								this.nuevo.queEs='modalidad';
								this.nuevo.nombre1='Modalidad';
								this.nuevo.nombre2='Abreviatura';
								this.nuevo.verDato2=true;
								this.cargarCaso(); break;
							case 'horas-tab':
								this.nuevo.queEs='hora';
								this.nuevo.nombre1='Horas';
								this.nuevo.verDato2=false;
								this.cargarCaso(); break;
							case 'areas-tab':
								this.nuevo.queEs='area';
								this.nuevo.nombre1='Áreas';
								this.nuevo.nombre2='Abreviatura';
								this.nuevo.verDato2=true;
								this.cargarCaso(); break;
						}

						tabTrigger.show()
					})
				})

			},
			methods: {
				async cargarBancos() {
					let data = new FormData();
					data.append('pedir', 'listarBancos');
					let respBancos = await fetch('./api/Configuraciones.php', {
						method: 'POST',
						body: data
					});
					this.bancos = await respBancos.json();
				},
				async eliminarBanco(index) {
					if (confirm(`¿Deseas eliminar el banco llamado: ${this.bancos[index].entidad}?`)) {
						let data = new FormData();
						data.append('pedir', 'eliminarBancos');
						data.append('id', this.bancos[index].id);
						let respBancos = await fetch('./api/Configuraciones.php', {
							method: 'POST',
							body: data
						});
						let respuesta = await respBancos.text();
						if (respuesta == '1') {
							this.bancos.splice(index, 1);
						}
					}
				},
				async guardarBanco() {
					let data = new FormData();
					data.append('pedir', 'addBancos');
					data.append('banco', JSON.stringify(this.banco));
					let respBancos = await fetch('./api/Configuraciones.php', {
						method: 'POST',
						body: data
					});
					const temp = await respBancos.text();
					modalBanco.hide();
					if (temp > 0) {
						this.cargarBancos();
					} else {
						alert('Hubo un error guardando el dato');
					}
				},
				async cargarCategorias(){
					let data = new FormData();
					data.append('pedir', 'listarCategorias');
					let resp = await fetch('./api/Configuraciones.php', {
						method: 'POST',body: data
					});
					this.categorias = await resp.json();
				},
				async cargarCaso() {
					let data = new FormData();
					switch(this.nuevo.queEs){
						case 'categoria': data.append('pedir', 'listarCategorias'); break;
						case 'programa': data.append('pedir', 'listarProgramas'); break;
						case 'evento': data.append('pedir', 'listarEventos'); break;
						case 'especialidad': data.append('pedir', 'listarEspecialidades'); break;
						case 'modalidad': data.append('pedir', 'listarModalidades'); break;
						case 'hora': data.append('pedir', 'listarHoras'); break;
						case 'area': data.append('pedir', 'listarAreas'); break;
					}
					let resp = await fetch('./api/Configuraciones.php', {
						method: 'POST',
						body: data
					});
					switch(this.nuevo.queEs){
						case 'categoria': this.categorias = await resp.json(); break;
						case 'programa': this.programas = await resp.json(); break;
						case 'evento': this.eventos = await resp.json(); break;
						case 'especialidad': this.especialidades = await resp.json(); break;
						case 'modalidad': this.modalidades = await resp.json(); break;
						case 'hora': this.horas = await resp.json(); break;
						case 'area': this.areas = await resp.json(); break;
					}
				},
				async guardarCaso(){
					let data = new FormData();
					switch(this.nuevo.queEs){
						case 'categoria': data.append('pedir', 'addCategorias'); break;
						case 'programa': data.append('pedir', 'addProgramas'); break;
						case 'evento': data.append('pedir', 'addEventos'); break;
						case 'especialidad': data.append('pedir', 'addEspecialidades'); break;
						case 'modalidad': data.append('pedir', 'addModalidades'); break;
						case 'hora': data.append('pedir', 'addHoras'); break;
						case 'area': data.append('pedir', 'addAreas'); break;
					}
					data.append('datos', JSON.stringify(this.nuevo));
					let resp = await fetch('./api/Configuraciones.php', {
						method: 'POST', body: data
					});
					modalNuevo.hide();
					const temp = await resp.text();
					if (temp > 0) {
						this.cargarCaso();
					} else {
						alert('Hubo un error guardando el dato');
					}
				},
				async eliminarCaso(index) {
					var nombre ='', id=-1;
					switch(this.nuevo.queEs){
						case 'categoria':
							nombre = this.categorias[index].descripcion; id=this.categorias[index].id;break;
						case 'programa':
							nombre = this.programas[index].descripcion; id=this.programas[index].id;break;
						case 'evento':
							nombre = this.eventos[index].descripcion; id=this.eventos[index].id;break;
						case 'especialidad':
							nombre = this.especialidades[index].descripcion; id=this.especialidades[index].id;break;
						case 'modalidad':
							nombre = this.modalidades[index].descripcion; id=this.modalidades[index].id;break;
						case 'hora':
							nombre = this.horas[index].descripcion; id=this.horas[index].id;break;
						case 'area':
							nombre = this.areas[index].descripcion; id=this.areas[index].id;break;
					}
					if (confirm(`¿Deseas eliminar el banco llamado: ${nombre}?`)) {
						let data = new FormData();
						switch(this.nuevo.queEs){
							case 'categoria': data.append('pedir', 'eliminarCategorias'); break;
							case 'programa': data.append('pedir', 'eliminarProgramas'); break;
							case 'evento': data.append('pedir', 'eliminarEventos'); break;
							case 'especialidad': data.append('pedir', 'eliminarEspecialidades'); break;
							case 'modalidad': data.append('pedir', 'eliminarModalidades'); break;
							case 'hora': data.append('pedir', 'eliminarHoras'); break;
							case 'area': data.append('pedir', 'eliminarAreas'); break;
						}
						data.append('id', id);
						let resp = await fetch('./api/Configuraciones.php', {
							method: 'POST',
							body: data
						});
						let respuesta = await resp.text();
						if (respuesta == '1') {
							switch(this.nuevo.queEs){
								case 'categoria': this.categorias.splice(index, 1); break;
								case 'programa': this.programas.splice(index, 1); break;
								case 'evento': this.eventos.splice(index, 1); break;
								case 'especialidad': this.especialidades.splice(index, 1); break;
								case 'modalidad': this.modalidades.splice(index, 1); break;
								case 'hora': this.horas.splice(index, 1); break;
								case 'area': this.areas.splice(index, 1); break;
							}
							
						}
					}
				},
			}
		}).mount('#app')
	</script>

</body>

</html>