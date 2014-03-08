<?php  
$maxRows_DatosCarrito = 10;
$pageNum_DatosCarrito = 0;
if (isset($_GET['pageNum_DatosCarrito'])) {
  $pageNum_DatosCarrito = $_GET['pageNum_DatosCarrito'];
}
$startRow_DatosCarrito = $pageNum_DatosCarrito * $maxRows_DatosCarrito;

$varUsuario_DatosCarrito = "0";
if (isset($_SESSION['MM_Usuario'])) {
  $varUsuario_DatosCarrito = $_SESSION['MM_Usuario'];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_DatosCarrito = sprintf("SELECT * FROM carrito WHERE carrito.id_usuario = %s AND carrito.transaccion_efectuada = 0", GetSQLValueString($varUsuario_DatosCarrito, "int"));
$query_limit_DatosCarrito = sprintf("%s LIMIT %d, %d", $query_DatosCarrito, $startRow_DatosCarrito, $maxRows_DatosCarrito);
$DatosCarrito = mysql_query($query_limit_DatosCarrito, $HotSecrets) or die(mysql_error());
$row_DatosCarrito = mysql_fetch_assoc($DatosCarrito);

if (isset($_GET['totalRows_DatosCarrito'])) {
  $totalRows_DatosCarrito = $_GET['totalRows_DatosCarrito'];
} else {
  $all_DatosCarrito = mysql_query($query_DatosCarrito);
  $totalRows_DatosCarrito = mysql_num_rows($all_DatosCarrito);
}
$totalPages_DatosCarrito = ceil($totalRows_DatosCarrito/$maxRows_DatosCarrito)-1;
?>

<header>
<div class="ma-header-container">

<div class="toplink">
<div class="container">
<div class="row-fluid">

<div class="span5">
<p class="welcome-msg">
<?php   
if ((isset($_SESSION['MM_Username'])) && ($_SESSION['MM_Username'] != ""))
  {
	  echo "Bienvenido: ";
	  echo MostrarNombreUsuario($_SESSION['MM_Usuario']);
?>
</p>
<p class="welcome-msg"><a href="nosotros">Nosotros</a></p>
<p class="welcome-msg"><a href="cotactenos">Contactenos</a></p>
</div>

<div class="span7">
<ul class="links">
<li class="first"><a href="cuenta.php" title="Mi Cuenta">Mi Cuenta</a></li>
<li><a href="lista-carrito.php" title="Mi Carrito" class="top-link-cart">Mi Carrito</a></li>
<li><a href="lista-compras.php" title="Mis Compras" class="top-link-checkout">Mis Compras</a></li>
<li><a href="cerrar-sesion.php" title="Cerrar Sesion">Salir</a></li>
</ul>
</div>

</div>
</div>
</div>

<div class="container">
<div class="header">
<div class="header-content row-fluid">

<div class="block-header span4">
<div class="phone">
<div class="title">Comunicate a:</div>
<div class="content">943747019 / 991594464</div>
<div class="content">quiero@hotsecretsperu.com</div>
</div>
</div>

<div class="logo-container span4">
<h1 class="logo">
<strong>HotSecrets | Tienda de Lenceria ropa atrevida</strong>
<a href="index.php" title="HostSecrets | Tienda de Lenceria ropa atrevida" class="logo">
<img src="imagenes/logo.png" alt="HotSecrets | Tienda de Lenceria ropa atrevida" />
</a>
</h1>
</div>


<div class="quick-access span4">
<div class="top-cart-wrapper">

<div class="top-cart-contain">
<script type="text/javascript">
    $jq(document).ready(function(){
         var enable_module = $jq('#enable_module').val();
         if(enable_module==0) return false;
    })
</script>
<div id ="mini_cart_block">
<div class="block-cart mini_cart_ajax">
<div class="block-cart">



<div class="top-cart-content">
<?php if ($totalRows_DatosCarrito > 0) { ?>  
<ol id="cart-sidebar" class="mini-products-list">
<?php $preciototal = 0; ?>
<?php do { ?>
<li class="item">
<a href="" title="purple flowers" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo MostarimagenProducto($row_DatosCarrito['id_producto']); ?>&ancho=50&alto=50&cut&mark=false" width="50" height="50" alt="<?php echo MostarNombreProducto($row_DatosCarrito['id_producto']); ?>" />
</a>
<div class="product-details">
<a href="" title="Eliminar" onclick="return confirm('Are you sure you would like to remove this item from the shopping cart?');" class="btn-remove">Eliminar</a>
<p class="product-name">
<a href=""><?php echo MostarNombreProducto($row_DatosCarrito['id_producto']); ?></a>
</p>
<strong> x <?php echo $row_DatosCarrito['cantidad']; ?></strong>
<span class="price"><?php if ((MostarPrecioOfertaProducto($row_DatosCarrito['id_producto'])) && (MostarPrecioOfertaProducto($row_DatosCarrito['id_producto']) != "")){?>
<?php 
$subtotalProd = PrecioTalla($row_DatosCarrito['id_talla']) + PrecioColor($row_DatosCarrito['id_color'])+ MostarPrecioOfertaProducto($row_DatosCarrito['id_producto'])*$row_DatosCarrito['cantidad'];  ?>
<?php  }else {?>
<?php
$subtotalProd =PrecioTalla($row_DatosCarrito['id_talla']) + PrecioColor($row_DatosCarrito['id_color'])+ MostarPrecioProducto($row_DatosCarrito['id_producto'])*$row_DatosCarrito['cantidad'];  ?>
<?php }?>
 S/.<?php echo number_format($subtotalProd,2, '.', ''); ?>
<?php $preciototal = $preciototal + $subtotalProd; ?></span>    
</div>
</li>

<?php } while ($row_DatosCarrito = mysql_fetch_assoc($DatosCarrito)); ?>
</ol>

<script type="text/javascript">decorateList('cart-sidebar', 'none-recursive')</script>
<div class="top-subtotal">Total: 
<span class="price">
 
S/.<?php echo number_format($preciototal,2, '.', ''); ?>
</span>
</div>
<div class="actions">
<a href="lista-carrito.php" class="button btn-empty" id="empty_cart_button">
<span><span>Hacer Pago</span></span></a>
</div>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_DatosCarrito == 0) { // Show if recordset empty ?>
<p class="empty">No tiene artículos en su carrito de compras.</p>
<div class="top-subtotal">Total: <span class="price">S/.0.00</span></div>
<?php } // Show if recordset empty ?>
</div>


</div>
</div>
</div>
</div>
</div>

<form id="search_mini_form" action="" method="get">
<div class="form-search">
<div class="search-contain">
<div class="search-content">
<label for="search">Buscar</label>
<input id="search" type="text" name="q" value="" class="input-text" maxlength="128" />
<button type="submit" title="Buscar" class="button"><span><span>Buscar</span></span></button>
</div>
</div>
</div>
</form>

</div>

</div>
</div>
</div>

<?php }else{ ?>

<p class="welcome-msg">Bienvenid@ a HotSecrets: Invitad@!</p>
<p class="welcome-msg"><a href="nosotros.php">Nosotros</a></p>
<p class="welcome-msg"><a href="cotactenos.php">Contactenos</a></p>
</div>

<div class="span7">
<ul class="links">
<li class="first"><a href="registro.php" title="Registrate">Registrate</a></li>
<li><a href="iniciar-sesion.php" title="Iniciar Sesion" class="top-link-cart">Iniciar Sesion</a></li>
</ul>
</div>

</div>
</div>
</div>

<div class="container">
<div class="header">
<div class="header-content row-fluid">

<div class="block-header span4">
<div class="phone">
<div class="title">Comunicate a:</div>
<div class="content">943747019 / 991594464</div>
<div class="content">quiero@hotsecretsperu.com</div>
</div>
</div>

<div class="logo-container span4">
<h1 class="logo">
<strong>HotSecrets | Tienda de Lenceria ropa atrevida</strong>
<a href="index.php" title="HostSecrets | Tienda de Lenceria ropa atrevida" class="logo">
<img src="imagenes/logo.png" alt="HotSecrets | Tienda de Lenceria ropa atrevida" />
</a>
</h1>
</div>


<div class="quick-access span4">
<div class="top-cart-wrapper">

<div class="top-cart-contain">
<script type="text/javascript">
$jq(document).ready(function(){
var enable_module = $jq('#enable_module').val();
if(enable_module==0) return false;
})
</script>
<div id ="mini_cart_block">
<div class="block-cart mini_cart_ajax">
<div class="block-cart">

<div class="top-cart-content">
<script type="text/javascript">decorateList('cart-sidebar', 'none-recursive')</script>

<p class="empty">Debes de <a href="registro.php">registrarse</a> o <a href="iniciar-sesion.php">Iniciar Sesión.</a></p>
<div class="top-subtotal"><span class="price">Para que puedas hacer tu compra</span></div>

</div>


</div>
</div>
</div>
</div>
</div>

<form id="search_mini_form" action="" method="get">
<div class="form-search">
<div class="search-contain">
<div class="search-content">
<label for="search">Buscar</label>
<input id="search" type="text" name="q" value="" class="input-text" maxlength="128" />
<button type="submit" title="Buscar" class="button"><span><span>Buscar</span></span></button>
</div>
</div>
</div>
</form>

</div>

</div>
</div>
</div>

<?php } ?>
<div class="ma-nav-mobile-container hidden-desktop">
<div class="container">
<div class="navbar">
<div id="navbar-inner" class="navbar-inner navbar-inactive">

<a class="btn btn-navbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>

<span class="brand">Categorias</span>
<ul id="ma-mobilemenu" class="mobilemenu nav-collapse collapse">
<li class="level0 nav-1 level-top first">
<a href="todos-nuestros-productos" class="level-top">
<span>Todos nuestros productos</span>
</a>
</li>
<?php include("extructura-hot/1-header-categorias-mobile.php"); ?>
<li class="level0 nav-5 level-top last">
<a href="nuestras-ofertas" class="level-top">
<span>Ofertas</span>
</a>
</li>

</ul>
</div>
</div>
</div>
</div>

<div class="nav-container visible-desktop">
<div class="container">
<div id="pt_custommenu" class="pt_custommenu">
<div id="pt_menu134" class="pt_menu pt_menu_no_child">
<div class="parentMenu">
<a href="index.php">
<span>Inicio</span>
</a>
</div>
</div>

<div id="pt_menu134" class="pt_menu pt_menu_no_child">
<div class="parentMenu">
<a href="todos-nuestros-productos">
<span>Nuestros Productos</span>

</div>
</div>

<?php include("extructura-hot/1-header-categorias-pc.php"); ?>


<div id="pt_menu_pt_item_menu_custom_menu" class="pt_menu">
<div class="parentMenu">
<span class="block-title"><a href="todos-nuestros-productos">+ Productos</a></span>
</div>


<?php include("extructura-hot/1-header-categorias-pc-z.php"); ?>


</div> 

<div id="pt_menu138" class="pt_menu pt_menu_no_child">
<div class="parentMenu">
<a href="nuestras-ofertas">
<span>Ofertas</span>
</a>
</div>
</div>        
<div class="clearBoth"></div>
</div>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
var CUSTOMMENU_POPUP_EFFECT = 0;
var CUSTOMMENU_POPUP_TOP_OFFSET = 45;
//]]>
</script>
</div>
</header>
<?php
mysql_free_result($DatosCarrito);
?>