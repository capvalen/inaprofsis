<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'updatePago': updatePago($db); break;
	case 'listarInteresadoPago': listarInteresadoPago($db); break;
}

function listar($db){
	$filas = [];
	
	$sql = $db->prepare("SELECT /*interesado*/ ic.idInteresado,`nombres`, `apellidos`, `dni`, `celular`, `correo`, `colegio`, `ciudad`, `especialidad`, `llamada`, `dia`, `hora`, l.descripcion as desde, ic.id as idCursoInteresado, aPagar
	FROM `interesados_curso` ic inner join interesados i on i.id = ic.idInteresado inner join lugares l on l.id = ic.idLugar where idCurso = ?
	order by apellidos asc;");
	if($sql->execute([ $_POST['id'] ])){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['interesado'], true);
	
	$sql = $db->prepare('INSERT INTO `interesados`(
		`nombres`, `apellidos`, `dni`, `celular`, `correo`, 
		`colegio`, `ciudad`, `especialidad` ) VALUES (
		?,?,?,?,?,
		?,?,? );');
	if($sql->execute([
		$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['celular'],$conv['correo'],
		$conv['colegio'],$conv['ciudad'],$conv['especialidad']
	])){

	$idInteresado = $db->lastInsertId();

	$llamada = 0;
	
	if($conv['llamada']===true){ $llamada = 1;}
	$sql = $db->prepare('INSERT INTO `interesados_curso`(
		`idCurso`, `idInteresado`, `idLugar`, `llamada`, `dia`,
		`hora` ) VALUES (
		?,?,?,?,?,
		? );');
	$sql->execute([
		$conv['idCurso'],$idInteresado,$conv['lugar'],$llamada,$conv['dia'],
		$conv['hora']
	]);

	echo $idInteresado;
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['interesado'], true);
	
	$sql = $db->prepare('UPDATE `interesados` set 
		`idRama`=?, `idArea`=?, `fecha`=?, `dirigido`=?, `de`=?, 
		`cargo`=?, `asunto`=?, `documento`=?, `codigo`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['idRama'],$conv['idArea'],$conv['fecha'],$conv['dirigido'],$conv['de'],
		$conv['cargo'],$conv['asunto'],$conv['documento'],$conv['codigo'],$conv['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	
	$sql = $db->prepare('UPDATE `interesados` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}

function updatePago($db){
	
	$sql = $db->prepare('UPDATE `interesados_curso` set 
		`aPagar`=? WHERE `id`= ? ;');
	if($sql->execute([
		$_POST['aPagar'],$_POST['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function listarInteresadoPago($db){
	$filas = [];
	
	$sql = $db->prepare("SELECT /*interesado*/ ic.idInteresado,`nombres`, `apellidos`, `dni`, `celular`, `correo`, `colegio`, `ciudad`, `especialidad`, `llamada`, `dia`, `hora`, l.descripcion as desde, ic.id as idCursoInteresado, aPagar, c.nombre, c.foto
	FROM `interesados_curso` ic inner join interesados i on i.id = ic.idInteresado inner join lugares l on l.id = ic.idLugar 
	inner join cursos c on c.id = ic.idCurso
	where ic.id = ? and ic.activo = 1 and pagado = 0
	order by apellidos asc;");
	if($sql->execute([ $_POST['id'] ])){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}

?>