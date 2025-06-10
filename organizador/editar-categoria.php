<?php require_once('../Connections/HotSecrets.php'); ?>
<?php
// GetSQLValueString is deprecated. Prepared statements will be used.

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in organizador/editar-categoria.php");
    die("Error de conexión a la base de datos.");
}

$editFormAction = htmlspecialchars($_SERVER['PHP_SELF']); // Sanitize self URL

// Handle the UPDATE operation first if form was submitted
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    // Validate and sanitize inputs
    $id_categoria = isset($_POST['id_categoria']) ? filter_var($_POST['id_categoria'], FILTER_VALIDATE_INT) : false;
    $nom_cate = isset($_POST['nom_cate']) ? trim($_POST['nom_cate']) : '';
    $urlseo = isset($_POST['urlseo']) ? trim($_POST['urlseo']) : '';
    $desc_cate = isset($_POST['desc_cate']) ? trim($_POST['desc_cate']) : '';
    $img_cate = isset($_POST['img_cate']) ? trim($_POST['img_cate']) : '';
    $estado_categoria = isset($_POST['estado_categoria']) ? filter_var($_POST['estado_categoria'], FILTER_VALIDATE_INT) : null;

    if ($id_categoria === false) {
        error_log("Invalid id_categoria for update in organizador/editar-categoria.php.");
        die("ID de categoría inválido para actualizar.");
    }
    if ($estado_categoria === null) { // filter_var could return 0 which is valid
        error_log("Invalid estado_categoria for update in organizador/editar-categoria.php: " . $_POST['estado_categoria']);
        die("Estado de categoría inválido.");
    }
     if (empty($nom_cate) || empty($urlseo)) {
        error_log("Required fields (nom_cate or urlseo) are empty for update in organizador/editar-categoria.php.");
        die("Nombre de categoría y URL SEO son obligatorios.");
    }


    $updateSQL = "UPDATE categorias SET nom_cate=?, urlseo=?, desc_cate=?, img_cate=?, estado_categoria=? WHERE id_categoria=?";
    $stmt_update = $HotSecrets->prepare($updateSQL);

    if ($stmt_update === false) {
        error_log("Prepare failed (UPDATE categorias) in organizador/editar-categoria.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        die("Error al preparar la actualización de categoría.");
    }

    $stmt_update->bind_param("ssssii", $nom_cate, $urlseo, $desc_cate, $img_cate, $estado_categoria, $id_categoria);

    if ($stmt_update->execute()) {
        $stmt_update->close();
        // Preserve essential query string parameters if any, or redirect cleanly
        $updateGoTo = "lista-categorias.php"; // Consider adding success message
        header(sprintf("Location: %s", $updateGoTo));
        exit;
    } else {
        error_log("Execute failed (UPDATE categorias) in organizador/editar-categoria.php: (" . $stmt_update->errno . ") " . $stmt_update->error);
        $stmt_update->close();
        die("Error al actualizar la categoría.");
    }
}

// Populate form: SELECT query
$row_Categorias = null;
$totalRows_Categorias = 0;
$VarCate_Categorias = null;

if (isset($_GET["editar"])) {
    if (filter_var($_GET["editar"], FILTER_VALIDATE_INT) !== false) {
        $VarCate_Categorias = (int)$_GET["editar"];
    } else {
        error_log("Invalid category ID for editing in organizador/editar-categoria.php: " . $_GET["editar"]);
        die("ID de categoría para editar es inválido.");
    }
} else {
    // If no 'editar' GET param, redirect or show error, as we need an ID to edit
    error_log("Missing category ID for editing in organizador/editar-categoria.php.");
    header("Location: lista-categorias.php?error=missing_id_for_edit");
    exit;
}

