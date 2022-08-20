<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
}

function listar($db){
	$filas = [];
	$sql = $db->query("SELECT * from bancos where activo =1 order by entidad asc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}

}
?>