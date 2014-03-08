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
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Ronny">
<link rel="shortcut icon" href="img/favicon.png">
<title>Administrador - Hotsecrets</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="css/font-awesome.css" rel="stylesheet" />
<link href="css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
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
<section id="container" >
<!--header start-->
<?php include("xtructura/1-header.php"); ?>
<!--header end-->
<!--sidebar start-->
<?php include("xtructura/2-menu-inicio.php"); ?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
<section class="wrapper">
<!--state overview start-->
<?php include("xtructura/1-analizador-usuarios.php"); ?>
<?php include("xtructura/1-analizador-productos.php"); ?>
<!--state overview end-->
<?php //include("xtructura/1-graficos.php"); ?>
<?php //include("xtructura/1-progreso-trabajadores.php"); ?>
<?php //include("xtructura/1-timeline-porcentaje.php"); ?>


<div class="row">
<div class="col-lg-4">
<div class="row">
<div class="col-xs-6">
<!--follower start-->
<!--<section class="panel">
<div class="follower">
<div class="panel-body">
<h4>Jonathan Smith</h4>
<div class="follow-ava">
<img src="imagenes/follower-avatar.jpg" alt="">
</div>
</div>
</div>
<footer class="follower-foot">
<ul>
<li>
<h5>2789</h5>
<p>Follower</p>
</li>
<li>
<h5>270</h5>
<p>Following</p>
</li>
</ul>
</footer>
</section>-->
<!--follower end-->
</div>
</div>
</div>
</div>
</section>
</section>
<!--main content end-->
<?php include("xtructura/7-footer.php"); ?> 
</section>
<!-- js placed at the end of the document so the pages load faster -->    
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/jquery.sparkline.js" type="text/javascript"></script>
<script src="js/jquery.easy-pie-chart.js"></script>
<script src="js/owl.carousel.js" ></script>
<script src="js/jquery.customSelect.min.js" ></script>
<script src="js/respond.min.js" ></script>
<!--common script for all pages-->
<script src="js/common-scripts.js"></script>
<!--script for this page-->
<script>
//custom select box
$(function(){
$('select.styled').customSelect();
});
</script>
</body>
</html>