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
$query_ColorProducto = "SELECT productos_colores.nom_color, productos_colores.precio_color FROM relacion_colores Inner Join productos_colores ON relacion_colores.rel_color = productos_colores.id_color WHERE relacion_colores.rel_producto =".$_GET['colorprod'];
$ColorProducto = mysql_query($query_ColorProducto, $HotSecrets) or die(mysql_error());
$row_ColorProducto = mysql_fetch_assoc($ColorProducto);
$totalRows_ColorProducto = mysql_num_rows($ColorProducto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php do { ?>
<?php echo $row_ColorProducto['nom_color']; ?>
<?php echo $row_ColorProducto['precio_color']; ?>
<?php } while ($row_ColorProducto = mysql_fetch_assoc($ColorProducto)); ?>
<a href="agregar-color-producto.php?colorprod=<?php echo $_GET['colorprod'] ?>">
Agregar Talla al Producto
</a>
</body>
</html>
<?php
mysql_free_result($ColorProducto);
?>
