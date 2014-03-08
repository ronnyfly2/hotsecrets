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
  $insertSQL = sprintf("INSERT INTO productos (nom_producto, url_seo_producto, precio_normal_producto, precio_oferta_producto, oferta_producto, resumen_producto, detalle_producto, img_producto, composiciones, video_producto, stock, estado_producto, id_subcategoria, fecha_reg_producto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
                       GetSQLValueString($_POST['nom_producto'], "text"),
                       GetSQLValueString($_POST['url_seo_producto'], "text"),
                       GetSQLValueString($_POST['precio_normal_producto'], "text"),
                       GetSQLValueString($_POST['precio_oferta_producto'], "text"),
                       GetSQLValueString(isset($_POST['oferta_producto']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['resumen_producto'], "text"),
                       GetSQLValueString($_POST['detalle_producto'], "text"),
                       GetSQLValueString($_POST['img_producto'], "text"),
					   GetSQLValueString($_POST['composiciones'], "text"),
					   GetSQLValueString($_POST['video_producto'], "text"),
                       GetSQLValueString($_POST['stock'], "int"),
                       GetSQLValueString(isset($_POST['estado_producto']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_subcategoria'], "int"));

  mysql_select_db($database_HotSecrets, $HotSecrets);
  $Result1 = mysql_query($insertSQL, $HotSecrets) or die(mysql_error());

  $insertGoTo = "lista-productos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_SubCategorias = "SELECT * FROM subcategorias ORDER BY subcategorias.nom_subcat ASC";
$SubCategorias = mysql_query($query_SubCategorias, $HotSecrets) or die(mysql_error());
$row_SubCategorias = mysql_fetch_assoc($SubCategorias);
$totalRows_SubCategorias = mysql_num_rows($SubCategorias);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Agregar Producto</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="css/font-awesome.css" rel="stylesheet" />


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<script src="js/jquery.js"></script>
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
     <?php include("xtructura/1-header.php"); ?>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <?php include("xtructura/2-menu-agregar-producto.php"); ?>
      <!--sidebar end-->
      <!--main content start-->
<section id="main-content">
<section class="wrapper">
<!-- page start-->
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
Inline form
</header>
</section>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-body">
<form class="form-horizontal tasi-form" method="post" name="form1" action="<?php echo $editFormAction; ?>">

<script type="text/javascript" src="js/jquery.stringToSlug.js"></script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="nom_producto">Nombre De Producto</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="nom_producto" id="producto" placeholder="Nombre del Producto">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="url_seo_producto">Url SEO</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="url_seo_producto" id="url" placeholder="Url SEO">
</div>
</div>

<script>
$(document).ready( function() {
$("#producto").stringToSlug({
setEvents: 'keyup keydown blur',
getPut: '#url',
space: '-'
});
});
</script>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="oferta_producto">¿Es una Oferta?</label>
<div class="input-group col-lg-2">
<input type="checkbox" name="oferta_producto" value="" data-toggle="switch" />
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="precio_normal_producto">Precio Normal</label>
<div class="input-group col-lg-2">
<span class="input-group-addon">S/.</span>
<input type="text" class="form-control" name="precio_normal_producto">
<span class="input-group-addon">.00</span>
</div> 
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="precio_oferta_producto">Precio Oferta</label>
<div class="input-group col-lg-2">
<span class="input-group-addon">S/.</span>
<input type="text" class="form-control" name="precio_oferta_producto">
<span class="input-group-addon">.00</span>
</div> 
</div>


<script> 
function subirpeque()
{
self.name = 'opener';
remote = open('subir-imagen-producto.php', 'remote', 'width=400,height=162,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
remote.focus();
}
</script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="img_producto">Imagen del Producto</label>
<div class="col-md-4 input-group">
<input type="text" class="form-control" name="img_producto" placeholder="Imagen del producto">
<div class="input-group-btn">
<button type="button" class="btn btn-info date-set" onClick="javascript:subirpeque();">Subir Imagen</button>
</div>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="resumen_producto">Resumen de Producto</label>
<div class="col-lg-4">
<textarea class="form-control" cols="55" rows="4" name="resumen_producto" placeholder="Resumen"></textarea>
</div>
</div>

<script src="ckeditor.js"></script>
<style>
.cke_focused,
.cke_editable.cke_focused
{
outline: 3px dotted blue !important;
*border: 3px dotted blue !important;	/* For IE7 */
}
</style>
<script>
CKEDITOR.replace( 'textarea_id', {
	uiColor: '#14B8C4'
});
</script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="detalle_producto">Detalle Del Producto</label>
<div class="col-lg-4">
<textarea class="ckeditor" cols="30" name="detalle_producto" id="textarea_id" rows="10"></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="detalle_producto">Compisicion del Producto</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="composiciones" placeholder="nylon, etc">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="detalle_producto">Insertar Video</label>
<div class="col-lg-4">
<textarea cols="55" rows="4" name="video_producto" class="form-control" placeholder="<iframe width='70%' height='100%' src='//www.youtube.com/embed/-wOnaoq1AYE' frameborder='0' allowfullscreen></iframe>"></textarea>
</div>
</div>
    
                           
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="id_subcategoria">Pertenece a la Subcategoria</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="id_subcategoria">
<?php do { ?>
<option value="<?php echo $row_SubCategorias['id_subcategoria']?>">
<?php echo $row_SubCategorias['nom_subcat']?>
</option>
<?php } while ($row_SubCategorias = mysql_fetch_assoc($SubCategorias));
$rows = mysql_num_rows($SubCategorias);
if($rows > 0) {
mysql_data_seek($SubCategorias, 0);
$row_SubCategorias = mysql_fetch_assoc($SubCategorias);
} ?>
</select>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="estado_producto">¿El producto Está Activo?</label>
<div class="input-group col-lg-2">
<input type="checkbox" name="estado_producto" value="" data-toggle="switch" />
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="stock">Stock</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="stock">
<option value="1">
En Stock
</option>
<option value="0">
No hay Stock
</option>
</select>
</div>
</div>

<div class="col-lg-4">
<button type="submit" class="btn btn-success">Insertar Producto</button>
<input type="hidden" name="MM_insert" value="form1">
</div>
</form>
</div>

</div>
</div>
<!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->
<?php include("xtructura/7-footer.php"); ?> 
<!--footer end-->
</section>
 <!-- js placed at the end of the document so the pages load faster -->    
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

<!--custom switch-->
<script src="js/bootstrap-switch.js"></script>
<!--custom tagsinput-->
<script src="js/jquery.tagsinput.js"></script>
<!--custom checkbox & radio--> 


<script type="text/javascript" src="js/bootstrap-inputmask.min.js"></script>
<script src="js/respond.min.js" ></script>
<!--common script for all pages-->
<script src="js/common-scripts.js"></script>
<!--script for this page-->
<script src="js/form-component.js"></script>
</body>
</html>
<?php mysql_free_result($SubCategorias);?>