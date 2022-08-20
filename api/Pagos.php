<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'aprobar1': aprobar1($db); break;
	case 'aprobar2': aprobar2($db); break;
	case 'anularPago': anularPago($db); break;
	case 'add': agregar($db); break;
	/* case 'delete': borrar($db); break; */
	case 'verificar': verificar($db); break;
}

function listar($db){
	$filas = [];
	$sql = $db->prepare("SELECT p.*, c.nombre, ca.descripcion, b.entidad, 'Carlos' as nomUsuario from pagos p
	inner join matricula m on m.id = p.idMatricula
	inner join cursos c on c.id = m.idCurso
	inner join cargos ca on ca.id = p.idCargos
	inner join bancos b on b.id = p.idBanco
	where p.activo =1 and p.idAlumno = ? order by p.id desc;");
	if($sql->execute([ $_POST['id'] ])){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}

}
function agregar($db){
	$conv = json_decode($_POST['cargoExtra'], true);
	
	$sql = $db->prepare('INSERT INTO `pagos`(
		`idMatricula`, `idCargos`, `fecha`, `idBanco`, `nOperacion`, 
		`monto`, `pagado`, `observaciones`,`idUsuario`, idAlumno
		) VALUES (
		?,?,?,?,cast(? as integer),
		?,?,?,?,?
		);
		UPDATE `matricula` SET 
		`precio` = `precio` + ?,
		`debe` = `debe` + ? - ?,
		`pago` = `pago` + ?
		where `id` = ?');
	if($sql->execute([
		$conv['idMatricula'],$conv['idCargos'],$conv['fecha'],$conv['idBanco'],$conv['nOperacion'],
		$conv['monto'],$conv['pagado'],$conv['observaciones'],$conv['idUsuario'],$conv['idAlumno'],
		$conv['monto'],$conv['monto'],$conv['pagado'],$conv['pagado'],$conv['idMatricula']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function verificar($db){
	$filas = [];
	$sql = $db->prepare("SELECT p.*, a.nombres, a.apellidos, c.nombre as nomCurso FROM `pagos` p inner join matricula m on m.id = p.idMatricula inner join alumnos a on a.id = m.idAlumno inner join cursos c on c.id = m.idCurso where p.activo = 1 and p.idBanco = ? and p.nOperacion=cast(? as integer) and nOperacion<>''; ");
	
	if($sql->execute([
		$_POST['idBanco'], $_POST['nOperacion']
	])
	){
		if($sql->rowCount()==0){
			echo "[]";
		}else{
			while($row = $sql->fetch(PDO::FETCH_ASSOC)){
				$filas[]= $row;
			}
			echo json_encode($filas);
		}
	}
}
function aprobar1($db){
	$sql = $db->prepare('UPDATE `pagos` SET 
		`vbColaborador` = 1
		where `id` = ?');
	if($sql->execute([
		$_POST['id']
	])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function aprobar2($db){
	$sql = $db->prepare('UPDATE `pagos` SET 
		`vbBanco` = 1
		where `id` = ?');
	if($sql->execute([
		$_POST['id']
	])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function anularPago($db){
	$sql = $db->prepare('UPDATE `pagos` SET 
		`vbColaborador` = 2,
		`vbBanco` = 2
		where `id` = ?;
		UPDATE `matricula` SET 
		`precio` = `precio` - cast(? as float),
		`pago` = `pago` - cast(? as float),
		`debe` = `debe` + cast(? as float) - cast(? as float)
		where `id` = ?;');
	if($sql->execute([
		$_POST['id'],
		$_POST['monto'],$_POST['pagado'],$_POST['pagado'],$_POST['monto'],$_POST['idMatricula']
	])){
		//echo $sql->debugDumpParams();
		echo 'ok';
	}else{
		echo -1;
	}
}
?>
