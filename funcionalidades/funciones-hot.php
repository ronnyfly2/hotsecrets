<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
//**********Obtener ip de usuario********************
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
//**********Obtener Url del Dominio********************
function dameURL()
{$url="http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
return $url;}
//**************Mostrar Nombre del Usuario************************
function MostrarNombreUsuario($UsuarioNom)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_nomb = sprintf("SELECT nombre FROM usuarios WHERE id_usuario = %s", $UsuarioNom);
$nomb = mysql_query($query_nomb, $HotSecrets) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nomb);
$totalRows_nomb = mysql_num_rows($nomb);
return $row_nomb['nombre'];
mysql_free_result($nomb);}
//**************Mostrar Nombre del Admin************************
function MostrarNombreAdmin($Administrador)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_nomb = sprintf("SELECT nombre_ordenador FROM ordenador WHERE id_ordenador = %s", $Administrador);
$nomb = mysql_query($query_nomb, $HotSecrets) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nomb);
$totalRows_nomb = mysql_num_rows($nomb);
return $row_nomb['nombre_ordenador'];
mysql_free_result($nomb);}
//**************Mostrar Apellido del Admin************************
function MostrarApellidoAdmin($Administrador)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_nomb = sprintf("SELECT apellido_ordenador FROM ordenador WHERE id_ordenador = %s", $Administrador);
$nomb = mysql_query($query_nomb, $HotSecrets) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nomb);
$totalRows_nomb = mysql_num_rows($nomb);
return $row_nomb['apellido_ordenador'];
mysql_free_result($nomb);}
//**************Mostrar Imagen del Admin************************
function MostrarImagenAdmin($Administrador)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_nomb = sprintf("SELECT img_ordenador FROM ordenador WHERE id_ordenador = %s", $Administrador);
$nomb = mysql_query($query_nomb, $HotSecrets) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nomb);
$totalRows_nomb = mysql_num_rows($nomb);
return $row_nomb['img_ordenador'];
mysql_free_result($nomb);}
//*********Obtener la URL del SEO-PRODUCTO*****************
function ObtenerUrlSEOProducto($identificador12)
{global $database_HotSecrets, $HotSecrets;
	mysql_select_db($database_HotSecrets, $HotSecrets);
	$query_ConsultaFuncion = sprintf("SELECT id_producto FROM productos WHERE url_seo_producto = '%s'", $identificador12);
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);	
	return $row_ConsultaFuncion['id_producto']; 
	mysql_free_result($ConsultaFuncion);}
//*********Obtener la URL del SEO-Categoria*****************
function ObtenerUrlSEOCategoria($identificador25)
{global $database_HotSecrets, $HotSecrets;
	mysql_select_db($database_HotSecrets, $HotSecrets);
	$query_ConsultaFuncion = sprintf("SELECT id_categoria FROM categorias WHERE urlseo = '%s'", $identificador25);
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);	
	return $row_ConsultaFuncion['id_categoria']; 
	mysql_free_result($ConsultaFuncion);}
//*********Obtener la URL del SEO-Sub-Categoria*****************
function ObtenerUrlSEOSub($identificador26)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ConsultaFuncion = sprintf("SELECT id_subcategoria FROM subcategorias WHERE url_seo_subcat = '%s'", $identificador26);
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);	
	return $row_ConsultaFuncion['id_subcategoria']; 
	mysql_free_result($ConsultaFuncion);}
//****************Comprobar correo unico***********************	
function ComprobarCorreoUnico($correounic)
{global $database_HotSecrets, $HotSecrets;
	mysql_select_db($database_HotSecrets, $HotSecrets);
	$query_DatosFuncion = "SELECT usuarios.correo FROM usuarios WHERE correo='".$correounic."'";
	$DatosFuncion = mysql_query($query_DatosFuncion, $HotSecrets) or die(mysql_error());
	$row_DatosFuncion = mysql_fetch_assoc($DatosFuncion);
	$totalRows_DatosFuncion = mysql_num_rows($DatosFuncion);	
	if  ($totalRows_DatosFuncion==0) return true;
		else return false;
	mysql_free_result($DatosFuncion);}
