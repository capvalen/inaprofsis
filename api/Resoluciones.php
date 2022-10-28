<?php
include 'conectkarl.php';

switch( $_POST['pedir']){
	case 'listar': listar($db); break;
}

function listar($db){
	$filas = [];
	$sql = $db->query("SELECT r.*, c.nombre as nomCurso, e.descripcion as nomEvento, es.descripcion as nomEspecialidad, c.inicio, concat(d.nombres, ' ', d.apellidos) as nomDocente1, concat(d2.nombres, ' ', d2.apellidos) as nomDocente2, c.idDocente, c.idDocenteReemplazo, h.descripcion as horas,
	co.entidad, dataLink
	from resoluciones r
	inner join cursos c on c.id = r.idCurso 
	inner join eventos e on e.id = c.idEvento
	inner join docentes d on d.id = c.idDocente
	inner join docentes d2 on d2.id = c.idDocenteReemplazo
	inner join especialidades es on es.id = c.idEspecialidad
	inner join horas h on h.id  = c.idHora
	inner join convenios co on co.id  = c.idConvenio
	where r.activo =1 order by r.id desc;");
	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[]= $row;
		}
		echo json_encode($filas);
	}

}
?>