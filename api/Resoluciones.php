<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
}

function listar($db){
	$filas = [];
	$sql = $db->query("SELECT r.*, c.nombre as nomCurso from resoluciones r
	inner join cursos c on c.id = r.idCurso where r.activo =1 order by r.id desc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}

}
?>