<?php 
// This file is included by organizador/lista-productos.php, 
// which already includes Connections/HotSecrets.php and should have validated $HotSecrets as a mysqli object.

// Ensure $HotSecrets is a valid mysqli object (defensive check)
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in 1-contenido-lista-productos.php");
    echo "<p>Error de conexión a la base de datos. No se pueden listar los productos.</p>";
    // Do not proceed further if connection is not valid.
    return; 
}

// Query to list products
// Selecting specific columns is better than SELECT *
$query_ListProd = "SELECT id_producto, nom_producto, oferta_producto, precio_oferta_producto, precio_normal_producto, img_producto, estado_producto, clicks_producto FROM productos ORDER BY id_producto DESC";
$stmt_ListProd = $HotSecrets->prepare($query_ListProd);

$products_array = [];
$totalRows_ListProd = 0;

if ($stmt_ListProd) {
    if ($stmt_ListProd->execute()) {
        $ListProd_result = $stmt_ListProd->get_result();
        while ($row = $ListProd_result->fetch_assoc()) {
            $products_array[] = $row;
        }
        $totalRows_ListProd = count($products_array); // Get total rows from the fetched array
        if ($ListProd_result instanceof mysqli_result) {
            $ListProd_result->free();
        }
    } else {
        error_log("Execute failed (SELECT productos) in 1-contenido-lista-productos.php: (" . $stmt_ListProd->errno . ") " . $stmt_ListProd->error);
    }
    $stmt_ListProd->close();
} else {
    error_log("Prepare failed (SELECT productos) in 1-contenido-lista-productos.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
}
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
<?php 
if (!empty($products_array)) {
    foreach ($products_array as $row_ListProd) { ?>
<tr>
<td><?php echo htmlspecialchars($row_ListProd['id_producto']); ?></td>
<td><?php echo htmlspecialchars($row_ListProd['nom_producto']); ?></td>
<td>
<?php if ($row_ListProd['oferta_producto'] == 0) { ?>
<span class="label label-danger label-mini">No</span>
<?php } ?>
<?php if ($row_ListProd['oferta_producto'] > 0) { ?>
<span class="label label-success label-mini">Si</span>
<?php } ?>
</td>
<td>
<?php 
// Ensure prices are treated as numbers for formatting, and handle potential nulls for oferta_producto
$precio_oferta = !empty($row_ListProd['precio_oferta_producto']) ? (float)$row_ListProd['precio_oferta_producto'] : 0;
$precio_normal = (float)$row_ListProd['precio_normal_producto'];

if ($row_ListProd['oferta_producto'] > 0 && $precio_oferta > 0) {?>
<b style="color:red;">S/.<?php echo htmlspecialchars(number_format($precio_oferta, 2, '.', '')); ?></b>
<br />
<b style="color:blue; font-size:10px; text-decoration:line-through;">S/.<?php echo htmlspecialchars(number_format($precio_normal, 2, '.', '')); ?></b>
<?php } else { ?>
<b style="color:blue;">S/.<?php echo htmlspecialchars(number_format($precio_normal, 2, '.', '')); ?></b>
<?php } ?>
</td>

<td>
    <?php if (!empty($row_ListProd['img_producto'])) : ?>
    <img src="../imagenes/productos/<?php echo htmlspecialchars($row_ListProd['img_producto']); ?>" width="68" height="68" alt="<?php echo htmlspecialchars($row_ListProd['nom_producto']); ?>" />
    <?php else: ?>
    Sin imagen
    <?php endif; ?>
</td>
<td>
<?php if ($row_ListProd['estado_producto'] == 0) { ?>
<span class="label label-danger label-mini">Inactivo</span>
<?php } ?>
<?php if ($row_ListProd['estado_producto'] > 0) { ?>
<span class="label label-success label-mini">Activo</span>
<?php } ?>
</td>
<td>
<a href="lista-visitas-producto.php?detalles=<?php echo htmlspecialchars($row_ListProd['id_producto']); ?>">
<button type="button" data-toggle="tooltip" data-original-title="Visitas: <?php echo htmlspecialchars($row_ListProd['clicks_producto']); ?>. Clic para más detalles de visitas" data-placement="top" class="btn btn-white btn-xs tooltips">
<i class="fa fa-eye text-info"></i>
</button>
</a>

<a href="lista-imagenes-producto.php?imgprod=<?php echo htmlspecialchars($row_ListProd['id_producto']); ?>">
<button type="button" data-toggle="tooltip" data-original-title="Lista de Imagenes del Producto" data-placement="top" class="btn btn-info btn-xs tooltips">
<i class="fa fa-camera-retro"></i>
</button>
</a>

<a href="lista-tallas-producto.php?tallprod=<?php echo htmlspecialchars($row_ListProd['id_producto']); ?>">
<button type="button" data-toggle="tooltip" data-original-title="Agregar tallas para este producto" data-placement="top" class="btn btn-primary btn-xs tooltips">
<i class="fa fa-bookmark"></i>
</button>
</a>

<a href="lista-color-producto.php?colorprod=<?php echo htmlspecialchars($row_ListProd['id_producto']); ?>">
<button type="button" data-toggle="tooltip" data-original-title="Agregar colores para este producto" data-placement="top" class="btn btn-default btn-xs tooltips">
<i class="fa fa-asterisk"></i>
</button>
</a>

<a href="editar-producto.php?editarprod=<?php echo htmlspecialchars($row_ListProd['id_producto']); ?>">
<button type="button" data-toggle="tooltip" data-original-title="Editar producto" data-placement="top" class="btn btn-warning btn-xs tooltips">
<i class="fa fa-pencil"></i>
</button>
</a>
<a href="eliminar-producto.php?idproducto=<?php echo htmlspecialchars($row_ListProd['id_producto']); ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?');">
<button type="button" data-toggle="tooltip" data-original-title="Eliminar producto" data-placement="top" class="btn btn-danger btn-xs tooltips">
<i class="fa fa-trash-o"></i>
</button>
</a>
</td>
</tr>
<?php 
    } // end foreach
} else { ?>
<tr><td colspan="7">No hay productos para mostrar.</td></tr>
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
// Results and statements are closed/freed in the PHP block at the top of the file.
?>