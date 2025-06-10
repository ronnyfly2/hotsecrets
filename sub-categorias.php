<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// The ObtenerUrlSEOSub function is also from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in sub-categorias.php");
    die("Error de conexión a la base de datos.");
}

$maxRows_TodSubCat = 12;
$pageNum_TodSubCat = 0;

if (isset($_GET['pagina'])) {
  $pageNum_TodSubCat = filter_var($_GET['pagina'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
  if ($pageNum_TodSubCat === false) {
      $pageNum_TodSubCat = 0;
  }
}

$startRow_TodSubCat = $pageNum_TodSubCat * $maxRows_TodSubCat;

$VarCate_TodSubCat = "0"; // Default value
if (isset($_GET["subcat"])) {
    $id_subcategoria_from_seo = ObtenerUrlSEOSub($HotSecrets, $_GET["subcat"]);
    if ($id_subcategoria_from_seo !== null && filter_var($id_subcategoria_from_seo, FILTER_VALIDATE_INT)) {
        $VarCate_TodSubCat = $id_subcategoria_from_seo;
    } elseif (filter_var($_GET["subcat"], FILTER_VALIDATE_INT)) {
        $VarCate_TodSubCat = $_GET["subcat"];
    } else {
        error_log("Invalid subcategory identifier in sub-categorias.php: " . $_GET["subcat"]);
        die("Subcategoría no encontrada.");
    }
} else {
     die("Subcategoría no especificada.");
}

// Query to get total rows for pagination
$totalRows_TodSubCat = 0;
if (isset($_GET['totalRows_TodSubCat']) && filter_var($_GET['totalRows_TodSubCat'], FILTER_VALIDATE_INT) !== false) {
  $totalRows_TodSubCat  = $_GET['totalRows_TodSubCat'];
} else {
  $query_count_TodSubCat = "SELECT COUNT(*) AS total FROM productos WHERE productos.estado_producto = 1 AND productos.id_subcategoria = ?";
  $stmt_count = $HotSecrets->prepare($query_count_TodSubCat);
  if ($stmt_count) {
    $stmt_count->bind_param("i", $VarCate_TodSubCat);
    if ($stmt_count->execute()) {
      $count_result = $stmt_count->get_result();
      if ($row_count = $count_result->fetch_assoc()) {
        $totalRows_TodSubCat = $row_count['total'];
      }
      $count_result->free();
    } else {
      error_log("Execute failed (count TodSubCat) in sub-categorias.php: (" . $stmt_count->errno . ") " . $stmt_count->error);
    }
    $stmt_count->close();
  } else {
    error_log("Prepare failed (count TodSubCat) in sub-categorias.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
  }
}
$totalPages_TodSubCat = ceil($totalRows_TodSubCat/$maxRows_TodSubCat)-1;


// Query for current page data
$query_TodSubCat = "SELECT * FROM productos WHERE productos.estado_producto = 1 AND productos.id_subcategoria = ? ORDER BY productos.id_producto DESC LIMIT ?, ?";
$stmt = $HotSecrets->prepare($query_TodSubCat);
if ($stmt === false) {
    error_log("Prepare failed (TodSubCat data) in sub-categorias.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la consulta de productos.");
}

$stmt->bind_param("iii", $VarCate_TodSubCat, $startRow_TodSubCat, $maxRows_TodSubCat);

$TodSubCat_result = null;
if (!$stmt->execute()) {
    error_log("Execute failed (TodSubCat data) in sub-categorias.php: (" . $stmt->errno . ") " . $stmt->error);
    // $row_TodSubCat will remain null or not set, and the include will handle empty data.
} else {
    $TodSubCat_result = $stmt->get_result();
    // $row_TodSubCat = $TodSubCat_result->fetch_assoc(); // Fetching is done in the included file
}
// Note: $TodSubCat (original mysqli_result) is now $TodSubCat_result.
// The included file extructura-hot/2-contenido-sub-categorias.php will need to use $TodSubCat_result.

$currentPage  = htmlspecialchars($_SERVER["PHP_SELF"]);

$queryString_TodSubCat = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    // Ensure parameter is not empty and not 'pagina' or 'de'
    if (trim($param) !== '' && stristr($param, "pagina") === false && stristr($param, "de") === false) {
      // Sanitize parameter before adding to newParams
      // This is a basic example; a more robust sanitization might be needed depending on expected params
      array_push($newParams, htmlentities($param));
    }
  }
  if (count($newParams) != 0) {
    $queryString_TodSubCat = "&" . implode("&", $newParams);
  }
}
// No need to add $totalRows_TodSubCat to query string if it's recalculated each time.
// If $_GET['totalRows_TodSubCat'] is used, it's already part of QUERY_STRING.
// The sprintf for de=%d%s seems to be Dreamweaver specific for recordset navigation,
// which is handled differently now.
// $queryString_TodSubCat = sprintf("&de=%d%s", $totalRows_TodSubCat, $queryString_TodSubCat); // This line can likely be removed or re-evaluated.

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
<?php 
// Pass $TodSubCat_result to the included file.
// The included file will iterate over $TodSubCat_result->fetch_assoc()
// Make sure extructura-hot/2-contenido-sub-categorias.php is updated to use $TodSubCat_result
// Example: while ($row_TodSubCat = $TodSubCat_result->fetch_assoc()) { ... }
include("extructura-hot/2-contenido-sub-categorias.php"); 
?> 
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
if (isset($TodSubCat_result) && $TodSubCat_result instanceof mysqli_result) {
    $TodSubCat_result->free();
}
if (isset($stmt) && $stmt instanceof mysqli_stmt) {
    $stmt->close();
}
?>