<?php

require_once 'connection.php';

$response = [];
$content = "";
const TABLA = 'confirmaciones';


try {

    $conexion = new Conexion();
    $action = $_POST['action'];

    switch ($action) {
        case 'listado':

            $cont = 1;
            foreach($conexion->query('SELECT nombre FROM marioswe_baby_shower.confirmaciones ORDER BY id') as $fila) {
                // print_r($fila['nombre']);
                $content .= '<p class="upper-case my-2 elemento_lista"><b><small>'.$cont++.'</small>| '.htmlentitiestoacentos($fila['nombre']).'</b></p>';
            }

            $conexion = null;

            $response['status'] = 'ok';
            $response['content'] = $content;

            break;

        case 'conteo':

            $query = $conexion->query('SELECT SUM(numero_asistentes) as suma FROM marioswe_baby_shower.confirmaciones');
            $fila = $query->fetch(PDO::FETCH_ASSOC);
            $suma = $fila['suma'];
            $content = '<p class="upper-case my-2 h6">Asistentes confirmados '.$suma.'</p>';

            $conexion = null;

            $response['status'] = 'ok';
            $response['content'] = $content;

            break;
    }


} catch (Exception $e) {
    $response['status'] = 'error';
    $response['msj_error'] = $e->getMessage();
} catch (PDOException $e) {
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