<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'deleteMatricula': borrarMatricula($db); break;
	case 'matriculas': matriculas($db); break;

}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = 'and a.id = '.$_POST['id'];}
	if( isset($_POST['idEspecialidad']) ){ $filtro .= ' and idEspecialidad = '.$_POST['idEspecialidad'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (nombres like "%'.$_POST['texto'].'%" or apellidos like "%'.$_POST['texto'].'%" or dni = "'.$_POST['texto'].'" )';}
	//echo $filtro;
	$sql = $db->query("SELECT a.*, e.descripcion as nomEspecialidad from alumnos a inner join especialidades e on e.id = a.idEspecialidad where a.activo =1 {$filtro} order by apellidos asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['alumno'], true);
	if($conv['fechaNacimiento']==''){ $conv['fechaNacimiento']=null;}
	
	$sql = $db->prepare('INSERT INTO `alumnos`(
		`nombres`, `apellidos`, `dni`, `conciliador`, `fechaNacimiento`, 
		`celular1`, `celular2`, `correo1`, `correo2`, `whatsapp`, 
		`direccion`, `lugarTrabajo`, `hijos`, `idEspecialidad`, `idMorosidad`, 
		`detalle`) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?);');
	if($sql->execute([
		$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['conciliador'],$conv['fechaNacimiento'],
		$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],$conv['whatsapp'],
		$conv['direccion'],$conv['lugarTrabajo'],$conv['hijos'],$conv['idEspecialidad'],$conv['idMorosidad'],
		$conv['detalle']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['alumno'], true);
	
	$sql = $db->prepare('UPDATE `alumnos` set 
		`nombres`=?, `apellidos`=?, `dni`=?, `conciliador`=?, `fechaNacimiento`=?, 
		`celular1`=?, `celular2`=?, `correo1`=?, `correo2`=?, `whatsapp`=?, 
		`direccion`=?, `lugarTrabajo`=?, `hijos`=?, `idEspecialidad`=?, `idMorosidad`=?, 
		`detalle`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['nombres'],$conv['apellidos'],$conv['dni'],$conv['conciliador'],$conv['fechaNacimiento'],
		$conv['celular1'],$conv['celular2'],$conv['correo1'],$conv['correo2'],$conv['whatsapp'],
		$conv['direccion'],$conv['lugarTrabajo'],$conv['hijos'],$conv['idEspecialidad'],$conv['idMorosidad'],
		$conv['detalle'], $conv['id']
	])){
		//echo $sql->debugDumpParams();
		echo 1;
	}else{
		echo -1;
	}
}
function borrar($db){
	
	$sql = $db->prepare('UPDATE `alumnos` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function borrarMatricula($db){
	
	$sql = $db->prepare('UPDATE `matricula` set `activo` =0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function matriculas($db){
	$filas = []; $matriculas=[];
	
	//echo $filtro;
	$sql = $db->query("SELECT a.*, e.descripcion as nomEspecialidad
	from alumnos a inner join especialidades e on e.id = a.idEspecialidad where a.activo =1 and a.id = {$_POST['id']} order by apellidos asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		$sqlMatriculados = $db->query("SELECT m.*, c.nombre, ce.estado
		FROM `matricula` m
		inner join cursos c on m.idCurso = c.id
		inner join certificado_estado ce on ce.id = m.idEstadoCertificado
		where idAlumno = {$_POST['id']} and m.activo = 1 order by m.fecha desc;");
		if($sqlMatriculados->execute()){
			while($cursosA = $sqlMatriculados -> fetch(PDO::FETCH_ASSOC)){
				$filasCertificados=[]; $filasPagos=[]; $filasDeliverys=[];
				
				$sqlCertificados = $db->prepare("SELECT ce.codigo as codigoCertificado, ce.idCertificadoEstado as estadoIdCertificado FROM `certificados` ce
				inner join matricula m on m.idCertificado = ce.id
				where m.id=? ;");
				if($sqlCertificados -> execute([
					$cursosA['id'] //contiene idMatricula
				])){
					if($sqlCertificados->rowCount()==1){
						$rowCertificados = $sqlCertificados->fetch(PDO::FETCH_ASSOC);
						$filasCertificados=$rowCertificados;
					}
				}

				$sqlPagos = $db->prepare("SELECT nOperacion, b.entidad, vbColaborador, vbBanco, 'Carlos' as nomUsuario FROM `pagos` p
				inner join bancos b on b.id = p.idBanco
				where idMatricula = ? and p.activo = 1 order by p.id desc limit 1;");
				if($sqlPagos -> execute([
					$cursosA['id'] //contiene idMatricula
				])){
					if($sqlPagos->rowCount()==1){
						$rowPagos = $sqlPagos->fetch(PDO::FETCH_ASSOC);
						$filasPagos=$rowPagos;
					}
				}

				$sqlDeliverys = $db->prepare("SELECT d.*, c.nombre as courier, de.departamento, pro.provincia, di.distrito, ce.estado
				FROM `deliverys` d
				inner join courier c on c.id = d.idCourier
				inner join ubdepartamento de on de.idDepa = d.idDepartamento
				inner join ubprovincia pro on pro.idProv = d.idProvincia
				inner join certificado_estado ce on ce.id = d.idCertificadoEstado
				inner join ubdistrito di on di.idDist = d.idDistrito
				where d.activo = 1 and d.idMatricula = ? order by d.id desc limit 1;");
				if($sqlDeliverys -> execute([
					$cursosA['id'] //contiene idMatricula
				])){
					if($sqlDeliverys->rowCount()==1){
						$rowDeliverys = $sqlDeliverys->fetch(PDO::FETCH_ASSOC);
						$filasDeliverys=$rowDeliverys;
					}
				}

				$matriculas[] = array_merge($cursosA,$filasPagos,$filasDeliverys,$filasCertificados);
			}
		}

		echo json_encode(array_merge($filas, array(1=>$matriculas)));
	}
}

?>