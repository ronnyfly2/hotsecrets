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

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in organizador/agregar-producto.php");
    die("Error de conexión a la base de datos.");
}

$editFormAction = htmlspecialchars($_SERVER['PHP_SELF']);
// Note: Appending QUERY_STRING directly can be a security risk if not carefully managed.
// Consider rebuilding query string with expected parameters if necessary.
if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// Handle Product Insertion
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    // Validate and sanitize inputs
    $nom_producto = isset($_POST['nom_producto']) ? trim($_POST['nom_producto']) : '';
    $url_seo_producto = isset($_POST['url_seo_producto']) ? trim($_POST['url_seo_producto']) : '';
    $precio_normal_producto = isset($_POST['precio_normal_producto']) ? trim($_POST['precio_normal_producto']) : ''; // Validate as float/decimal
    $precio_oferta_producto = isset($_POST['precio_oferta_producto']) ? trim($_POST['precio_oferta_producto']) : null; // Validate as float/decimal, allow NULL
    $oferta_producto = isset($_POST['oferta_producto']) ? 1 : 0;
    $resumen_producto = isset($_POST['resumen_producto']) ? trim($_POST['resumen_producto']) : '';
    $detalle_producto = isset($_POST['detalle_producto']) ? trim($_POST['detalle_producto']) : ''; // CKEditor content, might need specific sanitization
    $img_producto = isset($_POST['img_producto']) ? trim($_POST['img_producto']) : ''; // Filename, specific validation needed
    $composiciones = isset($_POST['composiciones']) ? trim($_POST['composiciones']) : '';
    $video_producto = isset($_POST['video_producto']) ? trim($_POST['video_producto']) : ''; // iframe code, needs careful handling
    $stock = isset($_POST['stock']) ? filter_var($_POST['stock'], FILTER_VALIDATE_INT) : 0;
    $estado_producto = isset($_POST['estado_producto']) ? 1 : 0;
    $id_subcategoria = isset($_POST['id_subcategoria']) ? filter_var($_POST['id_subcategoria'], FILTER_VALIDATE_INT) : false;

    // Basic validation
    if (empty($nom_producto) || empty($url_seo_producto) || $id_subcategoria === false || $stock === false) {
        error_log("Required product fields are missing or invalid in organizador/agregar-producto.php.");
        // Handle error appropriately, e.g., set session error message and redirect back to form
        // For now, die with a message or redirect without specific error message.
        die("Error: Campos obligatorios del producto faltantes o inválidos.");
    }
    // Validate price fields (allow empty for oferta, but normal should be numeric)
    if (!is_numeric($precio_normal_producto) || ($precio_oferta_producto !== null && !empty($precio_oferta_producto) && !is_numeric($precio_oferta_producto))) {
        error_log("Invalid price format in organizador/agregar-producto.php.");
        die("Error: Formato de precio inválido.");
    }
    if ($precio_oferta_producto !== null && empty($precio_oferta_producto)) {
        $precio_oferta_producto = null; // Ensure empty string becomes NULL
    }


    $insertSQL = "INSERT INTO productos (nom_producto, url_seo_producto, precio_normal_producto, precio_oferta_producto, oferta_producto, resumen_producto, detalle_producto, img_producto, composiciones, video_producto, stock, estado_producto, id_subcategoria, fecha_reg_producto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt_insert = $HotSecrets->prepare($insertSQL);

    if ($stmt_insert === false) {
        error_log("Prepare failed (INSERT productos) in organizador/agregar-producto.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        die("Error al preparar la inserción del producto.");
    }

    // Types: s=string, d=double, i=integer
    $stmt_insert->bind_param("ssddisssssiii", 
        $nom_producto, $url_seo_producto, 
        $precio_normal_producto, $precio_oferta_producto, $oferta_producto,
        $resumen_producto, $detalle_producto, $img_producto, 
        $composiciones, $video_producto, 
        $stock, $estado_producto, $id_subcategoria
    );

    if ($stmt_insert->execute()) {
        $stmt_insert->close();
        $insertGoTo = "lista-productos.php";
        header(sprintf("Location: %s", $insertGoTo));
        exit;
    } else {
        error_log("Execute failed (INSERT productos) in organizador/agregar-producto.php: (" . $stmt_insert->errno . ") " . $stmt_insert->error);
        $stmt_insert->close();
        die("Error al insertar el producto.");
    }
}

