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
	case 'finalizar': finalizar($db); break;
	case 'updateSoloFoto': updateSoloFoto($db); break;
	case 'addTareas': addTareas($db); break;
	case 'getTareas': getTareas($db); break;
	case 'updateTareas': updateTareas($db); break;
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
	where c.activo =1 {$filtro} order by c.id desc;");
	
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
		`pGeneral`, `pExalumnos`, `pCorporativo`, `pPronto`, `pRemate`,pCertificado 
		`pMediaBeca`, `pEspecial`, `idDocente`, `idDocenteReemplazo`, `temarioLink`, 
		`temarioArchivo`, `idTipoCertificado`, `brochureLink`, `idEtapa`, `detalles`, 
		`dataLink`, `vacantes`, `autorizacion`, `cambios`, `checkAlumnos`,
		`checkAfianzamiento`, `checkAprobados`, `idResponsable1`, `idResponsable2`, `prospectoLink`,
		`grupo`, `catalogoLink`, `videoLink`, `idEspecialidad`, `cupos`,
		`foto`,`meta`
		) VALUES (
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?,?,
		?,?
		);');
	if($sql->execute([
		$conv['anio'],$conv['idPrograma'],$conv['idEvento'],$conv['nombre'],$conv['codigo'],
		$conv['idModalidad'],$conv['inicio'],$conv['fechasLink'],$conv['idHora'],$conv['idConvenio'],
		$conv['pGeneral'],$conv['pExalumnos'],$conv['pCorporativo'],$conv['pPronto'],$conv['pRemate'],$conv['pCertificado'],
		$conv['pMediaBeca'],$conv['pEspecial'],$conv['idDocente'],$conv['idDocenteReemplazo'],$conv['temarioLink'],
		$conv['temarioArchivo'],$conv['idTipoCertificado'],$conv['brochureLink'],$conv['idEtapa'],$conv['detalles'],
		$conv['dataLink'],$conv['vacantes'],$conv['autorizacion'],$conv['cambios'],$conv['checkAlumnos'], 
		$conv['checkAfianzamiento'],$conv['checkAprobados'],$conv['idResponsable1'],$conv['idResponsable2'],$conv['prospectoLink'], 
		$conv['grupo'],$conv['catalogoLink'],$conv['videoLink'],$conv['idEspecialidad'],$conv['vacantes'],
		$conv['foto'],$conv['meta']
	])){
		$idCurso = $db->lastInsertId();

		$sqlTareas = $db->query("INSERT INTO `actividades_tareas`(
			`idCurso`, `idTarea` ) VALUES
			({$idCurso}, 1 ),
			({$idCurso}, 2 ),
			({$idCurso}, 3 ),
			({$idCurso}, 4 ),
			({$idCurso}, 5 ),
			({$idCurso}, 6 ),
			({$idCurso}, 7 ),
			({$idCurso}, 8 ),
			({$idCurso}, 9 ),
			({$idCurso}, 10 ),
			({$idCurso}, 11 ),
			({$idCurso}, 12 ),
			({$idCurso}, 13 ),
			({$idCurso}, 14 ),
			({$idCurso}, 15 ),
			({$idCurso}, 16 ),
			({$idCurso}, 17 ),
			({$idCurso}, 18 )
			");
			$sqlTareas->execute();
		echo $idCurso;
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
		`pMediaBeca`=?, `pEspecial`=?, pCertificado=?, `idDocente`=?, `idDocenteReemplazo`=?, `temarioLink`=?, 
		`temarioArchivo`=?, `idTipoCertificado`=?, `brochureLink`=?, `idEtapa`=?, `detalles`=?, 
		`dataLink`=?, `vacantes`=?, `autorizacion`=?, `cambios`=?, `checkAlumnos`=?,
		`checkAfianzamiento`=?, `checkAprobados`=?, `idResponsable1`=?, `idResponsable2`=?, `prospectoLink`=?,
		`grupo`=?, `catalogoLink`=?, `videoLink`=?,`foto`=?,`meta`=?,
		idAutorizacion=?, oficioAlumnos=? WHERE `id`= ?
		;');
	if($sql->execute([
		$conv['anio'],$conv['idPrograma'],$conv['idEvento'],$conv['nombre'],$conv['codigo'],
		$conv['idModalidad'],$conv['inicio'],$conv['fechasLink'],$conv['idHora'],$conv['idConvenio'],
		$conv['pGeneral'],$conv['pExalumnos'],$conv['pCorporativo'],$conv['pPronto'],$conv['pRemate'],
		$conv['pMediaBeca'],$conv['pEspecial'],$conv['pCertificado'],$conv['idDocente'],$conv['idDocenteReemplazo'],$conv['temarioLink'],
		$conv['temarioArchivo'],$conv['idTipoCertificado'],$conv['brochureLink'],$conv['idEtapa'],$conv['detalles'],
		$conv['dataLink'],$conv['vacantes'],$conv['autorizacion'],$conv['cambios'],$conv['checkAlumnos'], 
		$conv['checkAfianzamiento'],$conv['checkAprobados'],$conv['idResponsable1'],$conv['idResponsable2'],$conv['prospectoLink'], 
		$conv['grupo'],$conv['catalogoLink'],$conv['videoLink'],$conv['foto'],$conv['meta'],
		$conv['idAutorizacion'],$conv['oficioAlumnos'],$conv['id']
	])){
		echo 1;
	}else{
		echo -1;
	}
	//echo $sql->debugDumpParams();
}
function updateSoloFoto($db){
	$conv = $_POST;
	
	$sql = $db->prepare('UPDATE `cursos` set 
		`foto`=? WHERE `id`= ? ;');
	if($sql->execute([
		$conv['foto'], $conv['id']
	])){
		echo 1;
	}else{
		echo -1;
	}
	//echo $sql->debugDumpParams();
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

		$sqlMatriculados = $db->query("SELECT m.*, a.nombres, a.apellidos, a.dni, a.celular1, a.correo1, ce.estado, '' as entidad, '' as nOperacion, '0' as vbColaborador, 2 as vbBanco,  '' as courier, '' as distrito, '' as referencia, 'Carlos' as nomUsuario
		FROM `matricula` m
		inner join alumnos a on a.id = m.idAlumno
		inner join certificado_estado ce on ce.id = m.idEstadoCertificado
		where idCurso = {$_POST['id']} and m.activo = 1
		order by a.apellidos, a.nombres asc;");
		if($sqlMatriculados->execute()){
			while($cursosA = $sqlMatriculados -> fetch(PDO::FETCH_ASSOC)){

				$filasCertificados=[]; $filasPagos=[]; $filasDeliverys=[];
				
				$sqlCertificados = $db->prepare("SELECT ce.codigo as codigoCertificado, ce.idCertificadoEstado as estadoIdCertificado, correlativo FROM `certificados` ce
				inner join matricula m on m.idCertificado = ce.id
				inner join alumnos a on a.id = m.idAlumno
				where m.id=? 
				order by a.apellidos, a.nombres asc;");
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

				$matriculados[] = array_merge($cursosA,$filasPagos,$filasDeliverys,$filasCertificados);
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
		);
		UPDATE `cursos` SET 
		`vacantes`=`vacantes`-1
		where `id` = ?;');
	if($sql->execute([
		$_POST['idCurso'],$_POST['idAlumno'],$_POST['idTipoMatricula'],$_POST['precio'],$_POST['precio'],
		$_POST['comoPago'],$_POST['cuotas'],$_POST['tipoCertificado'],$_POST['idCurso']
	])){
		echo $db->lastInsertId();
	}else{
		echo -1;
	}
}

function finalizar($db){
	
	$sql = $db->prepare('INSERT INTO `resoluciones`(
		`fecha`, `idCurso`, `codigo`, `tomo`
		) VALUES (
		?,?,?,?
		);
		UPDATE `cursos` SET `finalizado` = 1 WHERE `cursos`.`id` = ?;
		');
	if($sql->execute([
		$_POST['fecha'],$_POST['idCurso'],$_POST['codigo'],$_POST['tomo'],
		$_POST['idCurso']
	])){
		$idResolucion = $db->lastInsertId();
		$sql->closeCursor();

		$indice =1;
		$sqlMatriculados = $db->prepare("SELECT * FROM `matricula` where idCurso = ?;");
		if($sqlMatriculados->execute([ $_POST['idCurso'] ])){
			while($matriculados = $sqlMatriculados->fetch(PDO::FETCH_ASSOC)){
				$sqlCertificado = $db->prepare("INSERT INTO `certificados`(
					`idMatricula`, `idCurso`, `idAlumno`, `codigo`, `correlativo`, 
					`impreso`, `idCertificadoEstado`)
				VALUES(
					?,?,?,?,?,
					?,?
				);");
				$sqlCertificado->execute([
					$matriculados['id'],$_POST['idCurso'], $matriculados['idAlumno'],$_POST['claveCurso'],$indice,
					$matriculados['tipoCertificado'],2
				]);
				$indice++;
			}
			$sqlMatriculados->closeCursor();

			$sobran = $_POST['vacantes']; //- ($indice-1)
			for ($i=1; $i <= $sobran ; $i++) { //$i=$indice

				$sqlMatricularCero = $db->prepare("INSERT INTO `matricula`(
					`idCurso`, `idAlumno`, `fecha`, `idTipoMatricula`,`precio`,
					`pago`,`debe`,`idEstadoCertificado`,`idCertificado`,`comoPago`,`cuotas`)
				VALUES(
					?, 1, now(), 7,0,
					0,0,1,1,1,1);");
					$sqlMatricularCero->execute([$_POST['idCurso']]);
					$idMatriculaCero = $db->lastInsertId();
					$sqlMatricularCero->closeCursor();


					$sqlSobrantes = $db->prepare("INSERT INTO `certificados`(
						`idMatricula`, `idCurso`, `idAlumno`, `codigo`, `correlativo`, 
						`impreso`, `idCertificadoEstado`)
					VALUES(
						?,?,1,?,?,
						1,1
					);
					");
					$sqlSobrantes->execute([
						$idMatriculaCero,$_POST['idCurso'],$_POST['claveCurso'],$indice
					]);
					$indice++;
					
					$sqlSobrantes->closeCursor();
			}
		}

		echo $idResolucion;
	}else{
		echo -1;
	}
}

function getTareas($db){
	$filas = [];
	
	$sql = $db->prepare("SELECT act.*, t.tarea, a.actividad, act.tarea as tarea2 FROM `actividades_tareas` act
	inner join tareas t on t.id = act.idTarea
	inner join actividades a on a.id = t.idActividad
	where idCurso = ?;");
	if($sql->execute([ $_POST['id'] ])){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}
}

function updateTareas($db){
	$conv = json_decode($_POST['tarea'], true);
	
	$sql = $db->prepare("UPDATE `actividades_tareas` SET
	`tiempo`= ?, `idResponsable`=?,`cumplido`=?,`observacion`=?,
	`fecha` = STR_TO_DATE(?, '%Y-%m-%d')
	WHERE `id`=?;");
	if($sql->execute([ 
		$conv['tiempo'], $conv['idResponsable'], $conv['cumplido'], $conv['observacion'],
		$conv['fecha'], $conv['id']
	])){
		echo 1;
	}else{
		echo 0;
	}
}
function addTareas($db){
	$sql = $db->prepare("INSERT INTO `actividades_tareas`(
		`idCurso`, `idTarea`, `tarea` ) VALUES (
		?, 19, ?
		);");
	if($sql->execute([ 
		$_POST['idCurso'],$_POST['tarea']
	])){
		echo 1;
	}else{
		echo 0;
	}
	//echo $sql->debugDumpParams();
}

?>