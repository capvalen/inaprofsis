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
	if( isset($_POST['id']) ){ $filtro = 'and id = '.$_POST['id'];}
	$sql = $db->query("SELECT c.* from cursos c where c.activo =1 {$filtro} order by nombre asc;");
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