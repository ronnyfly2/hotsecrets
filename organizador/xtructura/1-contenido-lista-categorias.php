<?php 
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ListaCate = "SELECT * FROM categorias";
$ListaCate = mysql_query($query_ListaCate, $HotSecrets) or die(mysql_error());
$row_ListaCate = mysql_fetch_assoc($ListaCate);
$totalRows_ListaCate = mysql_num_rows($ListaCate);
?>
<section class="wrapper site-min-height">
<!-- page start-->
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">Lista Categorias</header>
<div class="panel-body">
<div class="adv-table">
<div class="clearfix">
<div class="btn-group">
<button id="editable-sample_new" class="btn green">
<a style="color:#FFF;" href="agregar-categoria.php">Agregar Categoria</a> 
<i class="fa fa-plus"></i>
</button>
</div>
</div>
<table class="display table table-bordered table-striped" id="tabla-color">
<thead>
<tr>
<th>Id</th>
<th>Nombre</th>
<th>Detalle</th>
<th>Imagen</th>
<th>Estado</th>
<th>Opciones</th>
</tr>
</thead>
<tbody>
<?php do { ?>
<tr>
<td><?php echo $row_ListaCate['id_categoria']; ?></td>
<td><?php echo $row_ListaCate['nom_cate']; ?></td>
<td><?php echo $row_ListaCate['desc_cate']; ?></td>
<td><img src="../imagenes/categorias/<?php echo $row_ListaCate['img_cate']; ?>" width="68" height="68" /></td>
<td>
<?php if ($row_ListaCate['estado_categoria'] == 0) { ?>
<span class="label label-danger label-mini">Inactivo</span>
<?php } ?>
<?php if ($row_ListaCate['estado_categoria'] > 0) { ?>
<span class="label label-success label-mini">Activo</span>
<?php } ?>
</td>
<td>
<!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
<a href="editar-categoria.php" title="editar">
<button class="btn btn-warning btn-xs">
<i class="fa fa-pencil"></i>
</button>
</a>
<a href="eliminar-categoria.php" title="eliminar">
<button class="btn btn-danger btn-xs">
<i class="fa fa-trash-o"></i>
</button>
</a>
</td>
</tr>
<?php } while ($row_ListaCate = mysql_fetch_assoc($ListaCate)); ?>
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
mysql_free_result($ListaCate);
?>