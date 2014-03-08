<?php if ($totalRows_DetalleProd > 0) { // Show if recordset not empty ?>
<div class="breadcrumbs">
<ul>
<li class="home">
<a href="http://hotsecrets.lence/" title="Go to Home Page">Inicio</a>
<span>/ </span>
</li>
<li class="home">
<a href="click-sub-categorias.php?tokem=<?php echo base64_encode($row_DetalleProd["id_subcategoria"]);?>" title="<?php echo MostarNombreSubCategoria($row_DetalleProd['id_subcategoria']); ?>">
<?php echo MostarNombreSubCategoria($row_DetalleProd['id_subcategoria']); ?>
</a>
<span>/ </span>
</li>
<li class="product">
<strong><?php echo $row_DetalleProd['nom_producto']; ?></strong>
</li>
</ul>
</div>
<div class="row-fluid">
<div class="col-main span9">
<!--<script type="text/javascript">
var optionsPrice = new Product.OptionsPrice({"productId":"37","priceFormat":{"pattern":"$%s","precision":2,"requiredPrecision":2,"decimalSymbol":".","groupSymbol":",","groupLength":3,"integerRequired":1},"includeTax":"false","showIncludeTax":false,"showBothPrices":false,"productPrice":43,"productOldPrice":45,"priceInclTax":43,"priceExclTax":43,"skipCalculate":1,"defaultTax":0,"currentTax":0,"idSuffix":"_clone","oldPlusDisposition":0,"plusDisposition":0,"plusDispositionTax":0,"oldMinusDisposition":0,"minusDisposition":0,"tierPrices":[],"tierPricesInclTax":[]});
</script>-->
<div id="messages_product_view"></div>
<div class="product-view">
<div class="product-essential row-fluid">
<form action="agregar-carrito.php" method="POST" id="product_addtocart_form">
<div class="product-img-box span6">
<p class="product-image">
<!-- images for lightbox -->
<?php do { ?>
<a href="img.php?imagen=imagenes/productos/<?php echo $row_javaimag['imagenes']; ?>&ancho=300&alto=300&cut&mark=false" class="ma-a-lighbox" rel="lightbox[rotation]" title="<?php echo $row_DetalleProd['nom_producto']; ?>"></a>
<?php } while ($row_javaimag = mysql_fetch_assoc($javaimag)); ?>
<!--++++++++++++-->
<a href="imagenes/productos/<?php echo $row_Imagenes['imagenes']; ?>" class="cloud-zoom" id="ma-zoom1" style="position: relative; display: block;" rel="adjustX:10, adjustY:-2, zoomWidth:365, zoomHeight:387" title="<?php echo $row_DetalleProd['nom_producto']; ?>">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_Imagenes['imagenes']; ?>&ancho=409&alto=467&cut&mark=false" alt="<?php echo $row_DetalleProd['nom_producto']; ?>" title="<?php echo $row_DetalleProd['nom_producto']; ?>" />
</a>
</p>
<div class="more-views ma-thumbnail-container">
<h2>Mas imagenes de <?php echo $row_DetalleProd['nom_producto']; ?></h2>
<div class="flexslider carousel">
<ul class="slides">
<?php do { ?>
<li class="thumbnail-item">
<a href="img.php?imagen=imagenes/productos/<?php echo $row_Imagenes['imagenes']; ?>&ancho=1200&alto=1200&cut&mark=false" class="cloud-zoom-gallery" title="<?php echo $row_DetalleProd['nom_producto']; ?>" name="imagenes/productos/<?php echo $row_Imagenes['imagenes']; ?>" rel="useZoom: 'ma-zoom1', smallImage: 'img.php?imagen=imagenes/productos/<?php echo $row_Imagenes['imagenes']; ?>&ancho=409&alto=467&cut&mark=false'">
<img src="img.php?imagen=imagenes/productos/<?php echo $row_Imagenes['imagenes']; ?>&ancho=79&alto=79&cut&mark=false" alt="<?php echo $row_DetalleProd['nom_producto']; ?>" />
</a>
</li>
<?php } while ($row_Imagenes = mysql_fetch_assoc($Imagenes)); ?>

</ul>
</div>
<script type="text/javascript">
//<![CDATA[
$jq('.ma-thumbnail-container .flexslider').flexslider({
itemWidth: 80,
itemMargin: 5,
minItems: 2,
maxItems: 4,
controlNav: false,
slideshowSpeed: 3000,
animationSpeed: 500,
animation: "slide"
});		
//]]>
</script>
</div>
</div>
        
<div class="product-shop span6">
<div class="product-name">
<h1><?php echo $row_DetalleProd['nom_producto']; ?></h1>
</div>

<div class="ratings">
<p class="rating-links">
<a href="#product_tabs_product.tags">(<fb:comments-count href="<?php echo dameURL(); ?>"></fb:comments-count>) Comentario(s)</a>
<span class="separator">|</span>
<a href="#product_tabs_product.tags">Agregar un Comentario</a>
</p>
</div>
            
            
<div class="short-description">
<!--<h2>Quick Overview</h2>-->
<div class="std"><?php echo $row_DetalleProd['resumen_producto']; ?></div>
</div>
<div class="price-cart">
<?php if ($row_DetalleProd['oferta_producto'] > 0) {?>                                                                     
<div class="price-box">
<p class="old-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="old-price-37">S/.<?php echo number_format($row_DetalleProd['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price-37">S/.<?php echo number_format($row_DetalleProd['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<?php if ($row_DetalleProd['oferta_producto'] == 0) { ?>
<div class="price-box">
<p class="special-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="product-price-37">S/.<?php echo number_format($row_DetalleProd['precio_normal_producto'],2, '.', ''); ?></span>
</p>
</div>
<?php }?>
<p class="availability in-stock"><span>En stock</span></p>
</div>
            
<?php echo MostrarTallasProducto($row_DetalleProd['id_producto']); ?>
<?php echo MostrarColorProducto($row_DetalleProd['id_producto']); ?>



<div class="product-options-bottom">
<div class="price-box">
<?php if ($row_DetalleProd['oferta_producto'] > 0) {?> 
<p class="old-price">
<span class="price-label">Precio Normal</span>
<span class="price" id="old-price-37_clone">S/.<?php echo number_format($row_DetalleProd['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price-37_clone">S/.<?php echo number_format($row_DetalleProd['precio_oferta_producto'],2, '.', ''); ?></span>
</p>
<?php }?>
<?php if ($row_DetalleProd['oferta_producto'] == 0) { ?>
<p class="special-price">
<span class="price-label">Precio Oferta</span>
<span class="price" id="product-price-37_clone">S/.<?php echo number_format($row_DetalleProd['precio_normal_producto'],2, '.', ''); ?></span>
</p>
<?php }?>
</div>

<div class="add-to-cart">
<label for="cantidad">Cantidad:</label>
<input type="text" name="cantidad" class="input-text qty" value="1" />
<?php if ((isset($_SESSION['MM_Username'])) && ($_SESSION['MM_Username'] != "")){?>
<input type="hidden" name="producto" value="<?php echo $row_DetalleProd["id_producto"]; ?>" />
<button type="submit" title="Agregar al carrito" class="button btn-cart">
<span><span>Agregar al carrito</span></span>
</button>
<?php  }else {?>
<p>Para comprar necesitas <a href="registro.php">registrarte</a> o <a href="iniciar-sesion.php?accesscheck=sesion-productos.php?tokem=<?php echo base64_encode($row_DetalleProd["id_producto"]);?>">inicia sesión.</a></p>
<?php }?>
</form>
</div>

</div>

<div class="add-to-box">               
<p class="email-friend">
<a href="">Envianos un Mail</a>
</p><br /><br /><br /><br />
</div>

<div class="product-social">
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52a4a56c23c3146f"></script>
<!-- AddThis Button END -->
</div>
<div class="product-more-info">
</div>
</div>
                    
<div class="clearer"></div>
<div class="no-display">

</div>

<script type="text/javascript">
//<![CDATA[
var productAddToCartForm = new VarienForm('product_addtocart_form');
productAddToCartForm.submit = function(button, url) {
if (this.validator.validate()) {
var form = this.form;
var oldUrl = form.action;
if (url) {
form.action = url;
}
var e = null;
try {
this.form.submit();
} catch (e) {
}
this.form.action = oldUrl;
if (e) {
throw e;
}
if (button && button != 'undefined') {
button.disabled = true;
}
}
}.bind(productAddToCartForm);
productAddToCartForm.submitLight = function(button, url){
if(this.validator) {
var nv = Validation.methods;
delete Validation.methods['required-entry'];
delete Validation.methods['validate-one-required'];
delete Validation.methods['validate-one-required-by-name'];
// Remove custom datetime validators
for (var methodName in Validation.methods) {
if (methodName.match(/^validate-datetime-.*/i)) {
delete Validation.methods[methodName];
}
}

if (this.validator.validate()) {
if (url) {
this.form.action = url;
}
this.form.submit();
}
Object.extend(Validation.methods, nv);
}
}.bind(productAddToCartForm);
//]]>
</script>
</div>

<div class="product-collateral row-fluid">
<ul class="product-tabs">
<li id="product_tabs_description" class=" active first">
<a href="#">Descripción</a>
</li>
<li id="product_tabs_product_additional_data" class="">
<a href="#">Detalles</a>
</li>
<li id="product_tabs_product.tags" class=" last">
<a href="#">Comentarios (<fb:comments-count href="<?php echo dameURL(); ?>"></fb:comments-count>)</a>
</li>
</ul>
<div class="product-tabs-content" id="product_tabs_description_contents">
<h2>Descripción del Producto <?php echo $row_DetalleProd['nom_producto']; ?></h2>
<div class="std">
<?php echo $row_DetalleProd['detalle_producto']; ?>
</div>
</div>
<div class="product-tabs-content" id="product_tabs_product_additional_data_contents">
<div class="box-collateral box-reviews row-fluid" id="customer-reviews">
<div class="ma-review-col1 span6">
<h2>Detalles Adicionales de <?php echo $row_DetalleProd['nom_producto']; ?></h2>
</div>
<table class="data-table" id="product-review-table">
<tbody>
<tr>
<th>Composiciones</th>
<td class="value"><?php echo $row_DetalleProd["composiciones"]; ?></td>
</tr>
<tr>
<th>Colores Disponibles</th>
<td class="value"><?php echo MostrarColorDetaDisp($row_DetalleProd['id_producto']); ?></td>
</tr>
<tr>
<th>Video</th>
<td class="value">
<?php echo $row_DetalleProd["video_producto"]; ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="product-tabs-content" id="product_tabs_product.tags_contents">
<div class="box-collateral box-tags">
<h2>Comentarios del Facebook</h2>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=671242049581561";
 fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<fb:comments href="<?php echo dameURL(); ?>" width="auto" num_posts="7" notify="true"></fb:comments>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
Varien.Tabs = Class.create();
Varien.Tabs.prototype = {
initialize: function(selector) {
var self=this;
$$(selector+' a').each(this.initTab.bind(this));
},
initTab: function(el) {
el.href = 'javascript:void(0)';
if ($(el.parentNode).hasClassName('active')) {
this.showContent(el);
}
el.observe('click', this.showContent.bind(this, el));
},
showContent: function(a) {
var li = $(a.parentNode), ul = $(li.parentNode);
ul.select('li').each(function(el){
var contents = $(el.id+'_contents');
if (el==li) {
el.addClassName('active');
contents.show();
} else {
el.removeClassName('active');
contents.hide();
}
});
}
}
new Varien.Tabs('.product-tabs');
//]]>
</script>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_DetalleProd == 0) { // Show if recordset empty ?>

<div class="breadcrumbs">
  <ul>
    <li class="home"> No se pudo encontrar el producto <span>/ </span> </li>
    <li class="home"> Dirijase al Inicio <a href="http://hotsecrets.lence/">Click Aquí</a> <span></span> </li>    
  </ul>
</div>

<div class="row-fluid">
<div class="col-main span9">
<div class="product-view">
<div class="product-collateral row-fluid">
<?php } // Show if recordset empty ?>

<?php include("extructura-hot/3-detalle-productos-random.php"); ?>
 

</div>
</div>
<script type="text/javascript">
var lifetime = 3600;
var expireAt = HotSec.Cookies.expires;
if (lifetime > 0) {
expireAt = new Date();
expireAt.setTime(expireAt.getTime() + lifetime * 1000);
}
HotSec.Cookies.set('external_no_cache', 1, expireAt);
</script>
</div>

<?php
mysql_free_result($DetalleProd);
mysql_free_result($Imagenes);
mysql_free_result($javaimag);
?>