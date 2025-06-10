<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// The ObtenerUrlSEOCategoria function is also from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in categorias.php");
    die("Error de conexión a la base de datos.");
}

$maxRows_TodSubCat = 12;
$pageNum_TodSubCat = 0;

if (isset($_GET['pagina'])) {
  // It's good practice to validate or sanitize page number input
  $pageNum_TodSubCat = filter_var($_GET['pagina'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
  if ($pageNum_TodSubCat === false) {
      $pageNum_TodSubCat = 0; // Default to page 0 if validation fails
  }
}

$startRow_TodSubCat = $pageNum_TodSubCat * $maxRows_TodSubCat;

// Call ObtenerUrlSEOCategoria with $HotSecrets
// Ensure $_GET["cate"] is set and sanitized before use
$VarCate_TodSubCat = "0"; // Default value
if (isset($_GET["cate"])) {
    // Sanitize $_GET["cate"] before passing to the function if it's used in a query directly
    // However, ObtenerUrlSEOCategoria should handle its own sanitization/preparation
    $url_seo_categoria = $_GET["cate"]; // Consider sanitizing this if it's directly from user input and not yet processed
    $id_categoria_from_seo = ObtenerUrlSEOCategoria($HotSecrets, $url_seo_categoria);
    if ($id_categoria_from_seo !== null && filter_var($id_categoria_from_seo, FILTER_VALIDATE_INT)) {
        $VarCate_TodSubCat = $id_categoria_from_seo;
    } else if ($id_categoria_from_seo === null && isset($_GET["cate"]) && filter_var($_GET["cate"], FILTER_VALIDATE_INT)) {
        // Fallback if SEO URL lookup fails but a valid integer ID might have been passed
        $VarCate_TodSubCat = $_GET["cate"];
    }
}


$query_TodSubCat = "SELECT * FROM subcategorias WHERE subcategorias.id_categoria = ? AND subcategorias.estado = 1";
// For pagination, you would typically add: " LIMIT ?, ?" to the query
// And bind $startRow_TodSubCat and $maxRows_TodSubCat as parameters.
// However, the original code fetches all rows and then implies pagination might be handled in included files or client-side.
// For now, I will replicate the existing logic of fetching all relevant subcategories.

$stmt = $HotSecrets->prepare($query_TodSubCat);
if ($stmt === false) {
    error_log("Prepare failed (TodSubCat) in categorias.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la consulta de subcategorías.");
}

$stmt->bind_param("i", $VarCate_TodSubCat);

if (!$stmt->execute()) {
    error_log("Execute failed (TodSubCat) in categorias.php: (" . $stmt->errno . ") " . $stmt->error);
    $stmt->close();
    die("Error al ejecutar la consulta de subcategorías.");
}

$TodSubCat_result = $stmt->get_result();
// $row_TodSubCat = $TodSubCat_result->fetch_assoc(); // This would fetch only the first row. Iteration happens in the included file.
$totalRows_TodSubCat = $TodSubCat_result->num_rows;

$currentPage  = htmlspecialchars($_SERVER["PHP_SELF"]); // Sanitize server variable

$queryString_TodSubCat = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
 if (stristr($param, "pagina") == false && 
        stristr($param, "de") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_TodSubCat = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_TodSubCat = sprintf("&de=%d%s", $totalRows_TodSubCat, $queryString_TodSubCat);
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/1-head-lista-productos.php"); ?>

</head>

<body class="catalog-category-view">
<div class="ma-wrapper">
<noscript>
<div class="global-site-notice noscript">
<div class="notice-inner">
<p>
<strong>Parece que su navegador tiene desactivado JavaScript.</strong><br />
Usted debe tener Javascript activado en tu navegador para utilizar la funcionalidad de este sitio web.</p>
</div>
</div>
</noscript>
<div class="ma-page">
<?php include("extructura-hot/1-header.php"); ?>
<div class="ma-main-container col2-right-layout">
<div class="container">
<div class="main">
<div class="main-inner">

<div class="row-fluid">
<div class="col-main span9">
<div class="page-title category-title">

<h1>Todos Nuestros Productos de HotSecrets Perú | Lenceria ropa atrevida</h1>
</div>
<p class="category-image" style="margin-bottom:25px;">
<img src="imagenes/todos-nuestros-productos-lenceria.png" alt="Lenceria ropa atrevida" title="Lenceria ropa atrevida" />
</p>

<div class="category-products">
<?php include("extructura-hot/2-contenido-categorias.php"); ?> 
</div>
</div>


<?php include("extructura-hot/3-productos-aside.php"); ?> 



</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>
</div>
</div>
</div>
</body>
</html>
<?php
if (isset($TodSubCat_result)) {
    $TodSubCat_result->free();
}
if (isset($stmt)) {
    $stmt->close();
}
?>