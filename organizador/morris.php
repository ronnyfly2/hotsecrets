<?php require_once('../Connections/HotSecrets.php'); ?>
<?php require_once('no-entra.php');?>
<?php
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
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" href="img/favicon.png">
<title>Morris</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="css/font-awesome.css" rel="stylesheet" />
<link href="css/jquery.fancybox.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/gallery.css" />
<link href="css/morris.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/morris.min.js" type="text/javascript"></script>
<script src="js/raphael-min.js" type="text/javascript"></script>
<script src="js/respond.min.js"></script>    
<script src="js/modernizr.custom.js"></script>
<script src="js/toucheffects.js"></script>
<script type="text/javascript">
$(function() {
jQuery(".various").fancybox();
});
</script>
<!--common script for all pages-->
<script src="js/common-scripts.js"></script>
<!-- script for this page only-->
<script src="js/morris-script.js"></script>    
</head>
<body>
<section id="container">
<!--header start-->
<?php include("xtructura/1-header.php"); ?>
<!--header end-->
<!--sidebar start-->
<?php include("xtructura/2-menu-inicio.php"); ?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
<section class="wrapper site-min-height">
<!-- page start-->
<div id="morris">
<div class="row">
<div class="col-lg-6">
<section class="panel">
<header class="panel-heading">
Total de Recursos del sitio web
</header>
<div class="panel-body">
<div id="hero-donut" class="graph"></div>
</div>
</section>
<script>
Morris.Donut({
element: 'hero-donut',
data: [
{label: 'Clientes', value: 50 },
{label: 'Productos', value: 40 },
{label: 'Compras', value: 25 },
{label: 'Categorías', value: 44 },
{label: 'Sub-Categorías', value: 27 }
],
colors: ['#e26b7f', '#caa3da', '#97be4b', '#8075c4', '#59ace2'],
formatter: function (y) { return y + " Und" }
});
</script>
</div>
<div class="col-lg-6">
<section class="panel">
<header class="panel-heading">Video De aprendizaje</header>
<!-- page end-->
<div class="panel-body">
<ul class="grid cs-style-3">
<li>
<figure width="600" height="230">
<img src="imagenes/4.jpg" alt="img04" width="600" height="230">
<figcaption>
<h3></h3>
<span></span>
<a class="various fancybox.iframe" href="https://www.youtube.com/embed/UJMeiK7CNNU">Ver Video</a>
</figcaption>
</figure>
</li>
</ul>
</div>
</section>
</div>
</div>
</div>

</section>
</section>
<!--main content end-->
<!--footer start-->
<?php include("xtructura/7-footer.php"); ?> 
<!--footer end-->
</section>
</body>
</html>