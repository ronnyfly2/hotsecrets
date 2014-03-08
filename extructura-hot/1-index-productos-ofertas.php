<?php
$maxRows_ProducOferta = 6;
$pageNum_ProducOferta = 0;
if (isset($_GET['pageNum_ProducOferta'])) {
  $pageNum_ProducOferta = $_GET['pageNum_ProducOferta'];
}
$startRow_ProducOferta = $pageNum_ProducOferta * $maxRows_ProducOferta;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ProducOferta = "SELECT * FROM productos WHERE productos.estado_producto = 1 AND productos.stock = 1 AND productos.oferta_producto = 1 ORDER BY productos.id_producto DESC";
$query_limit_ProducOferta = sprintf("%s LIMIT %d, %d", $query_ProducOferta, $startRow_ProducOferta, $maxRows_ProducOferta);
$ProducOferta = mysql_query($query_limit_ProducOferta, $HotSecrets) or die(mysql_error());
$row_ProducOferta = mysql_fetch_assoc($ProducOferta);

if (isset($_GET['totalRows_ProducOferta'])) {
  $totalRows_ProducOferta = $_GET['totalRows_ProducOferta'];
} else {
  $all_ProducOferta = mysql_query($query_ProducOferta);
  $totalRows_ProducOferta = mysql_num_rows($all_ProducOferta);
}
$totalPages_ProducOferta = ceil($totalRows_ProducOferta/$maxRows_ProducOferta)-1;
?>

<div class="banner-box banner-box3 span5">
<div class="ma-onsaleproductslider-container">
<div class="ma-onsaleproductslider-title"><h2>Productos En Oferta</h2></div>
<div class="flexslider carousel">
<ul class="slides">
<?php do { ?>
<li class="onsaleproductslider-item">
<div class="item-inner">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProducOferta["id_producto"]);?>" title="<?php echo $row_ProducOferta['nom_producto']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_ProducOferta['img_producto']; ?>&ancho=206&alto=206&cut&mark=false" alt="<?php echo $row_ProducOferta['nom_producto']; ?>" />
</a>
<h2 class="product-name">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProducOferta["id_producto"]);?>" title="<?php echo $row_ProducOferta['nom_producto']; ?>">
<?php echo $row_ProducOferta['nom_producto']; ?></a>
</h2>
<?php if ($row_ProducOferta['oferta_producto'] > 0) {?>
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal:</span>
<span class="price" id="old-price">S/.<?php echo number_format($row_ProducOferta['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_ProducOferta['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<?php if ($row_ProducOferta['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_ProducOferta['precio_normal_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php } ?>							
<div class="actions">
<button type="button" class="button" onclick="location.href='click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProducOferta["id_producto"]);?>'" >
<span>
<span class="button btn-cart">Ver Detalle</span>
</span>
</button>
</div>
</div>
</li>
<?php } while ($row_ProducOferta = mysql_fetch_assoc($ProducOferta)); ?>  
                  
      
</ul>
<script type="text/javascript">
$jq('.ma-onsaleproductslider-container .flexslider').flexslider({
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
mysql_free_result($ProducOferta);
?>
