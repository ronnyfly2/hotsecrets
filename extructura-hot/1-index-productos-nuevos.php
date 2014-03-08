<?php 
$maxRows_ProducNuevos = 10;
$pageNum_ProducNuevos = 0;
if (isset($_GET['pageNum_ProducNuevos'])) {
  $pageNum_ProducNuevos = $_GET['pageNum_ProducNuevos'];
}
$startRow_ProducNuevos = $pageNum_ProducNuevos * $maxRows_ProducNuevos;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ProducNuevos = "SELECT * FROM productos WHERE productos.estado_producto=1 AND productos.stock=1 ORDER BY productos.id_producto DESC";
$query_limit_ProducNuevos = sprintf("%s LIMIT %d, %d", $query_ProducNuevos, $startRow_ProducNuevos, $maxRows_ProducNuevos);
$ProducNuevos = mysql_query($query_limit_ProducNuevos, $HotSecrets) or die(mysql_error());
$row_ProducNuevos = mysql_fetch_assoc($ProducNuevos);

if (isset($_GET['totalRows_ProducNuevos'])) {
  $totalRows_ProducNuevos = $_GET['totalRows_ProducNuevos'];
} else {
  $all_ProducNuevos = mysql_query($query_ProducNuevos);
  $totalRows_ProducNuevos = mysql_num_rows($all_ProducNuevos);
}
$totalPages_ProducNuevos = ceil($totalRows_ProducNuevos/$maxRows_ProducNuevos)-1;
?>


<div class="std">
<div class="home-content">
<div class="ma-newproductslider-container">
<div class="ma-newproductslider-title">
<h2>Productos Nuevos</h2>
</div>
<div class="flexslider carousel">
<ul class="slides">
<?php do { ?>
<li class="newproductslider-item">
<div class="item-inner">									
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProducNuevos["id_producto"]);?>" title="<?php echo $row_ProducNuevos['nom_producto']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_ProducNuevos['img_producto']; ?>&ancho=206&alto=206&cut&mark=false" alt="<?php echo $row_ProducNuevos['nom_producto']; ?>" /></a>									
<h2 class="product-name">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProducNuevos["id_producto"]);?>" title="<?php echo $row_ProducNuevos['nom_producto']; ?>"><?php echo $row_ProducNuevos['nom_producto']; ?></a></h2>
<span class='sale'></span>								
<?php if ($row_ProducNuevos['oferta_producto'] > 0) {?>
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal:</span>
<span class="price" id="old-price">S/.<?php echo number_format($row_ProducNuevos['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_ProducNuevos['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<?php if ($row_ProducNuevos['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_ProducNuevos['precio_normal_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<button type="button" class="button" title="Ver Detalle" onclick="location.href='click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProducNuevos["id_producto"]);?>'">
<span><span>Ver Detalle</span></span>
</button>
</div>
</li>
<?php } while ($row_ProducNuevos = mysql_fetch_assoc($ProducNuevos)); ?>     
</ul>
<script type="text/javascript">
$jq('.ma-newproductslider-container .flexslider').flexslider({
slideshow: false,
itemWidth: 200,
itemMargin: 5,
minItems: 1,
maxItems: 5,
slideshowSpeed: 3000,
animationSpeed: 600,
controlNav: false,
animation: "slide"
});
</script>
</div>	
</div>
</div>
</div>
<?php
mysql_free_result($ProducNuevos);
?>