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
	if( isset($_POST['id']) ){ $filtro = 'and d.id = '.$_POST['id'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (nombre like "%'.$_POST['texto'].'%" )';}
	//echo $filtro;
	$sql = $db->query("SELECT * from prospecto_curso where activo = 1 order by nombre asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['proCurso'], true);
	
	$sql = $db->prepare('INSERT INTO `prospecto_curso`(
		`nombre`, `foto`) VALUES (
		?,? );');
	if($sql->execute([
		$conv['nombre'],$conv['foto']
	])){
		echo $db->lastInsertId();
	}else{
		//echo $sql->debugDumpParams();
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['proCurso'], true);
	
	$sql = $db->prepare('UPDATE `prospecto_curso` set 
		`nombre`=?, `foto`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['nombre'],$conv['foto'],$conv['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	$ruta= dirname(__DIR__,1) . "/images/subidas/" .$_POST['archivo'];
	unlink($ruta);

	$sql = $db->prepare('UPDATE `prospecto_curso` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
?>