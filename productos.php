<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which is included by Connections/HotSecrets.php
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
<div class="breadcrumbs">
<ul>
<li class="home">
<a href="" title="Go to Home Page">Inicio</a>
<span>/ </span>
</li>
<li class="category134">
<strong>Productos</strong>
</li>
</ul>
</div>
<div class="row-fluid">
<div class="col-main span9">
<div class="page-title category-title">

<h1>Todos Nuestros Productos de HotSecrets Perú | Lenceria ropa atrevida</h1>
</div>
<p class="category-image" style="margin-bottom:25px;">
<img src="imagenes/todos-nuestros-productos-lenceria.png" alt="Lenceria ropa atrevida" title="Lenceria ropa atrevida" />
</p>

<div class="category-products">
<?php include("extructura-hot/2-contenido-todos-productos.php"); ?> 
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
