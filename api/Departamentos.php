<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
}

function listar($db){
	$departamentos = []; $provincias=[]; $distritos=[];
	$sql = $db->query("SELECT * from ubdepartamento order by departamento asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$departamentos[]= $row;
		}
	}
	$sqlPro = $db->query("SELECT * from ubprovincia order by provincia asc;");
	if($sqlPro->execute()){
		while($rowPro = $sqlPro->fetch(PDO::FETCH_ASSOC)){
			$provincias[]= $rowPro;
		}
	}
	$sqlDist = $db->query("SELECT * from ubdistrito order by distrito asc;");
	if($sqlPro->execute()){
		while($rowDist = $sqlDist->fetch(PDO::FETCH_ASSOC)){
			$distritos[]= $rowDist;
		}
	}

	echo json_encode(array_merge( array( 0=>$departamentos,1=>$provincias, 2=>$distritos)));

}
?>