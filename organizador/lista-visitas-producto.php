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

$VarDetalle_Visitas = "0";
if (isset($_GET["detalles"])) {
  $VarDetalle_Visitas = $_GET["detalles"];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Visitas = sprintf("SELECT * FROM click_productos WHERE click_productos.id_producto = %s", GetSQLValueString($VarDetalle_Visitas, "int"));
$Visitas = mysql_query($query_Visitas, $HotSecrets) or die(mysql_error());
$row_Visitas = mysql_fetch_assoc($Visitas);
$totalRows_Visitas = mysql_num_rows($Visitas);
?>
<!DOCTYPE html>
<html lang="en">
<?php include("xtructura/1-head-lista-categorias.php"); ?>
<body>
<section id="container" class="">
<!--header start-->
<?php include("xtructura/1-header.php"); ?>
<!--header end-->
<!--sidebar start-->
<?php include("xtructura/2-menu-lista-categorias.php"); ?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
<?php include("xtructura/1-contenido-lista-visitas-productos.php"); ?>
</section>
<!--main content end-->
<?php include("xtructura/7-footer.php"); ?> 
</section>
<!-- js placed at the end of the document so the pages load faster -->     
<!--script for this page only-->
<script src="js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="js/DT_bootstrap.js"></script>
<script src="js/respond.min.js" ></script>
<!--common script for all pages-->
<script src="js/common-scripts.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#example').dataTable( {
"aaSorting": [[ 4, "desc" ]]
} );
} );
</script>
<?php
mysql_free_result($Visitas);
?>
