<?php require_once('../Connections/HotSecrets.php'); ?>
<?php
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which should be included by Connections/HotSecrets.php (if HotSecrets.php includes funcionalities/funciones-hot.php)
// However, for prepared statements, direct binding is preferred over GetSQLValueString.

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in organizador/agregar-categoria.php");
    die("Error de conexión a la base de datos.");
}

$editFormAction = htmlspecialchars($_SERVER['PHP_SELF']); // Sanitize self URL
if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
  // It's generally safer to rebuild the query string with expected parameters
  // than to append htmlentities($_SERVER['QUERY_STRING']) directly.
  // For this example, we keep it simple, but be aware of potential XSS if $editFormAction is used insecurely later.
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  // Validate and sanitize inputs
  $nom_cate = isset($_POST['nom_cate']) ? trim($_POST['nom_cate']) : '';
  $urlseo = isset($_POST['urlseo']) ? trim($_POST['urlseo']) : '';
  $desc_cate = isset($_POST['desc_cate']) ? trim($_POST['desc_cate']) : '';
  $img_cate = isset($_POST['img_cate']) ? trim($_POST['img_cate']) : ''; // Assuming path or filename, further validation might be needed
  $estado_categoria = isset($_POST['estado_categoria']) ? filter_var($_POST['estado_categoria'], FILTER_VALIDATE_INT) : 0;

  if ($estado_categoria === false) { // Check if filter_var failed
      error_log("Invalid estado_categoria in organizador/agregar-categoria.php: " . $_POST['estado_categoria']);
      // Handle error, perhaps redirect with message or set a default
      $estado_categoria = 0; // Default to inactive if invalid
  }
  
  // Basic validation: ensure required fields are not empty
  if (empty($nom_cate) || empty($urlseo)) {
      // Handle error: redirect back with message or display error on page
      // For simplicity, we'll just log and not insert.
      error_log("Required fields (nom_cate or urlseo) are empty in organizador/agregar-categoria.php.");
      // Optionally, set an error message to display to the user
      // $_SESSION['form_error'] = "Nombre de categoría y URL SEO son obligatorios.";
      // header("Location: " . $editFormAction); // Redirect back to the form
      // exit;
  } else {
      $insertSQL = "INSERT INTO categorias (nom_cate, urlseo, desc_cate, img_cate, estado_categoria) VALUES (?, ?, ?, ?, ?)";
      $stmt = $HotSecrets->prepare($insertSQL);

      if ($stmt === false) {
          error_log("Prepare failed (INSERT categorias) in organizador/agregar-categoria.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
          die("Error al preparar la inserción de categoría."); // User-friendly message
      }

      $stmt->bind_param("ssssi", $nom_cate, $urlseo, $desc_cate, $img_cate, $estado_categoria);

      if ($stmt->execute()) {
          $stmt->close();
          $insertGoTo = "lista-categorias.php";
          // Avoid appending user-supplied QUERY_STRING directly to redirect URL for security.
          // If specific parameters are needed, add them explicitly.
          header(sprintf("Location: %s", $insertGoTo));
          exit;
      } else {
          error_log("Execute failed (INSERT categorias) in organizador/agregar-categoria.php: (" . $stmt->errno . ") " . $stmt->error);
          $stmt->close();
          die("Error al insertar la categoría."); // User-friendly message
      }
  }
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
<form class="form-horizontal tasi-form" method="post" name="form2" action="<?php echo $editFormAction; ?>">

<script type="text/javascript" src="js/jquery.stringToSlug.js"></script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="nom_cate">Nombre De Categoria</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="nom_cate" id="categoria" placeholder="Nombre del Categoria">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="urlseo">Url SEO</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="urlseo" id="url" placeholder="Url SEO">
</div>
</div>

<script>
$(document).ready( function() {
$("#categoria").stringToSlug({
setEvents: 'keyup keydown blur',
getPut: '#url',
space: '-'
});
});
</script>

<script> 
function subirpeque()
{
self.name = 'opener';
remote = open('subir-imagen-categoria.php', 'remote', 'width=400,height=162,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
remote.focus();
}
</script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="img_cate">Imagen</label>
<div class="col-md-4 input-group">
<input type="text" class="form-control" name="img_cate" placeholder="Imagen">
<div class="input-group-btn">
<button type="button" class="btn btn-info date-set" onClick="javascript:subirpeque();">Subir Imagen</button>
</div>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="desc_cate">Descripcion de la Categoria</label>
<div class="col-lg-4">
<textarea class="form-control" cols="55" rows="4" name="desc_cate" placeholder="Descripcion de la Categoria"></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="estado_categoria">¿El producto Está Activo?</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="estado_categoria">
<option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Activo</option>
<option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Inactivo</option>
</select>
</div>
</div>

<div class="col-lg-4">
<button type="submit" class="btn btn-success">Insertar Categoria</button>
<input type="hidden" name="MM_insert" value="form2">
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