// Fetch SubCategorias for the dropdown
$subcategorias_array = [];
$query_SubCategorias = "SELECT id_subcategoria, nom_subcat FROM subcategorias ORDER BY subcategorias.nom_subcat ASC";
$stmt_SubCategorias = $HotSecrets->prepare($query_SubCategorias);

if ($stmt_SubCategorias) {
    if ($stmt_SubCategorias->execute()) {
        $SubCategorias_result = $stmt_SubCategorias->get_result();
        while ($row = $SubCategorias_result->fetch_assoc()) {
            $subcategorias_array[] = $row;
        }
        if ($SubCategorias_result instanceof mysqli_result) {
            $SubCategorias_result->free();
        }
    } else {
        error_log("Execute failed (SELECT subcategorias) in organizador/agregar-producto.php: (" . $stmt_SubCategorias->errno . ") " . $stmt_SubCategorias->error);
    }
    $stmt_SubCategorias->close();
} else {
     error_log("Prepare failed (SELECT subcategorias) in organizador/agregar-producto.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
}
// $row_SubCategorias and $totalRows_SubCategorias are not directly used in the same way due to loop change.
// The $subcategorias_array will be used in the HTML.
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
Agregar Nuevo Producto
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
<input type="text" class="form-control" name="nom_producto" id="producto" placeholder="Nombre del Producto" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="url_seo_producto">Url SEO</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="url_seo_producto" id="url" placeholder="Url SEO" required>
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
<input type="checkbox" name="oferta_producto" value="1" data-toggle="switch" />
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="precio_normal_producto">Precio Normal</label>
<div class="input-group col-lg-2">
<span class="input-group-addon">S/.</span>
<input type="text" class="form-control" name="precio_normal_producto" placeholder="e.g., 25.90" required pattern="^\d+(\.\d{1,2})?$">
<span class="input-group-addon">.00</span>
</div> 
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="precio_oferta_producto">Precio Oferta</label>
<div class="input-group col-lg-2">
<span class="input-group-addon">S/.</span>
<input type="text" class="form-control" name="precio_oferta_producto" placeholder="e.g., 19.90 (opcional)" pattern="^\d+(\.\d{1,2})?$">
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
<label class="col-sm-2 control-label col-lg-2" for="composiciones">Composición del Producto</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="composiciones" placeholder="nylon, etc">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="video_producto">Insertar Video</label>
<div class="col-lg-4">
<textarea cols="55" rows="4" name="video_producto" class="form-control" placeholder="<iframe width='70%' height='100%' src='//www.youtube.com/embed/-wOnaoq1AYE' frameborder='0' allowfullscreen></iframe>"></textarea>
</div>
</div>
    
                           
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="id_subcategoria">Pertenece a la Subcategoria</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="id_subcategoria" required>
<option value="">-- Seleccione Subcategoría --</option>
<?php 
if (!empty($subcategorias_array)) {
    foreach ($subcategorias_array as $subcat) { ?>
<option value="<?php echo htmlspecialchars($subcat['id_subcategoria']); ?>">
<?php echo htmlspecialchars($subcat['nom_subcat']); ?>
</option>
<?php 
    }
}?>
</select>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="estado_producto">¿El producto Está Activo?</label>
<div class="input-group col-lg-2">
<input type="checkbox" name="estado_producto" value="1" data-toggle="switch" checked />
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="stock">Stock</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="stock" required>
<option value="1">En Stock</option>
<option value="0">No hay Stock</option>
</select>
</div>
</div>

<div class="col-lg-offset-2 col-lg-4">
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
<?php 
// mysql_free_result($SubCategorias); // This was freed by the new logic if $SubCategorias_result was created
?>