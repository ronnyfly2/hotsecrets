<?php 
$maxRows_AsideNuevos = 4;
$pageNum_AsideNuevos = 0;
if (isset($_GET['pageNum_AsideNuevos'])) {
  $pageNum_AsideNuevos = $_GET['pageNum_AsideNuevos'];
}
$startRow_AsideNuevos = $pageNum_AsideNuevos * $maxRows_AsideNuevos;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_AsideNuevos = "SELECT * FROM productos WHERE productos.estado_producto=1 AND productos.stock=1 ORDER BY productos.id_producto DESC";
$query_limit_AsideNuevos = sprintf("%s LIMIT %d, %d", $query_AsideNuevos, $startRow_AsideNuevos, $maxRows_AsideNuevos);
$AsideNuevos = mysql_query($query_limit_AsideNuevos, $HotSecrets) or die(mysql_error());
$row_AsideNuevos = mysql_fetch_assoc($AsideNuevos);

if (isset($_GET['totalRows_AsideNuevos'])) {
  $totalRows_AsideNuevos = $_GET['totalRows_AsideNuevos'];
} else {
  $all_AsideNuevos = mysql_query($query_AsideNuevos);
  $totalRows_AsideNuevos = mysql_num_rows($all_AsideNuevos);
}
$totalPages_AsideNuevos = ceil($totalRows_AsideNuevos/$maxRows_AsideNuevos)-1;
?>
<div class="block ma-relatedslider-container">
<div class="block-title related-product-title">
<strong>
<span>Productos Nuevos</span>
</strong>
</div>
<div class="block-content flexslider carousel">
<ul class="slides" id="block-related">
<?php do { ?>
<li class="relatedslider-item">
<div class="product">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_AsideNuevos["id_producto"]);?>" title="<?php echo $row_AsideNuevos['nom_producto']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_AsideNuevos['img_producto']; ?>&ancho=213&alto=213&cut&mark=false" alt="<?php echo $row_AsideNuevos['nom_producto']; ?>" title="<?php echo $row_AsideNuevos['nom_producto']; ?>" />
</a>
<div class="product-details">
<?php if ($row_AsideNuevos['oferta_producto'] > 0) {?>
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal:</span>
<span class="price" id="old-price">S/.<?php echo $row_AsideNuevos['precio_normal_producto']; ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price">S/.<?php echo $row_AsideNuevos['precio_oferta_producto']; ?></span>
</p>
</div>
<?php }?>
<?php if ($row_AsideNuevos['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price">S/.<?php echo $row_AsideNuevos['precio_normal_producto']; ?></span>
</p>
</div>
<?php } ?>
<p class="product-name">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_AsideNuevos["id_producto"]);?>" title="<?php echo $row_AsideNuevos['nom_producto']; ?>"><?php echo $row_AsideNuevos['nom_producto']; ?></a>
</p>
</div>
</div>
</li>
<?php } while ($row_AsideNuevos = mysql_fetch_assoc($AsideNuevos)); ?>
</ul>

</div>
<script type="text/javascript">
//<![CDATA[
$jq(document).ready(function() {
$jq('.ma-relatedslider-container .flexslider').flexslider({
slideshow: false,
itemWidth: 255,
itemMargin: 6,
minItems: 1,
maxItems: 1,
slideshowSpeed: 3000,
animationSpeed: 600,
controlNav: false,
animation: "slide"
});
});
//]]>
</script>
</div>
<?php
mysql_free_result($AsideNuevos);
?>