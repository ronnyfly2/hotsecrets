<?php 
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ListProd = "SELECT * FROM productos";
$ListProd = mysql_query($query_ListProd, $HotSecrets) or die(mysql_error());
$row_ListProd = mysql_fetch_assoc($ListProd);
$totalRows_ListProd = mysql_num_rows($ListProd);
?>

<section class="wrapper site-min-height">
<!-- page start-->
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">Lista Productos</header>
<div class="panel-body">
<div class="adv-table">
<div class="clearfix">
<div class="btn-group">
<button id="editable-sample_new" class="btn green">
<a style="color:#FFF;" href="agregar-producto.php">Agregar Producto</a> 
<i class="fa fa-plus"></i>
</button>
</div>
</div>
<table class="display table table-bordered table-striped" id="tabla-color">
<thead>
<tr>
<th>Id</th>
<th>Nombre</th>
<th>¿Oferta?</th>
<th>Precio Normal Y Oferta</th>
<th>Imagen</th>
<th>Estado</th>
<th>Opciones</th>
</tr>
</thead>
<tbody>
<?php do { ?>
<tr>
<td><?php echo $row_ListProd['id_producto']; ?></td>
<td><?php echo $row_ListProd['nom_producto']; ?></td>
<td>
<?php if ($row_ListProd['oferta_producto'] == 0) { ?>
<span class="label label-danger label-mini">No</span>
<?php } ?>
<?php if ($row_ListProd['oferta_producto'] > 0) { ?>
<span class="label label-success label-mini">Si</span>
<?php } ?>
</td>
<td>
<?php if ($row_ListProd['oferta_producto'] > 0) {?>
<b style="color:red;">S/.<?php echo number_format($row_ListProd['precio_oferta_producto'],2, '.', ''); ?></b>
<br />
<b style="color:blue; font-size:10px; text-decoration:line-through;">S/.<?php echo number_format($row_ListProd['precio_normal_producto'],2, '.', ''); ?></b>
<?php } ?>
<?php if ($row_ListProd['oferta_producto'] == 0) { ?>
<b style="color:blue;">S/.<?php echo number_format($row_ListProd['precio_normal_producto'],2, '.', ''); ?></b>
<?php } ?>
</td>

<td><img src="../imagenes/productos/<?php echo $row_ListProd['img_producto']; ?>" width="68" height="68" /></td>
<td>
<?php if ($row_ListProd['estado_producto'] == 0) { ?>
<span class="label label-danger label-mini">Inactivo</span>
<?php } ?>
<?php if ($row_ListProd['estado_producto'] > 0) { ?>
<span class="label label-success label-mini">Activo</span>
<?php } ?>
</td>
<td>


<!--<a href="subir-imagenes-producto.php" title="subir imagenes">
<button type="button" data-original-title="Popovers in top" data-content="And here's some amazing content. It's very engaging. right?" data-placement="top" data-trigger="hover" class="btn btn-info btn-xs popovers">
<i class="fa fa-camera-retro"></i>
</button>
</a>-->
 
<a href="lista-visitas-producto.php?detalles=<?php echo $row_ListProd['id_producto']; ?>">
<button type="button" data-toggle="tooltip" data-original-title="Visitas: <?php echo $row_ListProd['clicks_producto']; ?>. Clic para más detalles de visitas" data-placement="top" class="btn btn-white btn-xs tooltips">
<i class="fa fa-eye text-info"></i>
</button>
</a>

<a href="lista-imagenes-producto.php?imgprod=<?php echo $row_ListProd['id_producto']; ?>">
<button type="button" data-toggle="tooltip" data-original-title="Lista de Imagenes del Producto" data-placement="top" class="btn btn-info btn-xs tooltips">
<i class="fa fa-camera-retro"></i>
</button>
</a>

<a href="lista-tallas-producto.php?tallprod=<?php echo $row_ListProd['id_producto']; ?>">
<button type="button" data-toggle="tooltip" data-original-title="Agregar tallas para este producto" data-placement="top" class="btn btn-primary btn-xs tooltips">
<i class="fa fa-bookmark"></i>
</button>
</a>

<a href="lista-color-producto.php?colorprod=<?php echo $row_ListProd['id_producto']; ?>">
<button type="button" data-toggle="tooltip" data-original-title="Agregar colores para este producto" data-placement="top" class="btn btn-default btn-xs tooltips">
<i class="fa fa-asterisk"></i>
</button>
</a>

<a href="editar-producto.php?editarprod=<?php echo $row_ListProd['id_producto']; ?>">
<button type="button" data-toggle="tooltip" data-original-title="Editar producto" data-placement="top" class="btn btn-warning btn-xs tooltips">
<i class="fa fa-pencil"></i>
</button>
</a>
<a href="eliminar-producto.php">
<button type="button" data-toggle="tooltip" data-original-title="Eliminar producto" data-placement="top" class="btn btn-danger btn-xs tooltips">
<i class="fa fa-trash-o"></i>
</button>
</a>
</td>
</tr>
<?php } while ($row_ListProd = mysql_fetch_assoc($ListProd)); ?>
</tbody>
</table>
</div>
</div>
</section>
</div>
</div>
<!-- page end-->
</section>
<?php
mysql_free_result($ListProd);
?>