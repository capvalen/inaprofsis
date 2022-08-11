<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'verAgenda': verAgenda($db); break;
	case 'culminarAgenda': culminarAgenda($db); break;
	case 'addNewAgenda': addNewAgenda($db); break;
	case 'addObsAgenda': addObsAgenda($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = 'and c.id = '.$_POST['id'];}
	if( isset($_POST['idEspecialidad']) ){ $filtro .= ' and idEspecialidad = '.$_POST['idEspecialidad'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (nombres like "%'.$_POST['texto'].'%" or apellidos like "%'.$_POST['texto'].'%" or dni = "'.$_POST['texto'].'" )';}

	$sql = $db->query("SELECT c.*, e.descripcion as nomEspecialidad, ca.descripcion as nomCargo from colaboradores c 
	inner join especialidades e on e.id = c.idEspecialidad
	inner join cargo ca on ca.id = c.idCargo
	where c.activo =1 {$filtro} order by nombres asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['colaborador'], true);
	if($conv['fechaNacimiento']==''){ $conv['fechaNacimiento']=null;}
	
	$sql = $db->prepare('INSERT INTO `colaboradores`(
		`nombres`, `apellidos`, `dni`, `idCargo`, `fechaNacimiento`, 
		`whatsapp`, `celular1`, `celular2`, `correo1`, `correo2`, 
		`carrera`, `idEspecialidad`, `direccion`, `hijos`, `nombresHijos`, 
		`detalles`, `hojaVida`, `periodo`, `pago`, `remuneracion`
		) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?
		);');
	if($sql->execute([
		$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['idCargo'],$conv['fechaNacimiento'],
		$conv['whatsapp'],$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],
		$conv['carrera'],$conv['idEspecialidad'],$conv['direccion'],$conv['hijos'],$conv['nombresHijos'],
		$conv['detalles'],$conv['hojaVida'],$conv['periodo'],$conv['pago'],$conv['remuneracion']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['colaborador'], true);
	
	$sql = $db->prepare('UPDATE `colaboradores` set 
		`nombres`=?, `apellidos`=?, `dni`=?, `idCargo`=?, `fechaNacimiento`=?, 
		`whatsapp`=?, `celular1`=?, `celular2`=?, `correo1`=?, `correo2`=?, 
		`carrera`=?, `idEspecialidad`=?, `direccion`=?, `hijos`=?, `nombresHijos`=?,
		`detalles`=?, `hojaVida`=?, `periodo`=?, `pago`=?, `remuneracion`=?
		WHERE `id`= ? ;');
	if($sql->execute([
		$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['idCargo'],$conv['fechaNacimiento'],
		$conv['whatsapp'],$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],
		$conv['carrera'],$conv['idEspecialidad'],$conv['direccion'],$conv['hijos'],$conv['nombresHijos'],
		$conv['detalles'],$conv['hojaVida'],$conv['periodo'],$conv['pago'],$conv['remuneracion'],
		$conv['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	
	$sql = $db->prepare('UPDATE `colaboradores` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function verAgenda($db){
	$filas = [];
	$filtro = '';
	if( $_POST['nivel'] ==1 ){ $filtro = '';}else{ $filtro = ' and activo =1 '; }

	$sql = $db->query("SELECT * from agenda
	where idColaborador= {$_POST['id']} {$filtro} order by id desc limit 50;");
	if($sql->execute()){
		//echo $sql->debugDumpParams();
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function culminarAgenda($db){
	
	$sql = $db->prepare('UPDATE `agenda` set 
		`respuesta`=?, `checked`=1, `actualizacion` = now()
		WHERE `id`= ? ;');
	if($sql->execute([
		$_POST['respuesta'],$_POST['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function addNewAgenda($db){
	
	$sql = $db->prepare('INSERT INTO `agenda`(
		`idColaborador`, `fecha`, `hora`, `actividad`) VALUES (
		?,?,?,?) ;');
	if($sql->execute([
		$_POST['idColaborador'],$_POST['fecha'],$_POST['hora'],$_POST['actividad']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function addObsAgenda($db){
	
	$sql = $db->prepare('UPDATE `agenda` set 
		`observaciones`= concat(`observaciones`, ?), `checked`=1
		WHERE `id`= ? ;');
	if($sql->execute([
		$_POST['observacion'],$_POST['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
?>