<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'departamento': departamento($db); break;
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
?>