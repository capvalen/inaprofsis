<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'departamento': departamento($db); break;
	case 'provincia': provincia($db); break;
	case 'distrito': distrito($db); break;
}

function departamento($db){
	$filas = [];
	$sql = $db->query("SELECT * FROM `ubdepartamento`;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
	}
	echo json_encode($filas);
}
function provincia($db){
	$filas = [];
	$sql = $db->query("SELECT * FROM `ubprovincia` where idDepa = {$_POST['idDepartamento']};");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
	}
	echo json_encode($filas);
}
function distrito($db){
	$filas = [];
	$sql = $db->query("SELECT * FROM `ubdistrito` where idProv = {$_POST['idProvincia']};");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
	}
	echo json_encode($filas);
}
?>