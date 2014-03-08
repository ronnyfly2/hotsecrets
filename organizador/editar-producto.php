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

$VarEdiProd_EdProducto = "0";
if (isset($_GET["editarprod"])) {
  $VarEdiProd_EdProducto = $_GET["editarprod"];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_EdProducto = sprintf("SELECT * FROM productos WHERE productos.id_producto = %s", GetSQLValueString($VarEdiProd_EdProducto, "int"));
$EdProducto = mysql_query($query_EdProducto, $HotSecrets) or die(mysql_error());
$row_EdProducto = mysql_fetch_assoc($EdProducto);
$totalRows_EdProducto = mysql_num_rows($EdProducto);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_SubCategorias = "SELECT * FROM subcategorias ORDER BY subcategorias.nom_subcat ASC";
$SubCategorias = mysql_query($query_SubCategorias, $HotSecrets) or die(mysql_error());
$row_SubCategorias = mysql_fetch_assoc($SubCategorias);
$totalRows_SubCategorias = mysql_num_rows($SubCategorias);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE productos SET nom_producto=%s, url_seo_producto=%s, precio_normal_producto=%s, precio_oferta_producto=%s, oferta_producto=%s, resumen_producto=%s, detalle_producto=%s, img_producto=%s, composiciones=%s, video_producto=%s, stock=%s, estado_producto=%s, id_subcategoria=%s, fecha_act_producto=%s WHERE id_producto=%s",
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
                       GetSQLValueString($_POST['id_subcategoria'], "int"),
                       GetSQLValueString($_POST['fecha_act_producto'], "date"),
                       GetSQLValueString($_POST['id_producto'], "int"));

  mysql_select_db($database_HotSecrets, $HotSecrets);
  $Result1 = mysql_query($updateSQL, $HotSecrets) or die(mysql_error());

  $updateGoTo = "lista-productos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
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

    <title>Form Component</title>

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
      <?php include("xtructura/2-menu-lista-productos.php"); ?>
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
<form class="form-horizontal tasi-form" method="post" name="form2" action="<?php echo $editFormAction; ?>">

<script type="text/javascript" src="js/jquery.stringToSlug.js"></script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="nom_producto">Nombre De Producto</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="nom_producto" id="producto" placeholder="Nombre del Producto" value="<?php echo htmlentities($row_EdProducto['nom_producto'], ENT_COMPAT, 'utf-8'); ?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="url_seo_producto">Url SEO</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="url_seo_producto" id="url" placeholder="Url SEO" value="<?php echo htmlentities($row_EdProducto['url_seo_producto'], ENT_COMPAT, 'utf-8'); ?>">
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
<input type="checkbox" name="oferta_producto" value="<?php echo htmlentities($row_EdProducto['oferta_producto'], ENT_COMPAT, ''); ?>" <?php if (!(strcmp($row_EdProducto['oferta_producto'],1))) {echo "checked=\"checked\"";} ?> data-toggle="switch" />
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="precio_normal_producto">Precio Normal</label>
<div class="input-group col-lg-2">
<span class="input-group-addon">S/.</span>
<input type="text" class="form-control" name="precio_normal_producto" value="<?php echo htmlentities($row_EdProducto['precio_normal_producto'], ENT_COMPAT, 'utf-8'); ?>">
<span class="input-group-addon">.00</span>
</div> 
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="precio_oferta_producto">Precio Oferta</label>
<div class="input-group col-lg-2">
<span class="input-group-addon">S/.</span>
<input type="text" class="form-control" name="precio_oferta_producto" value="<?php echo htmlentities($row_EdProducto['precio_oferta_producto'], ENT_COMPAT, 'utf-8'); ?>">
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
<input type="text" class="form-control" name="img_producto" placeholder="Imagen del producto" value="<?php echo htmlentities($row_EdProducto['img_producto'], ENT_COMPAT, 'utf-8'); ?>">
<div class="input-group-btn">
<button type="button" class="btn btn-info date-set" onClick="javascript:subirpeque();">Subir Imagen</button>
</div>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="resumen_producto">Resumen de Producto</label>
<div class="col-lg-4">
<textarea class="form-control" cols="55" rows="4" name="resumen_producto" placeholder="Resumen"><?php echo htmlentities($row_EdProducto['resumen_producto'], ENT_COMPAT, 'utf-8'); ?></textarea>
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
<textarea class="ckeditor" cols="30" name="detalle_producto" id="textarea_id" rows="10"><?php echo htmlentities($row_EdProducto['detalle_producto'], ENT_COMPAT, 'utf-8'); ?></textarea>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="detalle_producto">Compisicion del Producto</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="composiciones" placeholder="nylon, etc" value="<?php echo htmlentities($row_EdProducto['composiciones'], ENT_COMPAT, 'utf-8'); ?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="detalle_producto">Insertar Video</label>
<div class="col-lg-4">
<textarea cols="55" rows="4" name="video_producto" class="form-control" placeholder="<iframe width='70%' height='100%' src='//www.youtube.com/embed/-wOnaoq1AYE' frameborder='0' allowfullscreen></iframe>"><?php echo htmlentities($row_EdProducto['video_producto'], ENT_COMPAT, 'utf-8'); ?></textarea>
</div>
</div>
    
                           
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="id_subcategoria">Pertenece a la Subcategoria</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="id_subcategoria">
<?php do { ?>
<option value="<?php echo $row_SubCategorias['id_subcategoria']?>" <?php if (!(strcmp($row_SubCategorias['id_subcategoria'], htmlentities($row_EdProducto['id_subcategoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>
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
<input type="checkbox" name="estado_producto" value="<?php echo htmlentities($row_EdProducto['oferta_producto'], ENT_COMPAT, ''); ?>" <?php if (!(strcmp($row_EdProducto['estado_producto'],1))) {echo "checked=\"checked\"";} ?> data-toggle="switch">
</div>
</div>




<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="stock">Stock</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="stock">
<option value="0" <?php if (!(strcmp(0, htmlentities($row_EdProducto['stock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>No Hay Stock</option>
<option value="1" <?php if (!(strcmp(1, htmlentities($row_EdProducto['stock'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>En Stock</option>
</select>
</div>
</div>

<div class="col-lg-4">
<button type="submit" class="btn btn-success">Insertar Producto</button>
<input type="hidden" name="MM_update" value="form2">
<input type="hidden" name="id_producto" value="<?php echo $row_EdProducto['id_producto']; ?>">
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
<?php mysql_free_result($SubCategorias);

mysql_free_result($EdProducto);?>