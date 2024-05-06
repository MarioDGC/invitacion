<?php

require_once 'confirmation.php';

$response = [];
$asistente_confirmado = htmlentitiestoacentos($_POST['Nombre']);
$num_asistentes = $_POST['Num_asistentes'];

try {
    $confirmacion = new Confirmation($asistente_confirmado, $num_asistentes);
    $confirmacion->guardar();
    $response['status'] = 'ok';
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['msj_error'] = $e->getMessage();
}

echo json_encode($response);

function acentostohtmlentities($cadena) {
	$search = array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
	$replace = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&ntilde;','&AACUTE;','&EACUTE;','&IACUTE;','&OACUTE;','&UACUTE;','&NTILDE;');
	$cadena = str_replace($search,$replace,$cadena);
	return $cadena;
}

function htmlentitiestoacentos($cadena) {
	$search=array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&ntilde;','&AACUTE;','&EACUTE;','&IACUTE;','&OACUTE;','&UACUTE;','&NTILDE;');
	$replace=array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
	$cadena=str_replace($search,$replace,$cadena);
	return $cadena;
}

?>