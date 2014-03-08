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
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/1-head-index.php"); ?>
</head>

<body class="cms-index-index cms-home1">
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

<div class="ma-main-container col1-layout">
<div class="container">
<div class="main">
<div class="main-inner">
<!-- start enable -->

<?php include("extructura-hot/1-banners-index.php"); ?>

<!-- end enable -->
<div class="col-main">
<div class="banner-static6 row-fluid">

<?php include("extructura-hot/1-index-productos-destacados.php"); ?>

<div class="banner-box banner-box2 span2">
<div class="images-banner">
<a href="#">
<img src="imagenes/publicidad/banner-static10.png" alt="" />
</a>
</div>
</div>

<?php include("extructura-hot/1-index-productos-ofertas.php"); ?>

</div>

<?php include("extructura-hot/1-index-productos-nuevos.php"); ?>

<?php //include("extructura-hot/1-index-banners-pie.php"); ?>

</div>
</div>
</div>
</div>
</div>
<?php //include("extructura-hot/1-index-logos-sliders.php"); ?>

<?php include("extructura-hot/3-footer.php"); ?>
</div>
</body>
</html>