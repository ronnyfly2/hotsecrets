<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($mysqli, $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  // PHP_VERSION < 6 check is no longer relevant as we are targeting PHP 7.4
  // get_magic_quotes_gpc is deprecated and removed in PHP 7.4

  if (!($mysqli instanceof mysqli)) {
    trigger_error("MySQLi connection object is required for GetSQLValueString", E_USER_ERROR);
    return "NULL"; // Or handle error as appropriate
  }

  $theValue = $mysqli->real_escape_string($theValue);

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
function MostrarNombreUsuario($HotSecrets, $UsuarioNom)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarNombreUsuario", E_USER_ERROR);
        return null;
    }
    if (!filter_var($UsuarioNom, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for UsuarioNom in MostrarNombreUsuario: " . $UsuarioNom);
        return null;
    }

    $query_nomb = "SELECT nombre FROM usuarios WHERE id_usuario = ?";
    $stmt = $HotSecrets->prepare($query_nomb);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarNombreUsuario: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $UsuarioNom);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarNombreUsuario: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nombre_usuario = null;
    if ($row_nomb = $result->fetch_assoc()) {
        $nombre_usuario = $row_nomb['nombre'];
    }

    $result->free();
    $stmt->close();
    return $nombre_usuario;
}
//**************Mostrar Nombre del Admin************************
function MostrarNombreAdmin($HotSecrets, $Administrador)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarNombreAdmin", E_USER_ERROR);
        return null;
    }
    if (!filter_var($Administrador, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for Administrador in MostrarNombreAdmin: " . $Administrador);
        return null;
    }

    $query_nomb = "SELECT nombre_ordenador FROM ordenador WHERE id_ordenador = ?";
    $stmt = $HotSecrets->prepare($query_nomb);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarNombreAdmin: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $Administrador);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarNombreAdmin: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nombre_admin = null;
    if ($row_nomb = $result->fetch_assoc()) {
        $nombre_admin = $row_nomb['nombre_ordenador'];
    }

    $result->free();
    $stmt->close();
    return $nombre_admin;
}
//**************Mostrar Apellido del Admin************************
function MostrarApellidoAdmin($HotSecrets, $Administrador)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarApellidoAdmin", E_USER_ERROR);
        return null;
    }
    if (!filter_var($Administrador, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for Administrador in MostrarApellidoAdmin: " . $Administrador);
        return null;
    }

    $query_nomb = "SELECT apellido_ordenador FROM ordenador WHERE id_ordenador = ?";
    $stmt = $HotSecrets->prepare($query_nomb);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarApellidoAdmin: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $Administrador);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarApellidoAdmin: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $apellido_admin = null;
    if ($row_nomb = $result->fetch_assoc()) {
        $apellido_admin = $row_nomb['apellido_ordenador'];
    }

    $result->free();
    $stmt->close();
    return $apellido_admin;
}
//**************Mostrar Imagen del Admin************************
function MostrarImagenAdmin($HotSecrets, $Administrador)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarImagenAdmin", E_USER_ERROR);
        return null;
    }
    if (!filter_var($Administrador, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for Administrador in MostrarImagenAdmin: " . $Administrador);
        return null;
    }

    $query_nomb = "SELECT img_ordenador FROM ordenador WHERE id_ordenador = ?";
    $stmt = $HotSecrets->prepare($query_nomb);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarImagenAdmin: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $Administrador);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarImagenAdmin: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $img_admin = null;
    if ($row_nomb = $result->fetch_assoc()) {
        $img_admin = $row_nomb['img_ordenador'];
    }

    $result->free();
    $stmt->close();
    return $img_admin;
}
//*********Obtener la URL del SEO-PRODUCTO*****************
function ObtenerUrlSEOProducto($HotSecrets, $identificador12)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for ObtenerUrlSEOProducto", E_USER_ERROR);
        return null;
    }
    // Basic validation for the input string can be added if necessary, e.g., checking if it's empty.

    $query_ConsultaFuncion = "SELECT id_producto FROM productos WHERE url_seo_producto = ?";
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in ObtenerUrlSEOProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("s", $identificador12);
    if (!$stmt->execute()) {
        error_log("Execute failed in ObtenerUrlSEOProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $id_producto = null;
    if ($row_ConsultaFuncion = $result->fetch_assoc()) {
        $id_producto = $row_ConsultaFuncion['id_producto'];
    }

    $result->free();
    $stmt->close();
    return $id_producto;
}
//*********Obtener la URL del SEO-Categoria*****************
function ObtenerUrlSEOCategoria($HotSecrets, $identificador25)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for ObtenerUrlSEOCategoria", E_USER_ERROR);
        return null;
    }

    $query_ConsultaFuncion = "SELECT id_categoria FROM categorias WHERE urlseo = ?";
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in ObtenerUrlSEOCategoria: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("s", $identificador25);
    if (!$stmt->execute()) {
        error_log("Execute failed in ObtenerUrlSEOCategoria: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $id_categoria = null;
    if ($row_ConsultaFuncion = $result->fetch_assoc()) {
        $id_categoria = $row_ConsultaFuncion['id_categoria'];
    }

    $result->free();
    $stmt->close();
    return $id_categoria;
}
//*********Obtener la URL del SEO-Sub-Categoria*****************
function ObtenerUrlSEOSub($HotSecrets, $identificador26)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for ObtenerUrlSEOSub", E_USER_ERROR);
        return null;
    }

    $query_ConsultaFuncion = "SELECT id_subcategoria FROM subcategorias WHERE url_seo_subcat = ?";
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in ObtenerUrlSEOSub: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("s", $identificador26);
    if (!$stmt->execute()) {
        error_log("Execute failed in ObtenerUrlSEOSub: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $id_subcategoria = null;
    if ($row_ConsultaFuncion = $result->fetch_assoc()) {
        $id_subcategoria = $row_ConsultaFuncion['id_subcategoria'];
    }

    $result->free();
    $stmt->close();
    return $id_subcategoria;
}
//****************Comprobar correo unico***********************	
function ComprobarCorreoUnico($HotSecrets, $correounic)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for ComprobarCorreoUnico", E_USER_ERROR);
        return false; // Default to false on error, indicating potential duplicate or error
    }

    // Validate email format
    if (!filter_var($correounic, FILTER_VALIDATE_EMAIL)) {
        error_log("Invalid email format in ComprobarCorreoUnico: " . $correounic);
        return false; // Not a valid email, so can't be a unique existing one in this context
    }

    $query_DatosFuncion = "SELECT correo FROM usuarios WHERE correo = ?";
    $stmt = $HotSecrets->prepare($query_DatosFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in ComprobarCorreoUnico: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return false; // Indicate failure/potential duplicate
    }

    $stmt->bind_param("s", $correounic);
    if (!$stmt->execute()) {
        error_log("Execute failed in ComprobarCorreoUnico: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return false; // Indicate failure/potential duplicate
    }

    $result = $stmt->get_result();
    $is_unique = ($result->num_rows == 0);

    $result->free();
    $stmt->close();
    return $is_unique;
}
//*****Envio de correo al usuario cuando se registra***********
function Darse_Alta_usuario($HotSecrets, $correoalta, $nomregusuario)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for Darse_Alta_usuario", E_USER_ERROR);
        return; // Or handle error as appropriate
    }

    $altausuario = substr(md5(rand()*time()),0,30);
    global $database_HotSecrets; // $HotSecrets is now a parameter

    // It's generally better to select the database at connection time, 
    // but if you need to switch, use $HotSecrets->select_db($database_HotSecrets);
    // However, the connection scripts already select the database.

	$updateSQL = sprintf("UPDATE usuarios SET altaok=%s WHERE correo = %s AND nombre = %s",
					   GetSQLValueString($HotSecrets, $altausuario, "text"),
                       GetSQLValueString($HotSecrets, $correoalta, "text"),
					   GetSQLValueString($HotSecrets, $nomregusuario, "text"));

    $Result1 = $HotSecrets->query($updateSQL);
    if (!$Result1) {
        trigger_error("Query failed: " . $HotSecrets->error, E_USER_ERROR);
    }
	
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
function UsuarioAltaListo($HotSecrets, $Confirm, $control) // $control parameter seems unused
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for UsuarioAltaListo", E_USER_ERROR);
        return; // Or handle error as appropriate
    }
    global $database_HotSecrets; // $HotSecrets is now a parameter

    // Database selection is ideally done at connection.
    // If switching is needed: $HotSecrets->select_db($database_HotSecrets);

    $updateSQL = sprintf("UPDATE usuarios SET altaok='', estado = 1 WHERE correo = %s",
                       GetSQLValueString($HotSecrets, $Confirm, "text"));

    $Result1 = $HotSecrets->query($updateSQL);
    if (!$Result1) {
        trigger_error("Query failed: " . $HotSecrets->error, E_USER_ERROR);
    }
}	
//********Obtener nombre categoria*********************
function MostarNombreCategoria($HotSecrets, $NomSub)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostarNombreCategoria", E_USER_ERROR);
        return null;
    }
    if (!filter_var($NomSub, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for NomSub in MostarNombreCategoria: " . $NomSub);
        return null;
    }

    $query_Subcat = "SELECT nom_cate FROM categorias WHERE id_categoria = ?";
    $stmt = $HotSecrets->prepare($query_Subcat);
    if ($stmt === false) {
        error_log("Prepare failed in MostarNombreCategoria: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $NomSub);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostarNombreCategoria: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_cate = null;
    if ($row_Subcat = $result->fetch_assoc()) {
        $nom_cate = $row_Subcat['nom_cate'];
    }

    $result->free();
    $stmt->close();
    return $nom_cate;
}
//********Obtener NOMBRE Sub-Categoria*********************
function MostarNombreSubCategoria($HotSecrets, $NomSub)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostarNombreSubCategoria", E_USER_ERROR);
        return null;
    }
    if (!filter_var($NomSub, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for NomSub in MostarNombreSubCategoria: " . $NomSub);
        return null;
    }

    $query_Subcat = "SELECT nom_subcat FROM subcategorias WHERE id_subcategoria = ?";
    $stmt = $HotSecrets->prepare($query_Subcat);
    if ($stmt === false) {
        error_log("Prepare failed in MostarNombreSubCategoria: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $NomSub);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostarNombreSubCategoria: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_subcat = null;
    if ($row_Subcat = $result->fetch_assoc()) {
        $nom_subcat = $row_Subcat['nom_subcat'];
    }

    $result->free();
    $stmt->close();
    return $nom_subcat;
}
//****************Mostrar tallas en Detalle***********************
function MostrarTallasProducto($HotSecrets, $identificador)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarTallasProducto", E_USER_ERROR);
        echo '<input name="id_talla" type="hidden" value="0" /><p>Error: No se pudo conectar a la base de datos.</p>';
        return;
    }
    if (!filter_var($identificador, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for identificador in MostrarTallasProducto: " . $identificador);
        echo '<input name="id_talla" type="hidden" value="0" /><p>Error: Identificador de producto inválido.</p>';
        return;
    }

    $query_ConsultaFuncion = "SELECT pt.id_talla, pt.nom_talla, pt.precio_talla 
                              FROM relacion_tallas rt
                              INNER JOIN productos_tallas pt ON rt.rel_talla = pt.id_talla 
                              WHERE rt.rel_producto = ?";
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarTallasProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        echo '<input name="id_talla" type="hidden" value="0" /><p>Error al preparar la consulta de tallas.</p>';
        return;
    }

    $stmt->bind_param("i", $identificador);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarTallasProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        echo '<input name="id_talla" type="hidden" value="0" /><p>Error al ejecutar la consulta de tallas.</p>';
        return;
    }

    $result = $stmt->get_result();
    $totalRows_ConsultaFuncion = $result->num_rows;

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
		while ($row_ConsultaFuncion = $result->fetch_assoc()) { 
		?>
        <option value="<?php echo htmlspecialchars($row_ConsultaFuncion['id_talla']); ?>"><?php echo htmlspecialchars($row_ConsultaFuncion['nom_talla']); ?> (+ S/.<?php echo htmlspecialchars(number_format($row_ConsultaFuncion['precio_talla'], 2, '.', '')); ?>)</option>
	 <?php
		} 
		?>        
        </select>
</div>
</dd>
</dl>
<p class="required">* Campos requeridos</p>
</div>
    <?php
	} else {
	?>	
    <input name="id_talla" type="hidden" value="0" />
    <?php 
	}

    $result->free();
    $stmt->close();
}
//****************Mostrar color en Detalle***********************
function MostrarColorProducto($HotSecrets, $identificador)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarColorProducto", E_USER_ERROR);
        echo '<input name="id_color" type="hidden" value="0" /><p>Error: No se pudo conectar a la base de datos.</p>';
        return;
    }
    if (!filter_var($identificador, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for identificador in MostrarColorProducto: " . $identificador);
        echo '<input name="id_color" type="hidden" value="0" /><p>Error: Identificador de producto inválido.</p>';
        return;
    }

    $query_ConsultaFuncion = "SELECT pc.id_color, pc.nom_color, pc.precio_color 
                              FROM relacion_colores rc
                              INNER JOIN productos_colores pc ON rc.rel_color = pc.id_color 
                              WHERE rc.rel_producto = ?";
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarColorProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        echo '<input name="id_color" type="hidden" value="0" /><p>Error al preparar la consulta de colores.</p>';
        return;
    }

    $stmt->bind_param("i", $identificador);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarColorProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        echo '<input name="id_color" type="hidden" value="0" /><p>Error al ejecutar la consulta de colores.</p>';
        return;
    }

    $result = $stmt->get_result();
    $totalRows_ConsultaFuncion = $result->num_rows;

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
		while ($row_ConsultaFuncion = $result->fetch_assoc()) { 
		?> 
        <option value="<?php echo htmlspecialchars($row_ConsultaFuncion['id_color']); ?>"><?php echo htmlspecialchars($row_ConsultaFuncion['nom_color']); ?> (+ S/.<?php echo htmlspecialchars(number_format($row_ConsultaFuncion['precio_color'], 2, '.', '')); ?>)</option>
	 <?php
		} 
		?>
