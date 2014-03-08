<?php require_once('Connections/HotSecrets.php');
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
$maxRows_TodSubCat = 12;
$pageNum_TodSubCat = 0;

if (isset($_GET['pagina'])) {
  $pageNum_TodSubCat = $_GET['pagina'];
}

$startRow_TodSubCat = $pageNum_TodSubCat * $maxRows_TodSubCat;

$_GET["subcat"] = ObtenerUrlSEOSub($_GET["subcat"]);
$VarCate_TodSubCat = "0";
if (isset($_GET["subcat"])) {
  $VarCate_TodSubCat = $_GET["subcat"];
}

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_TodSubCat = sprintf("SELECT * FROM productos WHERE productos.estado_producto = 1 AND productos.id_subcategoria= %s ORDER BY productos.id_producto DESC", GetSQLValueString($VarCate_TodSubCat, "int"));
$query_limit_TodSubCat = sprintf("%s LIMIT %d, %d", $query_TodSubCat, $startRow_TodSubCat, $maxRows_TodSubCat);
$TodSubCat = mysql_query($query_limit_TodSubCat, $HotSecrets) or die(mysql_error());
$row_TodSubCat = mysql_fetch_assoc($TodSubCat);

if (isset($_GET['totalRows_TodSubCat'])) {
  $totalRows_TodSubCat  = $_GET['totalRows_TodSubCat'];
} else {
  $all_TodSubCat = mysql_query($query_TodSubCat);
  $totalRows_TodSubCat = mysql_num_rows($all_TodSubCat);
}
$totalPages_TodSubCat = ceil($totalRows_TodSubCat/$maxRows_TodSubCat)-1;

$currentPage  = $_SERVER["PHP_SELF"];

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
<?php include("extructura-hot/2-contenido-sub-categorias.php"); ?> 
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
mysql_free_result($TodSubCat);
?>