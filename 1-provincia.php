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

$VarDeparta_Provincias = "0";
if (isset($_GET["id"])) {
  $VarDeparta_Provincias = $_GET["id"];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Provincias = sprintf("SELECT * FROM provincias WHERE provincias.id_departamento = %s", GetSQLValueString($VarDeparta_Provincias, "int"));
$Provincias = mysql_query($query_Provincias, $HotSecrets) or die(mysql_error());
$row_Provincias = mysql_fetch_assoc($Provincias);
$totalRows_Provincias = mysql_num_rows($Provincias);
?>
<div id="provincia">
<label for="id_provincia" class="required"><em>*</em>Provincia</label>
<div class="input-box">
<select name="id_provincia" class="validate[required]" onchange="from(document.form1.id_provincia.value,'distrito','1-distrito.php')">
<option value="">Escoja su Provincia</option>
<?php do { ?>
<option value="<?php echo $row_Provincias['id_provincia']; ?>"><?php echo $row_Provincias['nom_prov']; ?></option>
<?php } while ($row_Provincias = mysql_fetch_assoc($Provincias)); ?>
</select>
 </div> 
</div>
<?php
mysql_free_result($Provincias);
?>
