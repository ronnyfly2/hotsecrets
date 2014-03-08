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
<a style="color:#FFF;" href="agregar-producto.php">Total de Visitas <?php echo $totalRows_Visitas; ?></a> 
<i class="fa fa-plus"></i>
</button>
</div>
</div>
<table class="display table table-bordered table-striped" id="tabla-color">
<thead>
<tr>

<th>Fecha de visita</th>
<th>Hora de visita</th>
<th>Url De referencia</th>
<th>Detalles</th>
</tr>
</thead>
<tbody>
<?php do { ?>
<tr>
<td>
<?php echo $row_Visitas['fecha_click']; ?>  
</td>
<td>
<?php echo $row_Visitas['hora_click']; ?> 
</td>

<td>
<?php echo $row_Visitas['url_referen']; ?>
</td>

<td><?php echo $row_Visitas['navegador_click']; ?></td>

</tr>
 <?php } while ($row_Visitas = mysql_fetch_assoc($Visitas)); ?>
</tbody>
</table>
</div>
</div>
</section>
</div>
</div>
<!-- page end-->
</section>