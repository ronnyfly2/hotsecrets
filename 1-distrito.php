<?php require_once('Connections/HotSecrets.php'); ?>
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

$VarProvincia_Distritos = "0";
if (isset($_GET["id"])) {
  $VarProvincia_Distritos = $_GET["id"];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Distritos = sprintf("SELECT * FROM distritos WHERE distritos.id_provincia = %s", GetSQLValueString($VarProvincia_Distritos, "int"));
$Distritos = mysql_query($query_Distritos, $HotSecrets) or die(mysql_error());
$row_Distritos = mysql_fetch_assoc($Distritos);
$totalRows_Distritos = mysql_num_rows($Distritos);
?>
<div id="distrito">
<label for="id_distrito" class="required"><em>*</em>Distrito</label>
<div class="input-box">
<select name="id_distrito" class="validate[required]">
<option value="">Escoja su Distrito</option>
<?php do { ?>
<option value="<?php echo $row_Distritos['id_distrito']; ?>"><?php echo $row_Distritos['nom_distrito']; ?></option>
<?php } while ($row_Distritos = mysql_fetch_assoc($Distritos)); ?>
</select>
</div> 
</div>
<?php
mysql_free_result($Distritos);
?>