</select>
</div>
</dd>
</dl>
<p class="required">* Campos requeridos</p>
</div>
    <?php
	} else {
	?>
    <input name="id_color" type="hidden" value="0" />
    <?php 
	}

    $result->free();
    $stmt->close();
}
//****************Mostrar colores disponibles en detalle***********************
function MostrarColorDetaDisp($HotSecrets, $identificador)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostrarColorDetaDisp", E_USER_ERROR);
        echo '<p>Error: No se pudo conectar a la base de datos.</p>';
        return;
    }
    if (!filter_var($identificador, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for identificador in MostrarColorDetaDisp: " . $identificador);
        echo '<p>Error: Identificador de producto inválido.</p>';
        return;
    }

    $query_ConsultaFuncion = "SELECT pc.nom_color 
                              FROM relacion_colores rc
                              INNER JOIN productos_colores pc ON rc.rel_color = pc.id_color 
                              WHERE rc.rel_producto = ?";
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in MostrarColorDetaDisp: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        echo '<p>Error al preparar la consulta de colores disponibles.</p>';
        return;
    }

    $stmt->bind_param("i", $identificador);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostrarColorDetaDisp: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        echo '<p>Error al ejecutar la consulta de colores disponibles.</p>';
        return;
    }

    $result = $stmt->get_result();
    $totalRows_ConsultaFuncion = $result->num_rows;

    if ($totalRows_ConsultaFuncion > 0) { 
        echo "<p>";
        $colors = [];
		while ($row_ConsultaFuncion = $result->fetch_assoc()) { 
            $colors[] = htmlspecialchars($row_ConsultaFuncion['nom_color']);
		}
        echo " - " . implode(" - ", $colors);
        echo "</p>";
	} else {
	?>
    <p>no tiene colores</p>
    <?php 
	}

    $result->free();
    $stmt->close();
}
//********Obtener Imagen Producto*********************
function MostarimagenProducto($HotSecrets, $ImgProductos)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostarimagenProducto", E_USER_ERROR);
        return null;
    }
    if (!filter_var($ImgProductos, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for ImgProductos in MostarimagenProducto: " . $ImgProductos);
        return null;
    }

    $query_Marca = "SELECT img_producto FROM productos WHERE id_producto = ?";
    $stmt = $HotSecrets->prepare($query_Marca);
    if ($stmt === false) {
        error_log("Prepare failed in MostarimagenProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $ImgProductos);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostarimagenProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $img_producto = null;
    if ($row_Marca = $result->fetch_assoc()) {
        $img_producto = $row_Marca['img_producto'];
    }

    $result->free();
    $stmt->close();
    return $img_producto;
}
//********Obtener nombre Producto*********************
function MostarNombreProducto($HotSecrets, $NomProducto)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostarNombreProducto", E_USER_ERROR);
        return null;
    }
    if (!filter_var($NomProducto, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for NomProducto in MostarNombreProducto: " . $NomProducto);
        return null;
    }

    $query_Marca = "SELECT nom_producto FROM productos WHERE id_producto = ?";
    $stmt = $HotSecrets->prepare($query_Marca);
    if ($stmt === false) {
        error_log("Prepare failed in MostarNombreProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $NomProducto);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostarNombreProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_producto = null;
    if ($row_Marca = $result->fetch_assoc()) {
        $nom_producto = $row_Marca['nom_producto'];
    }

    $result->free();
    $stmt->close();
    return $nom_producto;
}
//********Obtener nombre Producto*********************
function MostarPrecioProducto($HotSecrets, $PreProducto)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostarPrecioProducto", E_USER_ERROR);
        return null;
    }
    if (!filter_var($PreProducto, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for PreProducto in MostarPrecioProducto: " . $PreProducto);
        return null;
    }

    $query_Marca = "SELECT precio_normal_producto FROM productos WHERE id_producto = ?";
    $stmt = $HotSecrets->prepare($query_Marca);
    if ($stmt === false) {
        error_log("Prepare failed in MostarPrecioProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $PreProducto);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostarPrecioProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $precio_normal_producto = null;
    if ($row_Marca = $result->fetch_assoc()) {
        $precio_normal_producto = $row_Marca['precio_normal_producto'];
    }

    $result->free();
    $stmt->close();
    return $precio_normal_producto;
}
//********Obtener nombre Producto*********************
function MostarPrecioOfertaProducto($HotSecrets, $PreOfProducto)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for MostarPrecioOfertaProducto", E_USER_ERROR);
        return null;
    }
    if (!filter_var($PreOfProducto, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for PreOfProducto in MostarPrecioOfertaProducto: " . $PreOfProducto);
        return null;
    }

    $query_Marca = "SELECT precio_oferta_producto FROM productos WHERE id_producto = ?";
    $stmt = $HotSecrets->prepare($query_Marca);
    if ($stmt === false) {
        error_log("Prepare failed in MostarPrecioOfertaProducto: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $PreOfProducto);
    if (!$stmt->execute()) {
        error_log("Execute failed in MostarPrecioOfertaProducto: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $precio_oferta_producto = null;
    if ($row_Marca = $result->fetch_assoc()) {
        $precio_oferta_producto = $row_Marca['precio_oferta_producto'];
    }

    $result->free();
    $stmt->close();
    return $precio_oferta_producto;
}
//********Obtener nombre talla*********************
function NombreTalla($HotSecrets, $tallarin)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for NombreTalla", E_USER_ERROR);
        return null;
    }
    if (!filter_var($tallarin, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for tallarin in NombreTalla: " . $tallarin);
        return null;
    }

    $query_Tallon = "SELECT nom_talla FROM productos_tallas WHERE id_talla = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in NombreTalla: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $tallarin);
    if (!$stmt->execute()) {
        error_log("Execute failed in NombreTalla: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_talla = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $nom_talla = $row_Tallon['nom_talla'];
    }

    $result->free();
    $stmt->close();
    return $nom_talla;
}
//********Obtener nombre Producto*********************
function PrecioTalla($HotSecrets, $tallarin)
{
    // global $database_Pinky; // This global seems unused if $HotSecrets handles the connection.
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for PrecioTalla", E_USER_ERROR);
        return null;
    }
    if (!filter_var($tallarin, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for tallarin in PrecioTalla: " . $tallarin);
        return null;
    }

    $query_Tallon = "SELECT precio_talla FROM productos_tallas WHERE id_talla = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in PrecioTalla: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $tallarin);
    if (!$stmt->execute()) {
        error_log("Execute failed in PrecioTalla: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $precio_talla = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $precio_talla = $row_Tallon['precio_talla'];
    }

    $result->free();
    $stmt->close();
    return $precio_talla;
}
//********Obtener nombre Producto*********************
function NombreColor($HotSecrets, $colorin)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for NombreColor", E_USER_ERROR);
        return null;
    }
    if (!filter_var($colorin, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for colorin in NombreColor: " . $colorin);
        return null;
    }

    $query_Tallon = "SELECT nom_color FROM productos_colores WHERE id_color = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in NombreColor: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $colorin);
    if (!$stmt->execute()) {
        error_log("Execute failed in NombreColor: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_color = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $nom_color = $row_Tallon['nom_color'];
    }

    $result->free();
    $stmt->close();
    return $nom_color;
}
//********Obtener nombre Producto*********************
function PrecioColor($HotSecrets, $Copre)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for PrecioColor", E_USER_ERROR);
        return null;
    }
    if (!filter_var($Copre, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for Copre in PrecioColor: " . $Copre);
        return null;
    }

    $query_Tallon = "SELECT precio_color FROM productos_colores WHERE id_color = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in PrecioColor: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $Copre);
    if (!$stmt->execute()) {
        error_log("Execute failed in PrecioColor: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $precio_color = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $precio_color = $row_Tallon['precio_color'];
    }

    $result->free();
    $stmt->close();
    return $precio_color;
}
//********Obtener nombre Producto*********************
function PrecioDistrito($HotSecrets, $Distritso)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for PrecioDistrito", E_USER_ERROR);
        return null;
    }
    if (!filter_var($Distritso, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for Distritso in PrecioDistrito: " . $Distritso);
        return null;
    }

    $query_PrecDist = "SELECT costo FROM distritos WHERE id_distrito = ?";
    $stmt = $HotSecrets->prepare($query_PrecDist);
    if ($stmt === false) {
        error_log("Prepare failed in PrecioDistrito: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $Distritso);
    if (!$stmt->execute()) {
        error_log("Execute failed in PrecioDistrito: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $costo = null;
    if ($row_PrecDist = $result->fetch_assoc()) {
        $costo = $row_PrecDist['costo'];
    }

    $result->free();
    $stmt->close();
    return $costo;
    // Removed problematic recursive call: PrecioDistrito($_SESSION['MM_Usuario']);
}
//********Obtener nombre Producto*********************
function NombreDistrito($HotSecrets, $NomDistr)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for NombreDistrito", E_USER_ERROR);
        return null;
    }
    if (!filter_var($NomDistr, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for NomDistr in NombreDistrito: " . $NomDistr);
        return null;
    }

    $query_Tallon = "SELECT nom_distrito FROM distritos WHERE id_distrito = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in NombreDistrito: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $NomDistr);
    if (!$stmt->execute()) {
        error_log("Execute failed in NombreDistrito: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_distrito = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $nom_distrito = $row_Tallon['nom_distrito'];
    }

    $result->free();
    $stmt->close();
    return $nom_distrito;
}
//********Obtener nombre Producto*********************
function NombreDepa($HotSecrets, $NomDepart)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for NombreDepa", E_USER_ERROR);
        return null;
    }
    if (!filter_var($NomDepart, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for NomDepart in NombreDepa: " . $NomDepart);
        return null;
    }

    $query_Tallon = "SELECT nombre_depa FROM departamentos WHERE id_departamento = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in NombreDepa: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $NomDepart);
    if (!$stmt->execute()) {
        error_log("Execute failed in NombreDepa: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nombre_depa = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $nombre_depa = $row_Tallon['nombre_depa'];
    }

    $result->free();
    $stmt->close();
    return $nombre_depa;
}
//********Obtener nombre Producto*********************
function NombreProvinvia($HotSecrets, $NomCiudad)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for NombreProvinvia", E_USER_ERROR);
        return null;
    }
    if (!filter_var($NomCiudad, FILTER_VALIDATE_INT)) {
        error_log("Invalid input for NomCiudad in NombreProvinvia: " . $NomCiudad);
        return null;
    }

    $query_Tallon = "SELECT nom_prov FROM provincias WHERE id_provincia = ?";
    $stmt = $HotSecrets->prepare($query_Tallon);
    if ($stmt === false) {
        error_log("Prepare failed in NombreProvinvia: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return null;
    }

    $stmt->bind_param("i", $NomCiudad);
    if (!$stmt->execute()) {
        error_log("Execute failed in NombreProvinvia: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return null;
    }

    $result = $stmt->get_result();
    $nom_prov = null;
    if ($row_Tallon = $result->fetch_assoc()) {
        $nom_prov = $row_Tallon['nom_prov'];
    }

    $result->free();
    $stmt->close();
    return $nom_prov;
}
//********Comprobando existencia de prod - talla - color para no repedtir*********
// Added $HotSecrets and $id_usuario as parameters
function Comprobarexistensia($HotSecrets, $idproducto, $idtalla, $idcolor, $id_usuario)
{
    if (!($HotSecrets instanceof mysqli)) {
        trigger_error("MySQLi connection object is required for Comprobarexistensia", E_USER_ERROR);
        return 0; // Or handle error as appropriate
    }

    // Validate inputs (basic validation, can be enhanced)
    if (!filter_var($id_usuario, FILTER_VALIDATE_INT) || 
        !filter_var($idproducto, FILTER_VALIDATE_INT)) {
        error_log("Invalid user ID or product ID in Comprobarexistensia.");
        return 0;
    }
    // idtalla and idcolor are treated as strings as per previous usage in agregar-carrito.php

    $query_ConsultaFuncion = "SELECT id_carrito FROM carrito WHERE id_usuario = ? AND id_producto = ? AND id_talla = ? AND id_color = ? AND transaccion_efectuada = 0";
    
    $stmt = $HotSecrets->prepare($query_ConsultaFuncion);
    if ($stmt === false) {
        error_log("Prepare failed in Comprobarexistensia: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        return 0; // Indicate failure
    }

    $stmt->bind_param("iiss", $id_usuario, $idproducto, $idtalla, $idcolor);

    if (!$stmt->execute()) {
        error_log("Execute failed in Comprobarexistensia: (" . $stmt->errno . ") " . $stmt->error);
        $stmt->close();
        return 0; // Indicate failure
    }

    $result = $stmt->get_result();
    if ($row_ConsultaFuncion = $result->fetch_assoc()) {
        $id_carrito_found = $row_ConsultaFuncion['id_carrito'];
        $result->free();
        $stmt->close();
        return $id_carrito_found;
    } else {
        $result->free();
        $stmt->close();
        return 0; // Not found
    }
}