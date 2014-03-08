<?php 
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_UsuariosActivos = "SELECT * FROM usuarios WHERE usuarios.estado = 1 ";
$UsuariosActivos = mysql_query($query_UsuariosActivos, $HotSecrets) or die(mysql_error());
$row_UsuariosActivos = mysql_fetch_assoc($UsuariosActivos);
$totalRows_UsuariosActivos = mysql_num_rows($UsuariosActivos);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_UsuariosInacti = "SELECT * FROM usuarios WHERE usuarios.estado = 0 ";
$UsuariosInacti = mysql_query($query_UsuariosInacti, $HotSecrets) or die(mysql_error());
$row_UsuariosInacti = mysql_fetch_assoc($UsuariosInacti);
$totalRows_UsuariosInacti = mysql_num_rows($UsuariosInacti);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_UsuariosSinDir = "SELECT * FROM usuarios WHERE usuarios.id_departamento = 0 ";
$UsuariosSinDir = mysql_query($query_UsuariosSinDir, $HotSecrets) or die(mysql_error());
$row_UsuariosSinDir = mysql_fetch_assoc($UsuariosSinDir);
$totalRows_UsuariosSinDir = mysql_num_rows($UsuariosSinDir);
?>
<?php $todoUsuarios = $totalRows_UsuariosInacti+$totalRows_UsuariosActivos ?>
<div class="row state-overview">
<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol terques">
<i class="fa fa-user"></i>
</div>
<div class="value">
<h1 class="actiusu">
0
</h1>
<p>Usuarios Activos</p>
</div>
</section>
</div>
<script>
function countUp1(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.actiusu'),
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
countUp1(<?php echo $totalRows_UsuariosActivos; ?>);
</script>

<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol red">
<i class="fa fa-user"></i>
</div>
<div class="value">
<h1 class="usuariosinactivos">
0
</h1>
<p>Usuarios Inactivos</p>
</div>
</section>
</div>
<script>
function countUp2(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.usuariosinactivos'),
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
countUp2(<?php echo $totalRows_UsuariosInacti; ?>);
</script>

<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol yellow">
<i class="fa fa-user"></i>
</div>
<div class="value">
<h1 class="sindirec">
0
</h1>
<p>Usuarios Sin Direccion</p>
</div>
</section>
</div>
<script>
function countUp3(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.sindirec'),
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
countUp3(<?php echo $totalRows_UsuariosSinDir; ?>);
</script>

<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol blue">
<i class="fa fa-user"></i>
</div>
<div class="value">
<h1 class="totalusu">
0
</h1>
<p>Total de Usuarios</p>
</div>
</section>
</div>
<script>
function countUp4(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.totalusu'),
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
countUp4(<?php echo $todoUsuarios; ?>);
</script>
<!--
<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol red">
<i class="fa fa-tags"></i>
</div>
<div class="value">
<h1 class=" count2">
0
</h1>
<p>Ventas</p>
</div>
</section>
</div>
<div class="col-lg-3 col-sm-6">
<section class="panel">
<div class="symbol yellow">
<i class="fa fa-shopping-cart"></i>
</div>
<div class="value">
<h1 class=" count3">
0
</h1>
<p>Compras</p>
</div>
</section>
</div>
-->
<?php
mysql_free_result($UsuariosActivos);
mysql_free_result($UsuariosInacti);
mysql_free_result($UsuariosSinDir);
?>
