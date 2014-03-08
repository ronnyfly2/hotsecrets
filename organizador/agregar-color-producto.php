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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO relacion_colores (rel_producto, rel_color) VALUES (%s, %s)",
                       GetSQLValueString($_POST['rel_producto'], "int"),
                       GetSQLValueString($_POST['rel_color'], "int"));

  mysql_select_db($database_HotSecrets, $HotSecrets);
  $Result1 = mysql_query($insertSQL, $HotSecrets) or die(mysql_error());

  $insertGoTo = "lista-color-producto.php?colorprod=".$_GET['colorprod'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_DefTallasProducto = "SELECT * FROM productos_colores ORDER BY productos_colores.nom_color";
$DefTallasProducto = mysql_query($query_DefTallasProducto, $HotSecrets) or die(mysql_error());
$row_DefTallasProducto = mysql_fetch_assoc($DefTallasProducto);
$totalRows_DefTallasProducto = mysql_num_rows($DefTallasProducto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rel_talla:</td>
      <td><select name="rel_color">
        <?php 
do {  
?>
        <option value="<?php echo $row_DefTallasProducto['id_color']?>" ><?php echo $row_DefTallasProducto['nom_color']?></option>
        <?php
} while ($row_DefTallasProducto = mysql_fetch_assoc($DefTallasProducto));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="rel_producto" value="<?php echo $_GET['colorprod'] ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($DefTallasProducto);
?>
