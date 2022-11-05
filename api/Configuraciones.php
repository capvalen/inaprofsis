<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listarBancos': listarBancos($db); break;
	case 'addBancos': addBancos($db); break;
	case 'eliminarBancos': eliminarBancos($db); break;

	case 'listarCategorias': listarCategorias($db); break;
	case 'addCategorias': addCategorias($db); break;
	case 'eliminarCategorias': eliminarCategorias($db); break;

	case 'listarProgramas': listarProgramas($db); break;
	case 'addProgramas': addProgramas($db); break;
	case 'eliminarProgramas': eliminarProgramas($db); break;

	case 'listarEventos': listarEventos($db); break;
	case 'addEventos': addEventos($db); break;
	case 'eliminarEventos': eliminarEventos($db); break;

	case 'listarEspecialidades': listarEspecialidades($db); break;
	case 'addEspecialidades': addEspecialidades($db); break;
	case 'eliminarEspecialidades': eliminarEspecialidades($db); break;

	case 'listarModalidades': listarModalidades($db); break;
	case 'addModalidades': addModalidades($db); break;
	case 'eliminarModalidades': eliminarModalidades($db); break;

	case 'listarHoras': listarHoras($db); break;
	case 'addHoras': addHoras($db); break;
	case 'eliminarHoras': eliminarHoras($db); break;

	case 'listarAreas': listarAreas($db); break;
	case 'addAreas': addAreas($db); break;
	case 'eliminarAreas': eliminarAreas($db); break;
}

function listarBancos($db){
	$filas = [];
	$sql = $db->query("SELECT * from bancos where activo =1 and id<>1 order by entidad asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function eliminarBancos($db){
	$sql = $db->query("UPDATE `bancos` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}
function addBancos($db){
	$conv = json_decode($_POST['banco'], true);

	$sql = $db->prepare("INSERT INTO `bancos`(`entidad`, `nCuenta`) VALUES (?, ?)");
	if($sql->execute([ $conv['entidad'], $conv['nCuenta'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}

function listarCategorias($db){
	$filas = [];
	$sql = $db->query("SELECT * from categoria where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addCategorias($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `categoria`(`descripcion`) VALUES (?)");
	if($sql->execute([ $conv['descripcion'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarCategorias($db){
	$sql = $db->query("UPDATE `categoria` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}

function listarProgramas($db){
	$filas = [];
	$sql = $db->query("SELECT * from programas where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addProgramas($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `programas`(`descripcion`, `abreviatura`) VALUES (?, ?)");
	if($sql->execute([ $conv['descripcion'], $conv['adicional'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarProgramas($db){
	$sql = $db->query("UPDATE `programas` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}

function listarEventos($db){
	$filas = [];
	$sql = $db->query("SELECT * from eventos where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addEventos($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `eventos`(`descripcion`, `abreviatura`) VALUES (?, ?)");
	if($sql->execute([ $conv['descripcion'], $conv['adicional'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarEventos($db){
	$sql = $db->query("UPDATE `eventos` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}

function listarEspecialidades($db){
	$filas = [];
	$sql = $db->query("SELECT * from especialidades where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addEspecialidades($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `especialidades`(`descripcion`, `abreviatura`) VALUES (?, ?)");
	if($sql->execute([ $conv['descripcion'], $conv['adicional'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarEspecialidades($db){
	$sql = $db->query("UPDATE `especialidades` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}

function listarModalidades($db){
	$filas = [];
	$sql = $db->query("SELECT * from modalidades where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addModalidades($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `modalidades`(`descripcion`, `abreviatura`) VALUES (?, ?)");
	if($sql->execute([ $conv['descripcion'], $conv['adicional'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarModalidades($db){
	$sql = $db->query("UPDATE `modalidades` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}

function listarHoras($db){
	$filas = [];
	$sql = $db->query("SELECT * from horas where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addHoras($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `horas`(`descripcion`) VALUES (?)");
	if($sql->execute([ $conv['descripcion'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarHoras($db){
	$sql = $db->query("UPDATE `horas` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}

function listarAreas($db){
	$filas = [];
	$sql = $db->query("SELECT * from areas where activo =1 and id<>1 order by descripcion asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function addAreas($db){
	$conv = json_decode($_POST['datos'], true);

	$sql = $db->prepare("INSERT INTO `areas`(`descripcion`, `abreviatura`) VALUES (?, ?)");
	if($sql->execute([ $conv['descripcion'], $conv['adicional'] ])){
		echo $db->lastInsertId();
	}else{
		echo 0;
	}
}
function eliminarAreas($db){
	$sql = $db->query("UPDATE `areas` SET `activo`=0 WHERE `id`={$_POST['id']};");
	if($sql->execute()){
		echo '1';
	}else{
		echo '0';
	}
}
?>