<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'listarPro': listarPro($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = ' and c.id = '.$_POST['id'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (nombre like "%'.$_POST['texto'].'%" )';}
	//echo $filtro;
	$sql = $db->query("SELECT 
	c.id, c.nombre, c.foto, c.inicio, c.meta,
	pc.id as idProcurso, `tiempo`, `fecha`, `idResponsable`, `observacion`,
	co.nombres
	FROM cursos c
	left join prospecto_curso pc on pc.idCurso = c.id
	left join colaboradores co on co.id = pc.idResponsable
	where c.activo = 1 {$filtro} 
	order by inicio desc
	;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function listarPro($db){
	$filas = [];
	
	$sql = $db->query("SELECT 
	pc.id, pc.idCurso, `idResponsable`, `observacion`, pGeneral,
	co.nombres, cu.nombre, cu.foto, cu.inicio, m.descripcion as modalidad
	FROM prospecto_curso pc
	inner join cursos cu on cu.id = pc.idCurso
	left join modalidades m on m.id = cu.idModalidad
	left join colaboradores co on co.id = pc.idResponsable
	order by cu.nombre desc
	;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	
	$sql = $db->prepare('INSERT INTO `prospecto_curso`(
		`idCurso` ) VALUES (
		?); ');
	if($sql->execute([
		$_POST['idCurso']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
	//echo $sql->debugDumpParams();
}
function actualizar($db){
	$conv = json_decode($_POST['proCurso'], true);
	
	$sql = $db->prepare('UPDATE `prospecto_curso` set 
		`tiempo`=?, `fecha`=?, `idResponsable`=?, `observacion`=?
		WHERE `id`= ? ;');
	if($sql->execute([
		$conv['tiempo'],$conv['fecha'],$conv['idResponsable'],$conv['observacion'],
		$conv['idProcurso'],
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	$sql = $db->prepare('DELETE FROM `prospecto_curso` WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
?>