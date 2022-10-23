<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'conteo': conteo($db); break;
}

function conteo($db){
	$filas = [];
	$sql = $db->query("SELECT count(id) as conteo from convenios where activo =1 
	and DATEDIFF( fechaFin, CURRENT_DATE() ) between 0 and 40;");
	if($sql->execute()){
		$rowConvenio = $sql->fetch(PDO::FETCH_ASSOC);
	}

	$sqlPresencial = $db->query("SELECT count(id) as conteo from cursos where activo =1 
	and idModalidad=5 and idModalidad<>0;");
	if($sqlPresencial->execute()){
		$rowPresencial = $sqlPresencial->fetch(PDO::FETCH_ASSOC);
	}
	$sqlVirtual = $db->query("SELECT count(id) as conteo from cursos where activo =1 
	and idModalidad not in (0, 5);");
	if($sqlVirtual->execute()){
		$rowVirtual = $sqlVirtual->fetch(PDO::FETCH_ASSOC);
	}	

	array_push($filas, array('convenios'=>$rowConvenio['conteo'], 'presencial'=>$rowPresencial['conteo'], 'virtual'=>$rowVirtual['conteo']) );
	echo json_encode($filas);
}
?>