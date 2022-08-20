<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
	case 'add': agregar($db); break;
	case 'update': actualizar($db); break;
	case 'delete': borrar($db); break;
	case 'correlativo': correlativo($db); break;
	case 'verificar': verificar($db); break;
	case 'matriculados': matriculados($db); break;
	case 'matricular': matricular($db); break;
}

function listar($db){
	$filas = [];
	$filtro = '';
	if( isset($_POST['id']) ){ $filtro = ' and c.id = '.$_POST['id'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and (c.nombre like "%'.$_POST['texto'].'%" OR c.codigo like "%'.$_POST['texto'].'%") ';}
	if( isset($_POST['idPrograma']) ){ $filtro .= ' and c.idPrograma = '.$_POST['idPrograma'];}
	if( isset($_POST['idEvento']) ){ $filtro .= ' and c.idEvento = '.$_POST['idEvento'];}
	if( isset($_POST['anio']) ){ $filtro .= ' and anio = '.$_POST['anio'];}

	$sql = $db->query("SELECT c.*, p.descripcion as desPrograma, e.descripcion as desEvento, m.descripcion as desModalidad, h.descripcion as desHoras, co.entidad as desConvenio, concat( d.apellidos, ' ', d.nombres) as nomDocente, concat( d1.apellidos, ' ', d1.nombres) as nomDocenteReemplazo, tc.descripcion as nomCertificado, et.descripcion as etapaNombre, resp1.nombres as nomResponsable1, resp2.nombres as nomResponsable2

	from cursos c inner join programas p on p.id = c.idPrograma
	inner join eventos e on e.id = c.idEvento
	inner join modalidades m on m.id = c.idModalidad
	inner join horas h on h.id = c.idHora
	inner join convenios co on co.id = c.idConvenio
	inner join docentes d on d.id = c.idDocente
	inner join docentes d1 on d1.id = c.idDocenteReemplazo
	inner join tipo_certificados tc on tc.id = c.idTipoCertificado
	inner join etapas et on et.id = c.idEtapa
	inner join colaboradores resp1 on resp1.id = c.idResponsable1
	inner join colaboradores resp2 on resp2.id = c.idResponsable2
	where c.activo =1 {$filtro} order by c.nombre asc;");
	
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}
function agregar($db){
	$conv = json_decode($_POST['curso'], true);
	if($conv['inicio']==''){ $conv['inicio']=null;}
	
	$sql = $db->prepare('INSERT INTO `cursos`(
		`anio`, `idPrograma`, `idEvento`, `nombre`, `codigo`, 
		`idModalidad`, `inicio`, `fechasLink`, `idHora`, `idConvenio`, 
		`pGeneral`, `pExalumnos`, `pCorporativo`, `pPronto`, `pRemate`, 
		`pMediaBeca`, `pEspecial`, `idDocente`, `idDocenteReemplazo`, `temarioLink`, 
		`temarioArchivo`, `idTipoCertificado`, `brochureLink`, `idEtapa`, `detalles`, 
		`dataLink`, `vacantes`, `autorizacion`, `cambios`, `checkAlumnos`,
		`checkAfianzamiento`, `checkAprobados`, `idResponsable1`, `idResponsable2`, `prospectoLink`,
		`grupo`, `catalogoLink`, `videoLink`, `idEspecialidad`
		) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?
		);');
	if($sql->execute([
		$conv['anio'],$conv['idPrograma'],$conv['idEvento'],$conv['nombre'],$conv['codigo'],
		$conv['idModalidad'],$conv['inicio'],$conv['fechasLink'],$conv['idHora'],$conv['idConvenio'],
		$conv['pGeneral'],$conv['pExalumnos'],$conv['pCorporativo'],$conv['pPronto'],$conv['pRemate'],
		$conv['pMediaBeca'],$conv['pEspecial'],$conv['idDocente'],$conv['idDocenteReemplazo'],$conv['temarioLink'],
		$conv['temarioArchivo'],$conv['idTipoCertificado'],$conv['brochureLink'],$conv['idEtapa'],$conv['detalles'],
		$conv['dataLink'],$conv['vacantes'],$conv['autorizacion'],$conv['cambios'],$conv['checkAlumnos'], 
		$conv['checkAfianzamiento'],$conv['checkAprobados'],$conv['idResponsable1'],$conv['idResponsable2'],$conv['prospectoLink'], 
		$conv['grupo'],$conv['catalogoLink'],$conv['videoLink'],$conv['idEspecialidad']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}
function actualizar($db){
	$conv = json_decode($_POST['curso'], true);
	
	$sql = $db->prepare('UPDATE `cursos` set 
		`anio`=?, `idPrograma`=?, `idEvento`=?, `nombre`=?, `codigo`=?, 
		`idModalidad`=?, `inicio`=?, `fechasLink`=?, `idHora`=?, `idConvenio`=?, 
		`pGeneral`=?, `pExalumnos`=?, `pCorporativo`=?, `pPronto`=?, `pRemate`=?, 
		`pMediaBeca`=?, `pEspecial`=?, `idDocente`=?, `idDocenteReemplazo`=?, `temarioLink`=?, 
		`temarioArchivo`=?, `idTipoCertificado`=?, `brochureLink`=?, `idEtapa`=?, `detalles`=?, 
		`dataLink`=?, `vacantes`=?, `autorizacion`=?, `cambios`=?, `checkAlumnos`=?,
		`checkAfianzamiento`=?, `checkAprobados`=?, `idResponsable1`=?, `idResponsable2`=?, `prospectoLink`=?,
		`grupo`=?, `catalogoLink`=?, `videoLink`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['anio'],$conv['idPrograma'],$conv['idEvento'],$conv['nombre'],$conv['codigo'],
		$conv['idModalidad'],$conv['inicio'],$conv['fechasLink'],$conv['idHora'],$conv['idConvenio'],
		$conv['pGeneral'],$conv['pExalumnos'],$conv['pCorporativo'],$conv['pPronto'],$conv['pRemate'],
		$conv['pMediaBeca'],$conv['pEspecial'],$conv['idDocente'],$conv['idDocenteReemplazo'],$conv['temarioLink'],
		$conv['temarioArchivo'],$conv['idTipoCertificado'],$conv['brochureLink'],$conv['idEtapa'],$conv['detalles'],
		$conv['dataLink'],$conv['vacantes'],$conv['autorizacion'],$conv['cambios'],$conv['checkAlumnos'], 
		$conv['checkAfianzamiento'],$conv['checkAprobados'],$conv['idResponsable1'],$conv['idResponsable2'],$conv['prospectoLink'], 
		$conv['grupo'],$conv['catalogoLink'],$conv['videoLink'], $conv['id']
	])){
		echo 1;
	}else{
		echo -1;
	}
	echo $sql->debugDumpParams();
}
function borrar($db){
	
	$sql = $db->prepare('UPDATE `cursos` set `activo` = 0 WHERE `id`= ? ;');
	if($sql->execute([ $_POST['id'] ])){
		echo 'ok';
	}else{
		echo -1;
	}
}
function correlativo($db){
	$sql = $db->prepare('SELECT id from cursos order by id desc limit 1;');
	if($sql->execute()){
		$registro = $sql->fetch(PDO::FETCH_ASSOC);
		echo $registro['id'];
	}else{
		echo -1;
	}
}
function verificar($db){
	$sql = $db->prepare("SELECT id from cursos where codigo = '{$_POST['correlativo']}';");
	if($sql->execute()){
		echo $sql->rowCount();
	}else{
		echo -1;
	}
}

function matriculados($db){
	$filas = []; $matriculados=[];
	
	$sql = $db->query("SELECT c.*, p.descripcion as desPrograma, e.descripcion as desEvento, m.descripcion as desModalidad, h.descripcion as desHoras, co.entidad as desConvenio, concat( d.apellidos, ' ', d.nombres) as nomDocente, concat( d1.apellidos, ' ', d1.nombres) as nomDocenteReemplazo, tc.descripcion as nomCertificado, et.descripcion as etapaNombre, resp1.nombres as nomResponsable1, resp2.nombres as nomResponsable2

	from cursos c inner join programas p on p.id = c.idPrograma
	inner join eventos e on e.id = c.idEvento
	inner join modalidades m on m.id = c.idModalidad
	inner join horas h on h.id = c.idHora
	inner join convenios co on co.id = c.idConvenio
	inner join docentes d on d.id = c.idDocente
	inner join docentes d1 on d1.id = c.idDocenteReemplazo
	inner join tipo_certificados tc on tc.id = c.idTipoCertificado
	inner join etapas et on et.id = c.idEtapa
	inner join colaboradores resp1 on resp1.id = c.idResponsable1
	inner join colaboradores resp2 on resp2.id = c.idResponsable2
	where c.activo =1 and c.id = {$_POST['id']};");
	
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}

		$sqlMatriculados = $db->query("SELECT m.*, a.nombres, a.apellidos, a.dni, a.celular1, a.correo1, ce.estado FROM `matricula` m
		inner join alumnos a on a.id = m.idAlumno
		inner join certificado_estado ce on ce.id = m.idEstadoCertificado
		where idCurso = {$_POST['id']} and m.activo = 1;");
		if($sqlMatriculados->execute()){
			while($cursosA = $sqlMatriculados -> fetch(PDO::FETCH_ASSOC)){
				$matriculados[] = $cursosA;
			}
		}

		echo json_encode(array_merge($filas, array(1=>$matriculados)));
	}
}

function matricular($db){
	
	$sql = $db->prepare('INSERT INTO `matricula`(
		`idCurso`, `idAlumno`, `idTipoMatricula`, `precio`, `debe`, 
		`comoPago`, `cuotas`, `tipoCertificado`
		) VALUES (
		?,?,?,?,?,
		?,?,?
		);');
	if($sql->execute([
		$_POST['idCurso'],$_POST['idAlumno'],$_POST['idTipoMatricula'],$_POST['precio'],$_POST['precio'],
		$_POST['comoPago'],$_POST['cuotas'],$_POST['tipoCertificado']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
	
}
?>