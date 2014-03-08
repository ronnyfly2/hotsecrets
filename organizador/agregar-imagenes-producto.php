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
  $insertSQL = sprintf("INSERT INTO imagenes_productos (id_producto, imagenes, posicion_imag) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_producto'], "int"),
                       GetSQLValueString($_POST['imagenes'], "text"),
					   GetSQLValueString($_POST['posicion_imag'], "text"));

  mysql_select_db($database_HotSecrets, $HotSecrets);
  $Result1 = mysql_query($insertSQL, $HotSecrets) or die(mysql_error());

  $insertGoTo = "lista-imagenes-producto.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<script> 
function subirimagenes()
{
	self.name = 'opener';
	remote = open('2-subir-imagenes-del-producto.php', 'remote', 'width=400,height=162,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
		}
</script>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="control-group">
<label class="control-label">Imagen Principal</label>
<div class="controls">
<input name="imagenes" type="text" class="span7" value="" size="32" readonly>


<span>
<input type="button" name="button" id="button" class="btn green filebutton" value="Subir Imagen" onClick="javascript:subirimagenes();">
</span>
</label>
<input type="submit" value="Insertar registro" /></td>

<label class="col-sm-2 control-label col-lg-2" for="id_subcategoria">Pertenece a la Subcategoria</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="posicion_imag">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>

    <input type="hidden" name="id_producto" value="<?php echo $_GET['imgprod']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</div>
</div>
</body>
</html>