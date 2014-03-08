<?php require_once('../Connections/HotSecrets.php');
require_once('no-entra.php');
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

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_TallasProducto = "SELECT productos_tallas.nom_talla, productos_tallas.precio_talla FROM relacion_tallas Inner Join productos_tallas ON relacion_tallas.rel_talla = productos_tallas.id_talla WHERE relacion_tallas.rel_producto =".$_GET['tallprod'];
$TallasProducto = mysql_query($query_TallasProducto, $HotSecrets) or die(mysql_error());
$row_TallasProducto = mysql_fetch_assoc($TallasProducto);
$totalRows_TallasProducto = mysql_num_rows($TallasProducto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php do { ?>
<?php echo $row_TallasProducto['nom_talla']; ?>
<?php echo $row_TallasProducto['precio_talla']; ?>
<?php } while ($row_TallasProducto = mysql_fetch_assoc($TallasProducto)); ?>
<a href="agregar-talla-producto.php?tallprod=<?php echo $_GET['tallprod'] ?>">
Agregar Talla al Producto
</a>
</body>
</html>
<?php
mysql_free_result($TallasProducto);
?>
