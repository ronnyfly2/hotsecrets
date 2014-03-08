<?php 
$maxRows_TodProductos = 12;
$pageNum_TodProductos = 0;

if (isset($_GET['pagina'])) {
  $pageNum_TodProductos = $_GET['pagina'];
}

$startRow_TodProductos = $pageNum_TodProductos * $maxRows_TodProductos;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_TodProductos = "SELECT * FROM productos WHERE productos.estado_producto = 1 AND productos.stock = 1 AND productos.oferta_producto = 1 ORDER BY productos.id_producto DESC";
$query_limit_TodProductos = sprintf("%s LIMIT %d, %d", $query_TodProductos, $startRow_TodProductos, $maxRows_TodProductos);
$TodProductos = mysql_query($query_limit_TodProductos, $HotSecrets) or die(mysql_error());
$row_TodProductos = mysql_fetch_assoc($TodProductos);

if (isset($_GET['totalRows_TodProductos'])) {
  $totalRows_TodProductos  = $_GET['totalRows_TodProductos'];
} else {
  $all_TodProductos = mysql_query($query_TodProductos);
  $totalRows_TodProductos = mysql_num_rows($all_TodProductos);
}
$totalPages_TodProductos = ceil($totalRows_TodProductos/$maxRows_TodProductos)-1;

$currentPage  = $_SERVER["PHP_SELF"];

$queryString_TodProductos = "";
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
    $queryString_TodProductos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_TodProductos = sprintf("&de=%d%s", $totalRows_TodProductos, $queryString_TodProductos);
?>

<div class="product-container">
<div class="products-grid first">

<?php do { ?>
<div class="span3 item">
<div class="item-inner">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_TodProductos["id_producto"]);?>" title="<?php echo $row_TodProductos['nom_producto']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_TodProductos['img_producto']; ?>&ancho=156&alto=156&&cut&mark=false" alt="<?php echo $row_TodProductos['nom_producto']; ?>" title="<?php echo $row_TodProductos['nom_producto']; ?>" width="156" height="156" />
</a>
<h2 class="product-name">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_TodProductos["id_producto"]);?>" title="<?php echo $row_TodProductos['nom_producto']; ?>"><?php echo $row_TodProductos['nom_producto']; ?></a>
</h2>
<?php if ($row_TodProductos['oferta_producto'] > 0) {?>
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal:</span>
<span class="price" id="old-price">S/.<?php echo number_format($row_TodProductos['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_TodProductos['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<?php if ($row_TodProductos['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_TodProductos['precio_normal_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php } ?>
        
<button type="button" class="button" onclick="location.href='click-productos-destacados.php?destacado=<?php echo base64_encode($row_TodProductos["id_producto"]);?>'" >
<span>
<span class="button btn-cart">Ver Detalle</span>
</span>
</button>
</div>
</div>
<?php } while ($row_TodProductos = mysql_fetch_assoc($TodProductos)); ?>

</div>
</div>


<div class="toolbar-bottom">
<div class="toolbar">
<div class="pager">
<div class="sort-by hidden-phone">

<?php if ($pageNum_TodProductos > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, 0, $queryString_TodProductos)  ?>">Principio</a>
<?php } // Show if not first page ?>
<?php if ($pageNum_TodProductos > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, max(0, $pageNum_TodProductos - 1), $queryString_TodProductos); ?>"><</a>
<?php } // Show if not first page ?>

<?php if ($pageNum_TodProductos || $totalPages_TodProductos > 0) { // Show if not first page ?>
<span class="current">Pagina <?php echo ("$pageNum_TodProductos")+1 ?> / <?php echo ("$totalPages_TodProductos")+1 ?></span>
<?php } // Show if not first page ?>  
              
<?php if ($pageNum_TodProductos < $totalPages_TodProductos) { // Show if not last page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, min($totalPages_TodProductos, $pageNum_TodProductos + 1), $queryString_TodProductos); ?>">></a>
<?php } // Show if not last page ?>
<?php if ($pageNum_TodProductos < $totalPages_TodProductos) { // Show if not last page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, $totalPages_TodProductos, $queryString_TodProductos); ?>">Final</a>
<?php } // Show if not last page ?>  


</div>
</div>
</div>
</div>
<?php
mysql_free_result($TodProductos);
?>