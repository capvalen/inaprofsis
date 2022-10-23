<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'porVencer': porVencer($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = ' and id = '.$_POST['id'];}
	if( isset($_POST['idCategoria']) ){ $filtro = ' and idCategoria = '.$_POST['idCategoria'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (entidad like "%'.$_POST['texto'].'%" or representante like "%'.$_POST['texto'].'%") ';}
	if( isset($_POST['anios']) ){ $filtro .= ' and DATE_FORMAT(fecha, "%Y") = '.$_POST['anios'].' ';}
	//echo $filtro;
	$sql = $db->query("SELECT * from convenios where activo =1 {$filtro} order by entidad asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['convenio'], true);
	
	$sql = $db->prepare('INSERT INTO `convenios`(
		`entidad`, `representante`, `fecha`, `periodo`, `acuerdos`, 
		`autoridades`, `telefono`, `celular`, `web`, `idCategoria`, 
		`observaciones`) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		? );');
	if($sql->execute([
		$conv['entidad'],$conv['representante'],$conv['fecha'],$conv['periodo'],$conv['acuerdos'],
		$conv['autoridades'],$conv['telefono'],$conv['celular'],$conv['web'],$conv['idCategoria'],
		$conv['observaciones']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['convenio'], true);
	
	$sql = $db->prepare('UPDATE `convenios` set 
		`entidad` =?, `representante`=?, `fecha`=?,`fechaFin`=?, `periodo`=?,
		`acuerdos`=?, `autoridades`=?, `telefono`=?, `celular`=?, `web`=?,
		`idCategoria`=?, `observaciones`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['entidad'],$conv['representante'],$conv['fecha'],$conv['fechaFin'],$conv['periodo'],$conv['acuerdos'],$conv['autoridades'],$conv['telefono'],$conv['celular'],$conv['web'],
		$conv['idCategoria'],$conv['observaciones'], $conv['id']
	])){
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
function porVencer($db){
	$filas = [];
	$sql = $db->query("SELECT * from convenios where activo =1 
	and DATEDIFF( fechaFin, CURRENT_DATE() ) between 0 and 40
	order by entidad asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
?>