//*****Envio de correo al usuario cuando se registra***********
function Darse_Alta_usuario($correoalta, $nomregusuario)
{$altausuario = substr(md5(rand()*time()),0,30);
global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
	$updateSQL = sprintf("UPDATE usuarios SET altaok=%s WHERE correo = %s AND nombre = %s",
					   GetSQLValueString($altausuario, "text"),
                       GetSQLValueString($correoalta, "text"),
					   GetSQLValueString($nomregusuario, "text"));
	mysql_select_db($database_HotSecrets, $HotSecrets);
    $Result1 = mysql_query($updateSQL, $HotSecrets) or die(mysql_error());	
	$asunto="Confirma tu correo";
	$headers="Mime-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=utf-8\r\n";
	$headers .= 'From: Registro HotSecrets<ventas@hotsecretsperu.com>' . "\r\n";
	$destinatario= $correoalta;
	$contenido='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<head style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<meta name="viewport" content="width=device-width" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<title style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">Confirmacion de Correo HotSecrets</title></head>
<body bgcolor="#FFFFFF" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%;"><table class="head-wrap" bgcolor="#fcecec" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;"><tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td><td class="header container" style="margin: 0 auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;max-width: 600px;clear: both;"><div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;"><table bgcolor="#fcecec" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;"><tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><img src="http://www.hotsecretsperu.com/prueba/imagenes/logo.png" width="200" height="127" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;"></td><td align="right" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><h6 class="collapse" style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #444;font-weight: 900;font-size: 14px;text-transform: uppercase;">Confirma tu correo</h6></td></tr></table></div></td><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td></tr></table>
<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;"><tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td><td class="container" bgcolor="#FFFFFF" style="margin: 0 auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;max-width: 600px;clear: both;">
<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;"><table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;"><tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">

<h3 style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">Hola, '.$nomregusuario.'</h3><p class="callout" style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 15px;font-weight: normal;font-size: 14px;line-height: 1.6;background-color: #fcecec;">Por medidas se seguridad necesitamos que valides tu cuenta haciendo clic en el siguiente enlace:. <a href="http://www.hotsecretsperu.com/prueba/alta-usuario-ok.php?id='.$altausuario.'&email='.$correoalta.'" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;font-weight: bold;">Click en el Enlace! &raquo;</a></p>
<table class="social" width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #fcecec;width: 100%;">
<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><!-- column 1 -->
<table align="left" class="column" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 280px;float: left;min-width: 279px;">
<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><h5 class="" style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 17px;">Conectate con nosotros:</h5>
<p class="" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;"><a href="https://www.facebook.com/HotSecrets" class="soc-btn fb" style="margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;background-color: #3B5998;">Facebook</a> <a href="#" class="soc-btn tw" style="margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;background-color: #1daced;">Twitter</a> <a href="#" class="soc-btn gp" style="margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;background-color: #DB4A39;">Google+</a></p></td>
</tr></table><!-- /column 1 -->	
<!-- column 2 -->
<table align="left" class="column" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 280px;float: left;min-width: 279px;">
<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<td style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">				
<h5 style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 17px;">Informacion:</h5>												
<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">Tefonos: <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">3492780 / 996546562</strong><br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
Email: <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a href="emailto:ventas@hotsecretsperu.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;">ventas@hotsecretsperu.com</a></strong></p></td></tr></table><span class="clear" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;clear: both;"></span></td></tr></table></td>
</tr></table></div>						
</td><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td></tr></table>
<table class="footer-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;clear: both;"><tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td><td class="container" style="margin: 0 auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;max-width: 600px;clear: both;">
<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
<table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;"><tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td align="center" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;"><a href="#" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;">Privacidad</a> |
<a href="#" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;">Politicas de Uso</a> |
<a href="#" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;"><unsubscribe style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">Unsubscribe</unsubscribe></a></p></td></tr></table></div></td><td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td></tr></table>
</body>
</html>';	
	mail($destinatario, $asunto, $contenido, $headers);}
