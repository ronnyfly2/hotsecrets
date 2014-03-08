<?php

/**
 * @author Ronnyfly2
 * @copyright 2007
 */

//si se pide el source
if(isset($_GET['source'])) {
    highlight_file(__FILE__);
    exit;
}

//ruta de la imagen
$imagen = $_GET['imagen'];

//se busca el tamaño de la imagen
$tama_imag = getimagesize($imagen);

$ancho_img = $tama_imag[0];
$alto_img = $tama_imag[1];

//incluimos la librería
include_once "funcionalidades/PHPImagen.lib.php"; 

//Instanciamos la clase
$imagen = new Imagen($imagen); 

//si el ancho es mayor a alcho real de la imagen el ancho sera el ancho real
$nuevo_ancho = ($_GET['ancho'] <= $ancho_img) ? $_GET['ancho'] : NULL; 
//si el alto es mayor a alto real de la imagen el alto sera el ancho real
$nuevo_alto = ($_GET['alto'] <= $alto_img) ? $_GET['alto'] : NULL;
//si se desea croppear la imagen se especifica el cut
$cut = (isset($_GET['cut'])) ? true : false; 

//Redimension de la imagen. Los parámetros
$imagen->resize($nuevo_ancho, $nuevo_alto, $cut);
// Aplicación de la marca de agua
if($_GET['mark'] !== "false") {
$imagen->watermark("imagenes/favicon2.png",-1,-1,false,0);
}

//Si se pide que se baje la imagen
if(isset($_GET['download'])) $imagen->doDownload(); 
//si no se pide que se baje se muestra la imagen
else $imagen->doPrint(); 


?>
