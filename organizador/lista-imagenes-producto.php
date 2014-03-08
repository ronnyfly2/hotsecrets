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
$query_ListaImagenesProductos = "SELECT * FROM imagenes_productos WHERE imagenes_productos.id_producto=".$_GET["imgprod"];
$ListaImagenesProductos = mysql_query($query_ListaImagenesProductos, $HotSecrets) or die(mysql_error());
$row_ListaImagenesProductos = mysql_fetch_assoc($ListaImagenesProductos);
$totalRows_ListaImagenesProductos = mysql_num_rows($ListaImagenesProductos);
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
<section class="wrapper site-min-height">
<!-- page start-->
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">Lista de Imagenes del Producto  | <?php echo MostarNombreProducto($_GET['imgprod']); ?></header>
<div class="panel-body">
<div class="adv-table">
<div class="clearfix">
<div class="btn-group">
<button id="editable-sample_new" class="btn btn-danger">
<i class="fa fa-reply"></i>
<a style="color:#FFF;" href="lista-productos.php">Regresar</a> 
</button>
<button id="editable-sample_new" class="btn green">
<a style="color:#FFF;" href="agregar-imagenes-producto.php?imgprod=<?php echo $_GET['imgprod']; ?>">Agregar imagen</a> 
<i class="fa fa-plus"></i>
</button>
</div>
</div>
<?php if ($totalRows_ListaImagenesProductos > 0) { // Show if recordset empty ?>
<table class="display table table-bordered table-striped" id="tabla-color">
<thead>
<tr>

<th>Imagen</th>
<th>Posicion de la Imagen</th>
<th>Nombre de Imagen</th>
<th>Opciones</th>
</tr>
</thead>
<tbody>
<?php do { ?>
<tr>
<td>
<img src="../img.php?imagen=imagenes/productos/<?php echo $row_ListaImagenesProductos['imagenes']; ?>&ancho=95&alto=101&cut&mark=false"<?php //echo $row_ListaImagenesProductos['id_imagen_prod']; ?> />
</td>
<td>
<?php echo $row_ListaImagenesProductos['posicion_imag']; ?>
</td>

<td>
<?php echo $row_ListaImagenesProductos['imagenes']; ?>
</td>

<td>

<a href="editar-imagen-producto.php">
<button type="button" data-toggle="tooltip" data-original-title="Editar Imagen" data-placement="top" class="btn btn-warning btn-xs tooltips">
<i class="fa fa-pencil"></i>
</button>
</a>
<a href="eliminar-imagen-producto.php?imgprod=<?php echo $_GET['imgprod']; ?>&eliminar=<?php echo $row_ListaImagenesProductos['id_imagen_prod']; ?>">
<button type="button" data-toggle="tooltip" data-original-title="Eliminar Imagen" data-placement="top" class="btn btn-danger btn-xs tooltips">
<i class="fa fa-trash-o"></i>
</button>
</a>
</td>
</tr>
<?php } while ($row_ListaImagenesProductos = mysql_fetch_assoc($ListaImagenesProductos)); ?>
</tbody>
</table>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_ListaImagenesProductos == 0) { // Show if recordset empty ?>
No hay Imagenes Disponibles.
<?php } // Show if recordset empty ?>
</div>
</div>
</section>
</div>
</div>
<!-- page end-->
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
mysql_free_result($ListaImagenesProductos);
?>
