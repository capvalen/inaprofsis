<?php 
$directorio = __DIR__.'./../images/subidas/';
 //$_POST['ruta'];

$tipoArchivo = strtolower(pathinfo( $directorio . basename($_FILES["archivo"]["name"]) ,PATHINFO_EXTENSION));
$queArchivo = uniqid() . "." . $tipoArchivo;
$archivoFinal = $directorio . $queArchivo; //basename($_FILES["archivo"]["name"]);

if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivoFinal)) {
	//echo "The file ". htmlspecialchars( basename( $_FILES["archivo"]["name"])). " has been uploaded.";
	echo $queArchivo;
} else {
	echo "Error subida".$_FILES["file"]["error"];
}