if ($VarCate_Categorias !== null) {
    $query_Categorias = "SELECT * FROM categorias WHERE categorias.id_categoria = ?";
    $stmt_select = $HotSecrets->prepare($query_Categorias);

    if ($stmt_select) {
        $stmt_select->bind_param("i", $VarCate_Categorias);
        if ($stmt_select->execute()) {
            $Categorias_result = $stmt_select->get_result();
            $row_Categorias = $Categorias_result->fetch_assoc();
            $totalRows_Categorias = $Categorias_result->num_rows;
            if ($totalRows_Categorias == 0) {
                // Category not found, redirect or show error
                error_log("Category not found for ID: " . $VarCate_Categorias . " in organizador/editar-categoria.php");
                header("Location: lista-categorias.php?error=category_not_found");
                exit;
            }
            if ($Categorias_result instanceof mysqli_result) {
                $Categorias_result->free();
            }
        } else {
            error_log("Execute failed (SELECT categoria) in organizador/editar-categoria.php: (" . $stmt_select->errno . ") " . $stmt_select->error);
            die("Error al obtener datos de la categoría.");
        }
        $stmt_select->close();
    } else {
        error_log("Prepare failed (SELECT categoria) in organizador/editar-categoria.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
        die("Error al preparar la consulta de categoría.");
    }
}

// Rebuild $editFormAction to include the 'editar' parameter cleanly for the form action
if ($VarCate_Categorias !== null) {
    $editFormAction = htmlspecialchars($_SERVER['PHP_SELF']) . "?editar=" . $VarCate_Categorias;
} else {
    // Fallback if $VarCate_Categorias somehow became null after checks, though unlikely here
    $editFormAction = htmlspecialchars($_SERVER['PHP_SELF']);
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

    <title>Editar Categoria</title>

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
Editar Categoría
</header>
</section>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-body">
<?php if ($row_Categorias): // Check if category data was fetched ?>
<form class="form-horizontal tasi-form" method="post" name="form1" action="<?php echo $editFormAction; ?>">

<script type="text/javascript" src="js/jquery.stringToSlug.js"></script>
<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="nom_cate">Nombre De Categoria</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="nom_cate" id="categoria" value="<?php echo htmlspecialchars($row_Categorias['nom_cate']); ?>" placeholder="Nombre del Categoria">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="urlseo">Url SEO</label>
<div class="col-lg-4">
<input type="text" class="form-control" name="urlseo" id="url" value="<?php echo htmlspecialchars($row_Categorias['urlseo']); ?>" placeholder="Url SEO">
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
<input type="text" class="form-control" value="<?php echo htmlspecialchars($row_Categorias['img_cate']); ?>" name="img_cate" placeholder="Imagen">
<div class="input-group-btn">
<button type="button" class="btn btn-info date-set" onClick="javascript:subirpeque();">Subir Imagen</button>
</div>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="desc_cate">Descripcion de la Categoria</label>
<div class="col-lg-4">
<textarea class="form-control" cols="55" rows="4" name="desc_cate" placeholder="Descripcion de la Categoria"><?php echo htmlspecialchars($row_Categorias['desc_cate']); ?></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label col-lg-2" for="estado_categoria">¿El producto Está Activo?</label>
<div class="col-lg-4">
<select class="form-control m-bot15" name="estado_categoria">
<option value="1" <?php if ($row_Categorias['estado_categoria'] == 1) {echo "SELECTED";} ?>>Activo</option>
<option value="0" <?php if ($row_Categorias['estado_categoria'] == 0) {echo "SELECTED";} ?>>Inactivo</option>
</select>
</div>
</div>

<div class="col-lg-offset-2 col-lg-4">
<button type="submit" class="btn btn-success">Actualizar Categoria</button>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_categoria" value="<?php echo htmlspecialchars($row_Categorias['id_categoria']); ?>">
</div>
</form>
<?php else: ?>
<p>No se encontró la categoría para editar o hubo un error.</p>
<?php endif; ?>
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
// mysql_free_result($Categorias); // Already freed if result object was created
?>
