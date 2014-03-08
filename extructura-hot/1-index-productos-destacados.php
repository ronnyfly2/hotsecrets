<?php
$maxRows_Destacados = 6;
$pageNum_Destacados = 0;
if (isset($_GET['pageNum_Destacados'])) {
  $pageNum_Destacados = $_GET['pageNum_Destacados'];
}
$startRow_Destacados = $pageNum_Destacados * $maxRows_Destacados;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Destacados = "SELECT * FROM productos WHERE productos.estado_producto = 1 AND productos.stock = 1 ORDER BY productos.clicks_producto DESC";
$query_limit_Destacados = sprintf("%s LIMIT %d, %d", $query_Destacados, $startRow_Destacados, $maxRows_Destacados);
$Destacados = mysql_query($query_limit_Destacados, $HotSecrets) or die(mysql_error());
$row_Destacados = mysql_fetch_assoc($Destacados);

if (isset($_GET['totalRows_Destacados'])) {
  $totalRows_Destacados = $_GET['totalRows_Destacados'];
} else {
  $all_Destacados = mysql_query($query_Destacados);
  $totalRows_Destacados = mysql_num_rows($all_Destacados);
}
$totalPages_Destacados = ceil($totalRows_Destacados/$maxRows_Destacados)-1;
?>

<div class="banner-box banner-box1 span5">
<div class="ma-featuredproductslider-container">
<div class="ma-bestseller-sldier-title">
<h2>Productos Destacados</h2>
</div>
<div class="flexslider carousel">
<ul class="slides">
<?php do { ?>
<li class="featuredproductslider-item">
<div class="item-inner">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_Destacados["id_producto"]);?>" title="<?php echo $row_Destacados['nom_producto']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_Destacados['img_producto']; ?>&ancho=206&alto=206&cut&mark=false"  alt="<?php echo $row_Destacados['nom_producto']; ?>" title="<?php echo $row_Destacados['nom_producto']; ?>" />
</a>
<h2 class="product-name">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_Destacados["id_producto"]);?>" title="<?php echo $row_Destacados['nom_producto']; ?>">
<?php echo $row_Destacados['nom_producto']; ?>
</a>
</h2>
<div class="actions">
</div>
<span class='sale'></span>
<?php if ($row_Destacados['oferta_producto'] > 0) {?>
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal:</span>
<span class="price" id="old-price">S/.<?php echo number_format($row_Destacados['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_Destacados['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<?php if ($row_Destacados['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_Destacados['precio_normal_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php } ?>
<button type="button" class="button" onclick="location.href='click-productos-destacados.php?destacado=<?php echo base64_encode($row_Destacados["id_producto"]);?>'" >
<span>
<span class="button btn-cart">Ver Detalle</span>
</span>
</button>

</div>
</li>
<?php } while ($row_Destacados = mysql_fetch_assoc($Destacados)); ?>
</ul>
<script type="text/javascript">
$jq('.ma-featuredproductslider-container .flexslider').flexslider({
slideshow: false,
itemWidth: 200,
itemMargin: 5,
minItems: 1,
maxItems: 2,
slideshowSpeed: 3000,
animationSpeed: 600,
controlNav: false,
animation: "slide"
});
</script>
</div>	
</div>

</div>
<?php
mysql_free_result($Destacados);
?>