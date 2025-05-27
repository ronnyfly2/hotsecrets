<?php 
// This file is included by organizador/lista-categorias.php, which already includes Connections/HotSecrets.php
// and should have validated $HotSecrets as a mysqli object.

// Query to list categories
$query_ListaCate = "SELECT id_categoria, nom_cate, desc_cate, img_cate, estado_categoria FROM categorias ORDER BY id_categoria DESC"; // Added ORDER BY for consistency
$stmt_ListaCate = $HotSecrets->prepare($query_ListaCate);

$ListaCate_result_array = [];
$totalRows_ListaCate = 0;

if ($stmt_ListaCate) {
    if ($stmt_ListaCate->execute()) {
        $ListaCate_result = $stmt_ListaCate->get_result();
        while ($row = $ListaCate_result->fetch_assoc()) {
            $ListaCate_result_array[] = $row;
        }
        $totalRows_ListaCate = count($ListaCate_result_array);
        if ($ListaCate_result instanceof mysqli_result) {
            $ListaCate_result->free();
        }
    } else {
        error_log("Execute failed (SELECT categorias) in 1-contenido-lista-categorias.php: (" . $stmt_ListaCate->errno . ") " . $stmt_ListaCate->error);
    }
    $stmt_ListaCate->close();
} else {
    error_log("Prepare failed (SELECT categorias) in 1-contenido-lista-categorias.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
}
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
<?php 
if (!empty($ListaCate_result_array)) {
    foreach ($ListaCate_result_array as $row_ListaCate) { ?>
<tr>
<td><?php echo htmlspecialchars($row_ListaCate['id_categoria']); ?></td>
<td><?php echo htmlspecialchars($row_ListaCate['nom_cate']); ?></td>
<td><?php echo htmlspecialchars(substr($row_ListaCate['desc_cate'], 0, 100)); ?>...</td> <!-- Shorten description for display -->
<td>
    <?php if (!empty($row_ListaCate['img_cate'])) : ?>
    <img src="../imagenes/categorias/<?php echo htmlspecialchars($row_ListaCate['img_cate']); ?>" width="68" height="68" alt="<?php echo htmlspecialchars($row_ListaCate['nom_cate']); ?>" />
    <?php else: ?>
    Sin imagen
    <?php endif; ?>
</td>
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
<a href="editar-categoria.php?editar=<?php echo htmlspecialchars($row_ListaCate['id_categoria']); ?>" title="editar">
<button class="btn btn-warning btn-xs">
<i class="fa fa-pencil"></i>
</button>
</a>
<a href="eliminar-categoria.php?idcategoria=<?php echo htmlspecialchars($row_ListaCate['id_categoria']); ?>" title="eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta categoría?');">
<button class="btn btn-danger btn-xs">
<i class="fa fa-trash-o"></i>
</button>
</a>
</td>
</tr>
<?php 
    } // end foreach
} else { ?>
<tr><td colspan="6">No hay categorías para mostrar.</td></tr>
<?php } ?>
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
// Result and statement are already closed/freed in the PHP block above.
?>