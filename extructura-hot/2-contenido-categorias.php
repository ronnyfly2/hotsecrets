<?php if ($totalRows_TodSubCat > 0) { // Show if recordset not empty ?>
<div class="breadcrumbs">
<ul>
<li class="home">
<a href="http://www.hotsecretsperu.com" title="Ir a la pagina de inicio">Inicio</a>
<span>/ </span>
</li>
<li class="category134">
<strong><?php echo MostarNombreCategoria($row_TodSubCat['id_categoria']); ?></strong>
</li>
</ul>
</div>
<div class="product-container">
<div class="products-grid first">

<?php do { ?>
<div class="span3 item">
<div class="item-inner">
<a href="click-sub-categorias.php?tokem=<?php echo base64_encode($row_TodSubCat["id_subcategoria"]);?>" title="<?php echo $row_TodSubCat['nom_subcat']; ?>" class="product-image">
<img src="img.php?imagen=imagenes/subcategorias/<?php echo $row_TodSubCat['img_subcat']; ?>&ancho=156&alto=156&&cut&mark=false" alt="<?php echo $row_TodSubCat['nom_subcat']; ?>" title="<?php echo $row_TodSubCat['nom_subcat']; ?>" width="156" height="156" />
</a>
<h2 class="product-name">
<a href="click-sub-categorias.php?tokem=<?php echo base64_encode($row_TodSubCat["id_subcategoria"]);?>" title="<?php echo $row_TodSubCat['nom_subcat']; ?>"><?php echo $row_TodSubCat['nom_subcat']; ?></a>
</h2>
       
<button type="button" class="button" onclick="location.href='click-sub-categorias.php?tokem=<?php echo base64_encode($row_TodSubCat["id_subcategoria"]);?>'" >
<span>
<span class="button btn-cart">Ver Detalle</span>
</span>
</button>
</div>
</div>
<?php } while ($row_TodSubCat = mysql_fetch_assoc($TodSubCat)); ?>

</div>
</div>


<div class="toolbar-bottom">
<div class="toolbar">
<div class="pager">
<div class="sort-by hidden-phone">

<?php if ($pageNum_TodSubCat > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, 0, $queryString_TodSubCat)  ?>">Principio</a>
<?php } // Show if not first page ?>
<?php if ($pageNum_TodSubCat > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, max(0, $pageNum_TodSubCat - 1), $queryString_TodSubCat); ?>"><</a>
<?php } // Show if not first page ?>

<?php if ($pageNum_TodSubCat || $totalPages_TodSubCat > 0) { // Show if not first page ?>
<span class="current">Pagina <?php echo ("$pageNum_TodSubCat")+1 ?> / <?php echo ("$totalPages_TodSubCat")+1 ?></span>
<?php } // Show if not first page ?>  
              
<?php if ($pageNum_TodSubCat < $totalPages_TodSubCat) { // Show if not last page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, min($totalPages_TodSubCat, $pageNum_TodSubCat + 1), $queryString_TodSubCat); ?>">></a>
<?php } // Show if not last page ?>
<?php if ($pageNum_TodSubCat < $totalPages_TodSubCat) { // Show if not last page ?>
<a href="<?php printf("%s?pagina=%d%s", $currentPage, $totalPages_TodSubCat, $queryString_TodSubCat); ?>">Final</a>
<?php } // Show if not last page ?>  


</div>
</div>
</div>
</div>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_TodSubCat == 0) { // Show if recordset empty ?>
<div class="product-container">
<div class="products-grid first">
<h3 style="margin-bottom:-17px; padding:5px 0;">Lo sentimos No se encontró ninguna categoria <a href="/todos-nuestros-productos" title="catalogo de lenceria hotsecrets">Ir al catalogo completo</a></h3>

</div>
</div>
<?php } // Show if recordset empty ?>
