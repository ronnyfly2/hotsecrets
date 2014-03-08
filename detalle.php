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
$_GET["detalle"] = ObtenerUrlSEOProducto($_GET["detalle"]);
$varUlr_DetalleProd = "0";
if (isset($_GET["detalle"])) {
  $varUlr_DetalleProd = $_GET["detalle"];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_DetalleProd = sprintf("SELECT * FROM productos WHERE productos.id_producto= %s", GetSQLValueString($varUlr_DetalleProd, "int"));
$DetalleProd = mysql_query($query_DetalleProd, $HotSecrets) or die(mysql_error());
$row_DetalleProd = mysql_fetch_assoc($DetalleProd);
$totalRows_DetalleProd = mysql_num_rows($DetalleProd);


mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Imagenes = "SELECT * FROM imagenes_productos WHERE imagenes_productos.id_producto = $varUlr_DetalleProd";
$Imagenes = mysql_query($query_Imagenes, $HotSecrets) or die(mysql_error());
$row_Imagenes = mysql_fetch_assoc($Imagenes);
$totalRows_Imagenes = mysql_num_rows($Imagenes);


mysql_select_db($database_HotSecrets, $HotSecrets);
$query_javaimag = "SELECT * FROM imagenes_productos WHERE imagenes_productos.id_producto = $varUlr_DetalleProd";
$javaimag = mysql_query($query_javaimag, $HotSecrets) or die(mysql_error());
$row_javaimag = mysql_fetch_assoc($javaimag);
$totalRows_javaimag = mysql_num_rows($javaimag);
?>
<!DOCTYPE html>
<html>
<?php include("extructura-hot/2-head-detalle-producto.php"); ?>
</head>
<body class=" catalog-product-view catalog-product-view product-product">
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


<?php include("extructura-hot/2-contenido-detalle-producto.php"); ?>

<?php include("extructura-hot/3-aside.php"); ?>

</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>

<div id="ajaxconfig_info" style ="display:none">
<a href =""></a>
<div>
<img src ="imagenes/productos/loading.gif" alt ="Loading Image" />
</div>
</div>

<div id="ajaxcart-checkout-content" style="display:none;"></div>
<div id ="productHaveOption"  style="display:block;" ></div>
<script type="text/javascript">

    function initLightbox(){
        new Lightbox({
            fileLoadingImage: 'imagenes/productos/loading.gif',
            fileBottomNavCloseImage: 'imagenes/productos/closelabel.gif',
            overlayOpacity: 0.8,   // controls transparency of shadow overlay
            animate: true,         // toggles resizing animations
            resizeSpeed: 7,        // controls the speed of the image resizing animations (1=slowest and 10=fastest)
            borderSize: 10,
            // When grouping images this is used to write: Image # of #.
            // Change it for non-english localization
            labelImage: "Image",
            labelOf: "of"
        });
    }


    if (Prototype.Browser.IE) {
        Event.observe(window, 'load', function(){ //KB927917 fix
            initLightbox();
        });
    } else {
        document.observe("dom:loaded", function(){
            initLightbox();
        });
    }
</script>

</div>
</div>
</body>
</html>