<?php  
$maxRows_ProdAlAzar = 10;
$pageNum_ProdAlAzar = 0;
if (isset($_GET['pageNum_ProdAlAzar'])) {
  $pageNum_ProdAlAzar = $_GET['pageNum_ProdAlAzar'];
}
$startRow_ProdAlAzar = $pageNum_ProdAlAzar * $maxRows_ProdAlAzar;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ProdAlAzar = "SELECT * FROM productos WHERE productos.estado_producto = 1 ORDER BY RAND()";
$query_limit_ProdAlAzar = sprintf("%s LIMIT %d, %d", $query_ProdAlAzar, $startRow_ProdAlAzar, $maxRows_ProdAlAzar);
$ProdAlAzar = mysql_query($query_limit_ProdAlAzar, $HotSecrets) or die(mysql_error());
$row_ProdAlAzar = mysql_fetch_assoc($ProdAlAzar);

if (isset($_GET['totalRows_ProdAlAzar'])) {
  $totalRows_ProdAlAzar = $_GET['totalRows_ProdAlAzar'];
} else {
  $all_ProdAlAzar = mysql_query($query_ProdAlAzar);
  $totalRows_ProdAlAzar = mysql_num_rows($all_ProdAlAzar);
}
$totalPages_ProdAlAzar = ceil($totalRows_ProdAlAzar/$maxRows_ProdAlAzar)-1;
?>

<div class="ma-upsellslider-container">
<div class="ma-upsellslider-title">
<h2>Productos de Interes</h2>
<div class="bg-title">
<div class="bg-left"></div>
</div>
</div>

<div class="flexslider carousel">
<ul class="slides">

<?php do { ?>
<li class="newproductslider-item">
<div class="item-inner">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProdAlAzar["id_producto"]);?>" title="<?php echo $row_ProdAlAzar['nom_producto']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_ProdAlAzar['img_producto']; ?>&ancho=186&alto=186&cut&mark=false" alt="<?php echo $row_ProdAlAzar['nom_producto']; ?>" title="<?php echo $row_ProdAlAzar['nom_producto']; ?>" width="186" height="186" style="height:186px; width:186px" />
</a>
<?php if ($row_ProdAlAzar['oferta_producto'] > 0) {?>
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal:</span>
<span class="price" id="old-price">S/.<?php echo number_format($row_ProdAlAzar['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_ProdAlAzar['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<?php if ($row_ProdAlAzar['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price">S/.<?php echo number_format($row_ProdAlAzar['precio_normal_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php } ?>
<h3 class="product-name">
<a href="click-productos-destacados.php?destacado=<?php echo base64_encode($row_ProdAlAzar["id_producto"]);?>" title="<?php echo $row_ProdAlAzar['nom_producto']; ?>"><?php echo $row_ProdAlAzar['nom_producto']; ?></a>
</h3>
</div>
</li>
<?php } while ($row_ProdAlAzar = mysql_fetch_assoc($ProdAlAzar)); ?>                         
</ul>
</div>

</div>
<script type="text/javascript">
//<![CDATA					
$jq(document).ready(function() {
$jq('.ma-upsellslider-container .flexslider').flexslider({
slideshow: false,
itemWidth: 200,
itemMargin: 15,
minItems: 1,
maxItems: 4,
slideshowSpeed: 3000,
animationSpeed: 600,                
controlNav: false,
animation: "slide"
});
});
//]]>
</script> 
<?php
mysql_free_result($ProdAlAzar);
?>