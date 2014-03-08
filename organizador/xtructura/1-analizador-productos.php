<?php 
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ProducAct = "SELECT * FROM productos WHERE productos.estado_producto = 1";
$ProducAct = mysql_query($query_ProducAct, $HotSecrets) or die(mysql_error());
$row_ProducAct = mysql_fetch_assoc($ProducAct);
$totalRows_ProducAct = mysql_num_rows($ProducAct);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ProducInact = "SELECT * FROM productos WHERE productos.estado_producto = 0";
$ProducInact = mysql_query($query_ProducInact, $HotSecrets) or die(mysql_error());
$row_ProducInact = mysql_fetch_assoc($ProducInact);
$totalRows_ProducInact = mysql_num_rows($ProducInact);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_EnOfert = "SELECT * FROM productos WHERE oferta_producto = 1";
$EnOfert = mysql_query($query_EnOfert, $HotSecrets) or die(mysql_error());
$row_EnOfert = mysql_fetch_assoc($EnOfert);
$totalRows_EnOfert = mysql_num_rows($EnOfert);
?>
<?php $todoProductos = $totalRows_ProducAct+$totalRows_ProducInact ?>
<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol terques">
<i class="fa fa-bitbucket"></i>
</div>
<div class="value">
<h1 class="prodactivos">
0
</h1>
<p>Productos Activos</p>
</div>
</section>
</div>
<script>
function countUp5(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.prodactivos'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp5(<?php echo $totalRows_ProducAct; ?>);
</script>

<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol red">
<i class="fa fa-bitbucket"></i>
</div>
<div class="value">
<h1 class="prodinactvos">
0
</h1>
<p>Productos Inactivos</p>
</div>
</section>
</div>
<script>
function countUp6(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.prodinactvos'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp6(<?php echo $totalRows_ProducInact; ?>);
</script>

<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol yellow">
<i class="fa fa-bitbucket"></i>
</div>
<div class="value">
<h1 class="productofert">
0
</h1>
<p>Productos En Oferta</p>
</div>
</section>
</div>
<script>
function countUp7(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.productofert'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp7(<?php echo $totalRows_EnOfert; ?>);
</script>

<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol blue">
<i class="fa fa-bitbucket"></i>
</div>
<div class="value">
<h1 class="totalProd">
0
</h1>
<p>Total de Productos</p>
</div>
</section>
</div>
<script>
function countUp8(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.totalProd'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp8(<?php echo $todoProductos; ?>);
</script>
</div>
<?php
mysql_free_result($ProducAct);
mysql_free_result($ProducInact);
mysql_free_result($EnOfert);
?>
