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
 if ($_POST['cantidad'] > 0) { 
 // Show if recordset not empty 
 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$valorrespuesta = comprobarexistensia($_POST['producto'],$_POST['id_talla'],$_POST['id_color']);
if ($valorrespuesta!=0){
	//UPDATE
  $insertSQL = sprintf("UPDATE carrito SET cantidad = cantidad + %s WHERE id_carrito = %s",$_POST['cantidad'],$valorrespuesta);
}
else
{

  $insertSQL = sprintf("INSERT INTO carrito (id_usuario, id_producto, cantidad, id_talla, id_color, fecha_carrito) VALUES (%s, %s, %s, %s, %s, NOW())",
                       GetSQLValueString($_SESSION['MM_Usuario'], "int"),
                       GetSQLValueString($_POST['producto'], "text"),                                            
                       GetSQLValueString($_POST['cantidad'],"int"),
					   GetSQLValueString($_POST['id_talla'],"text"),
					   GetSQLValueString($_POST['id_color'],"text"));
}
  mysql_select_db($database_HotSecrets, $HotSecrets);
  $Result1 = mysql_query($insertSQL, $HotSecrets) or die(mysql_error());

  $insertGoTo = "lista-carrito.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '')) ? "" : "";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));

 } // Show if recordset not empty ?>
<?php if ($_POST['cantidad'] == 0) { // Show if recordset empty ?>
<meta http-equiv="refresh" content="01;URL=index.php" />
No ahi nada en esta pagina
<?php } // Show if recordset empty ?>