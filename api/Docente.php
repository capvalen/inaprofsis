<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = 'and id = '.$_POST['id'];}
	$sql = $db->query("SELECT d.*, e.descripcion from docentes d inner join especialidad e on e.id = d.idEspecialidad where d.activo =1 {$filtro} order by apellidos asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['docente'], true);
	
	$sql = $db->prepare('INSERT INTO `docentes`(
		`idEspecialidad`, `nombres`, `apellidos`, `dni`, `fechaNacimiento`, 
		`celular1`, `celular2`, `correo1`, `correo2`, `registroConciliador1`, 
		`registroConciliador2`, `registroCapacitador`, `direccion`, `lugarTrabajo`, `hijos`,
		`particularidades`, `hojaVida`) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?, ? );');
	if($sql->execute([
		$conv['idEspecialidad'],$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['fechaNacimiento'],
		$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],$conv['registroConciliador1'],
		$conv['registroConciliador2'],$conv['registroCapacitador'],$conv['direccion'],$conv['lugarTrabajo'],$conv['hijos'],
		$conv['particularidades'],$conv['hojaVida']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['docente'], true);
	
	$sql = $db->prepare('UPDATE `docentes` set 
		`idEspecialidad`=?, `nombres`=?, `apellidos`=?, `dni`=?, `fechaNacimiento`=?, 
		`celular1`=?, `celular2`=?, `correo1`=?, `correo2`=?, `registroConciliador1`=?, 
		`registroConciliador2`=?, `registroCapacitador`=?, `direccion`=?, `lugarTrabajo`=?, `hijos`=?,
		`particularidades`=?, `hojaVida`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['idEspecialidad'],$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['fechaNacimiento'],
		$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],$conv['registroConciliador1'],
		$conv['registroConciliador2'],$conv['registroCapacitador'],$conv['direccion'],$conv['lugarTrabajo'],$conv['hijos'],
		$conv['particularidades'],$conv['hojaVida'], $conv['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	
	$sql = $db->prepare('UPDATE `convenios` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
?>