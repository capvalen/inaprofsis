<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'codificar': codificar($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = 'and d.id = '.$_POST['id'];}
	if( isset($_POST['idRama']) ){ $filtro .= ' and idRama = '.$_POST['idRama'];}
	if( isset($_POST['idArea']) ){ $filtro .= ' and idArea = '.$_POST['idArea'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (codigo like "%'.$_POST['texto'].'%" or dirigido like "%'.$_POST['texto'].'%" or cargo = "'.$_POST['texto'].'" or asunto = "'.$_POST['texto'].'" )';}
	//echo $filtro;
	$sql = $db->query("SELECT * FROM `oficios` where activo =1 {$filtro} order by codigo asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['oficio'], true);
	
	$sql = $db->prepare('INSERT INTO `oficios`(
		`idRama`, `idArea`, `fecha`, `dirigido`, `de`, 
		`cargo`, `asunto`, `documento`,`codigo`, `suscribe`) VALUES (
		?,?,?,?,?,
		?,?,?,?,?);');
	if($sql->execute([
		$conv['idRama'],$conv['idArea'],$conv['fecha'],$conv['dirigido'],$conv['de'],
		$conv['cargo'],$conv['asunto'],$conv['documento'],$conv['codigo'],$conv['suscribe']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['oficio'], true);
	
	$sql = $db->prepare('UPDATE `oficios` set 
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
	
	$sql = $db->prepare('UPDATE `oficios` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function codificar($db){
	
	$sql = $db->prepare('SELECT id FROM oficios order by id desc limit 1 ;');
	if($sql->execute()){
		$registro = $sql->fetch(PDO::FETCH_ASSOC);
		echo $registro['id']+1;
	}else{
		echo -1;
	}
}
?>