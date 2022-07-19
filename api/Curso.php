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
	if( isset($_POST['id']) ){ $filtro = ' and c.id = '.$_POST['id'];}
	if( isset($_POST['texto']) ){ $filtro .= ' and c.nombre like "%'.$_POST['texto'].'%" ';}
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
		`grupo`, `catalogoLink`, `videoLink`
		) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,? 
		);');
	if($sql->execute([
		$conv['anio'],$conv['idPrograma'],$conv['idEvento'],$conv['nombre'],$conv['codigo'],
		$conv['idModalidad'],$conv['inicio'],$conv['fechasLink'],$conv['idHora'],$conv['idConvenio'],
		$conv['pGeneral'],$conv['pExalumnos'],$conv['pCorporativo'],$conv['pPronto'],$conv['pRemate'],
		$conv['pMediaBeca'],$conv['pEspecial'],$conv['idDocente'],$conv['idDocenteReemplazo'],$conv['temarioLink'],
		$conv['temarioArchivo'],$conv['idTipoCertificado'],$conv['brochureLink'],$conv['idEtapa'],$conv['detalles'],
		$conv['dataLink'],$conv['vacantes'],$conv['autorizacion'],$conv['cambios'],$conv['checkAlumnos'], 
		$conv['checkAfianzamiento'],$conv['checkAprobados'],$conv['idResponsable1'],$conv['idResponsable2'],$conv['prospectoLink'], 
		$conv['grupo'],$conv['catalogoLink'],$conv['videoLink']
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
?>