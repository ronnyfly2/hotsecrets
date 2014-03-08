<?php require_once('Connections/HotSecrets.php'); 
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
$_POST['estado']= 0;
$estadoinactivo = $_POST['estado'];
$_POST['ipus']= getRealIP();
$ipusuario = $_POST['ipus'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formregistro")) {
if (!ComprobarCorreoUnico($_POST['correo']))
{
$insertGoTo = "correo-repetido.php";
header(sprintf("Location: %s", $insertGoTo));
}
else
{
  $insertSQL = sprintf("INSERT INTO usuarios (nombre, apellido, correo, password, fecha_reg, estado, suscrito, ipus) VALUES (%s, %s, %s, %s, NOW(), %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString(md5($_POST['password']), "text"),                      
					   GetSQLValueString($estadoinactivo, "int"),
					   GetSQLValueString(isset($_POST['suscrito']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString($ipusuario, "text"));

mysql_select_db($database_HotSecrets, $HotSecrets);
$Result1 = mysql_query($insertSQL, $HotSecrets) or die(mysql_error());
Darse_Alta_usuario($_POST['correo'],$_POST['nombre']);
$insertGoTo = "confirmar-correo.php";
if (isset($_SERVER['QUERY_STRING'])) {
$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
$insertGoTo .= $_SERVER['QUERY_STRING'];
}
header(sprintf("Location: %s", $insertGoTo));
}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/4-registro-head.php"); ?>
</head>
<body class=" customer-account-create">
<div class="ma-wrapper">
<noscript>
<div class="global-site-notice noscript">
<div class="notice-inner">
<p>
<strong>Parece que su navegador tiene desactivado JavaScript.</strong><br />
Usted debe tener Javascript activado en tu navegador para utilizar la funcionalidad de este sitio web.
</p>
</div>
</div>
</noscript>
<div class="ma-page">
<?php include("extructura-hot/1-header.php"); ?>
<div class="ma-main-container col1-layout">
<div class="container">
<div class="main">
<div class="main-inner">
<div class="col-main">
<div class="account-create">
<div class="page-title" style=" background:#FFF;">
<h1 style="margin-left:15px;">Formulario de Registro</h1>
</div>
<?php include("extructura-hot/4-registro-formu.php"); ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>
</body>
</html>