//*************************************************************
function UsuarioAltaListo($Confirm, $control)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$updateSQL = sprintf("UPDATE usuarios SET altaok='', estado = 1 WHERE correo = %s",
GetSQLValueString($Confirm, "text"));
mysql_select_db($database_HotSecrets, $HotSecrets);
$Result1 = mysql_query($updateSQL, $HotSecrets) or die(mysql_error());}	
//********Obtener nombre categoria*********************
function MostarNombreCategoria($NomSub)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Subcat = sprintf("SELECT nom_cate FROM categorias WHERE id_categoria = %s", $NomSub);
$Subcat = mysql_query($query_Subcat, $HotSecrets) or die(mysql_error());
$row_Subcat = mysql_fetch_assoc($Subcat);
$totalRows_Subcat = mysql_num_rows($Subcat);
return $row_Subcat['nom_cate']; 
mysql_free_result($Subcat);}
//********Obtener NOMBRE Sub-Categoria*********************
function MostarNombreSubCategoria($NomSub)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Subcat = sprintf("SELECT nom_subcat FROM subcategorias WHERE id_subcategoria = %s", $NomSub);
$Subcat = mysql_query($query_Subcat, $HotSecrets) or die(mysql_error());
$row_Subcat = mysql_fetch_assoc($Subcat);
$totalRows_Subcat = mysql_num_rows($Subcat);
return $row_Subcat['nom_subcat']; 
mysql_free_result($Subcat);}
//****************Mostrar tallas en Detalle***********************
function MostrarTallasProducto($identificador)
{
global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ConsultaFuncion = sprintf("SELECT productos_tallas.id_talla, productos_tallas.nom_talla, productos_tallas.precio_talla FROM relacion_tallas Inner Join productos_tallas ON relacion_tallas.rel_talla = productos_tallas.id_talla WHERE relacion_tallas.rel_producto = %s", $identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>
    <?php
	if ($totalRows_ConsultaFuncion > 0) { 
	?>
<div class="product-options" id="product-options-wrapper">
<dl>            
<dt>
<label class="required"><em>*</em>Talla</label></dt>
<dd class="last">
<div class="input-box">
<select name="id_talla" class=" required-entry product-custom-option" onchange="opConfig.reloadPrice()">
<option value="" >-- Selecionar Talla --</option>
    <?php
		do { 
		?>
        <option value="<?php echo $row_ConsultaFuncion['id_talla']?>"><?php echo $row_ConsultaFuncion['nom_talla']?> (+ S/.<?php echo number_format($row_ConsultaFuncion['precio_talla'],2, '.', '');?>)</option>
	 <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		?>        
        </select>
</div>
</dd>
</dl>
<p class="required">* Campos requeridos</p>
</div>
        <?php
	}
	else
	{
	?>	
    <input name="id_talla" type="hidden" value="0" />
    <?php 
		}

	mysql_free_result($ConsultaFuncion);
}
//****************Mostrar color en Detalle***********************
function MostrarColorProducto($identificador)
{
global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ConsultaFuncion = sprintf("SELECT productos_colores.id_color, productos_colores.nom_color, productos_colores.precio_color FROM relacion_colores Inner Join productos_colores ON relacion_colores.rel_color = productos_colores.id_color WHERE relacion_colores.rel_producto = %s", $identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>
    <?php
	if ($totalRows_ConsultaFuncion > 0) { 
	?>
<div class="product-options" id="product-options-wrapper">
<dl>            
<dt>
<label class="required"><em>*</em>Color</label></dt>
<dd class="last">
<div class="input-box">
<select name="id_color" class=" required-entry product-custom-option" onchange="opConfig.reloadPrice()">
<option value="" >-- Selecionar Color --</option>
<?php
		do { 
		?> 
        <option value="<?php echo $row_ConsultaFuncion['id_color']?>"><?php echo $row_ConsultaFuncion['nom_color']?> (+ S/.<?php echo number_format($row_ConsultaFuncion['precio_color'],2, '.', '');?>)</option>
	 <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		?>
</select>
</div>
</dd>
</dl>
<p class="required">* Campos requeridos</p>
</div>
        <?php
	}
	else
	{
	?>
    <input name="id_color" type="hidden" value="0" />
    <?php 
		}

	mysql_free_result($ConsultaFuncion);
}
//****************Mostrar colores disponibles en detalle***********************
function MostrarColorDetaDisp($identificador)
{
global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ConsultaFuncion = sprintf("SELECT productos_colores.id_color, productos_colores.nom_color, productos_colores.precio_color FROM relacion_colores Inner Join productos_colores ON relacion_colores.rel_color = productos_colores.id_color WHERE relacion_colores.rel_producto = %s", $identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>
    <?php
	if ($totalRows_ConsultaFuncion > 0) { 
	?>
 
        <p><?php
		do { 
		?>
		 - <?php echo $row_ConsultaFuncion['nom_color']?> <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		?></p>
	 

        <?php
	}
	else
	{
	?>
    <p>no tiene colores</p>
    <?php 
		}

	mysql_free_result($ConsultaFuncion);
}
//********Obtener Imagen Producto*********************
function MostarimagenProducto($ImgProductos)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Marca = sprintf("SELECT img_producto FROM productos WHERE id_producto = %s", $ImgProductos);
$Marca = mysql_query($query_Marca, $HotSecrets) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['img_producto']; 
mysql_free_result($Marca);}
//********Obtener nombre Producto*********************
function MostarNombreProducto($NomProducto)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Marca = sprintf("SELECT nom_producto FROM productos WHERE id_producto = %s", $NomProducto);
$Marca = mysql_query($query_Marca, $HotSecrets) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['nom_producto']; 
mysql_free_result($Marca);}
//********Obtener nombre Producto*********************
function MostarPrecioProducto($PreProducto)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Marca = sprintf("SELECT precio_normal_producto FROM productos WHERE id_producto = %s", $PreProducto);
$Marca = mysql_query($query_Marca, $HotSecrets) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['precio_normal_producto']; 
mysql_free_result($Marca);}
//********Obtener nombre Producto*********************
function MostarPrecioOfertaProducto($PreOfProducto)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Marca = sprintf("SELECT precio_oferta_producto FROM productos WHERE id_producto = %s", $PreOfProducto);
$Marca = mysql_query($query_Marca, $HotSecrets) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['precio_oferta_producto']; 
mysql_free_result($Marca);}
//********Obtener nombre talla*********************
function NombreTalla($tallarin)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT nom_talla FROM productos_tallas WHERE id_talla = %s", $tallarin);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nom_talla']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function PrecioTalla($tallarin)
{global $database_Pinky, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT precio_talla FROM productos_tallas WHERE id_talla = %s", $tallarin);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['precio_talla']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function NombreColor($colorin)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT nom_color FROM productos_colores WHERE id_color = %s", $colorin);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nom_color']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function PrecioColor($Copre)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT precio_color FROM productos_colores WHERE id_color = %s", $Copre);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['precio_color']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function PrecioDistrito($Distritso)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_PrecDist = sprintf("SELECT costo FROM distritos WHERE id_distrito = %s", $Distritso);
$PrecDist = mysql_query($query_PrecDist, $HotSecrets) or die(mysql_error());
$row_PrecDist = mysql_fetch_assoc($PrecDist);
$totalRows_PrecDist = mysql_num_rows($PrecDist);
return $row_PrecDist['costo']; 
mysql_free_result($PrecDist);
PrecioDistrito($_SESSION['MM_Usuario']);}
//********Obtener nombre Producto*********************
function NombreDistrito($NomDistr)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT nom_distrito FROM distritos WHERE id_distrito = %s", $NomDistr);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nom_distrito']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function NombreDepa($NomDepart)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT nombre_depa FROM departamentos WHERE id_departamento = %s", $NomDepart);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nombre_depa']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function NombreProvinvia($NomCiudad)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Tallon = sprintf("SELECT nom_prov FROM provincias WHERE id_provincia = %s", $NomCiudad);
$Tallon = mysql_query($query_Tallon, $HotSecrets) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nom_prov']; 
mysql_free_result($Tallon);}
//********Comprobando existencia de prod - talla - color para no repedtir*********
function Comprobarexistensia($idproducto,$idtalla,$idcolor)
{global $database_HotSecrets, $HotSecrets;
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ConsultaFuncion = sprintf("SELECT * FROM carrito WHERE id_usuario = %s AND id_producto=%s AND id_talla=%s AND id_color=%s AND transaccion_efectuada = 0", $_SESSION['MM_Usuario'],$idproducto,$idtalla,$idcolor);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $HotSecrets) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);	
if ($totalRows_ConsultaFuncion >0) 
return $row_ConsultaFuncion['id_carrito'];
else
return 0;
mysql_free_result($ConsultaFuncion);}