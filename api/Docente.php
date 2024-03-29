<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'listarCuentas': listarCuentas($db); break;
	case 'agregarCuentas': agregarCuentas($db); break;
	case 'eliminarCuentas': eliminarCuentas($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = 'and d.id = '.$_POST['id'];}
	if( isset($_POST['idDepartamento']) ){ $filtro = 'and d.idDepartamento = '.$_POST['idDepartamento'];}
	if( isset($_POST['idEspecialidad']) ){ $filtro .= ' and '.$_POST['idEspecialidad']. ' in (d.idEspecialidad, idEspecialidad2)';}
	if( isset($_POST['texto']) ){ $filtro .= ' and (nombres like "%'.$_POST['texto'].'%" or apellidos like "%'.$_POST['texto'].'%" or dni = "'.$_POST['texto'].'" )';}
	//echo $filtro;
	$sql = $db->query("SELECT d.*, e.descripcion as nomEspecialidad, e2.descripcion as nomEspecialidad2
	from docentes d 
	inner join especialidades e on e.id = d.idEspecialidad 
	inner join especialidades e2 on e2.id = d.idEspecialidad2 
	where d.activo =1 {$filtro} order by apellidos asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['docente'], true);
	if($conv['fechaNacimiento']==''){ $conv['fechaNacimiento']=null;}
	
	$sql = $db->prepare('INSERT INTO `docentes`(
		`idEspecialidad`,`idEspecialidad2`, `nombres`, `apellidos`, `dni`, `fechaNacimiento`, 
		`celular1`, `celular2`, `correo1`, `correo2`, `registroConciliador1`, 
		`registroConciliador2`, `registroCapacitador`, `direccion`, `lugarTrabajo`, `hijos`,
		`particularidades`, `hojaVida`,idDepartamento, idProvincia, idDistrito) VALUES (
		?,?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,? );');
	if($sql->execute([
		$conv['idEspecialidad'],$conv['idEspecialidad2'],$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['fechaNacimiento'],
		$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],$conv['registroConciliador1'],
		$conv['registroConciliador2'],$conv['registroCapacitador'],$conv['direccion'],$conv['lugarTrabajo'],$conv['hijos'],
		$conv['particularidades'],$conv['hojaVida'],$conv['idDepartamento'],$conv['idProvincia'],$conv['idDistrito']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['docente'], true);
	
	$sql = $db->prepare('UPDATE `docentes` set 
		`idEspecialidad`=?,`idEspecialidad2`=?, `nombres`=?, `apellidos`=?, `dni`=?, `fechaNacimiento`=?, 
		`celular1`=?, `celular2`=?, `correo1`=?, `correo2`=?, `registroConciliador1`=?, 
		`registroConciliador2`=?, `registroCapacitador`=?, `direccion`=?, `lugarTrabajo`=?, `hijos`=?,
		`particularidades`=?, `hojaVida`=?, idDepartamento=?, idProvincia=?, idDistrito=?
		WHERE `id`= ? ;');
	if($sql->execute([
		$conv['idEspecialidad'],$conv['idEspecialidad2'],$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['fechaNacimiento'],
		$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],$conv['registroConciliador1'],
		$conv['registroConciliador2'],$conv['registroCapacitador'],$conv['direccion'],$conv['lugarTrabajo'],$conv['hijos'],
		$conv['particularidades'],$conv['hojaVida'],$conv['idDepartamento'],$conv['idProvincia'],$conv['idDistrito'],
		$conv['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	
	$sql = $db->prepare('UPDATE `docentes` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function listarCuentas($db){
	$filas = [];
	
	$sql = $db->query("SELECT * FROM `docentes_cuentas` where idDocente= {$_POST['idDocente']};
	");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregarCuentas($db){
	
	$sql = $db->prepare('INSERT INTO `docentes_cuentas`(
		`idDocente`, `descripcion`, `cuenta`, `nombre`) VALUES (
		?, ?, ?, ?
		)');
	if($sql->execute([ $_POST['idDocente'], $_POST['descripcion'],$_POST['cuenta'],$_POST['nombre'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function eliminarCuentas($db){
	
	$sql = $db->prepare('DELETE FROM `docentes_cuentas` WHERE id = ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
?>