<?php
$hostname_conexion = "localhost";
$database_conexion = "hotsecrets";
$username_conexion = "root";
$password_conexion = "eresmias";

// Attempt to establish a connection
$con = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);

// Check connection
if ($con->connect_error) {
    trigger_error("Connection failed: " . $con->connect_error, E_USER_ERROR);
}

// Set character set to UTF-8
if (!$con->set_charset("utf8mb4")) {
    trigger_error("Error loading character set utf8mb4: " . $con->error, E_USER_ERROR);
}

//*************************************************************

//Convierto los acentos a HTML

function chao_tilde($entra)

{

$traduce=array( 'á' => '&aacute;' , 'é' => '&eacute;' , 'í' => '&iacute;' , 'ó' => '&oacute;' , 'ú' => '&uacute;' , 'ñ' => '&ntilde;' , 'Ñ' => '&Ntilde;' , 'ä' => '&auml;' , 'ë' => '&euml;' , 'ï' => '&iuml;' , 'ö' => '&ouml;' , 'ü' => '&uuml;');

$sale=strtr( $entra , $traduce );

return $sale;

}
?>