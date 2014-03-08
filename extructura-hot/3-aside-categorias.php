<?php 
$maxRows_AsideCate = 10;
$pageNum_AsideCate = 0;
if (isset($_GET['pageNum_AsideCate'])) {
  $pageNum_AsideCate = $_GET['pageNum_AsideCate'];
}
$startRow_AsideCate = $pageNum_AsideCate * $maxRows_AsideCate;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_AsideCate = "SELECT * FROM categorias WHERE categorias.estado_categoria = 1 ORDER BY categorias.id_categoria DESC";
$query_limit_AsideCate = sprintf("%s LIMIT %d, %d", $query_AsideCate, $startRow_AsideCate, $maxRows_AsideCate);
$AsideCate = mysql_query($query_limit_AsideCate, $HotSecrets) or die(mysql_error());
$row_AsideCate = mysql_fetch_assoc($AsideCate);

if (isset($_GET['totalRows_AsideCate'])) {
  $totalRows_AsideCate = $_GET['totalRows_AsideCate'];
} else {
  $all_AsideCate = mysql_query($query_AsideCate);
  $totalRows_AsideCate = mysql_num_rows($all_AsideCate);
}
$totalPages_AsideCate = ceil($totalRows_AsideCate/$maxRows_AsideCate)-1;
?>

<div class="block block-verticalmenu">
<div class="block-title">
<strong><span>Categorias</span></strong>
</div>
<div class="block-content">
<ul id="ma-accordion" class="accordion">
<?php do { ?>
<li class="level0 level-top first">
<a href="click-categorias.php?lista=<?php echo base64_encode($row_AsideCate["id_categoria"]);?>" title="<?php echo $row_AsideCate['nom_cate']; ?>" class="level-top">
<span><?php echo $row_AsideCate['nom_cate']; ?></span>
</a>
</li>
<?php } while ($row_AsideCate = mysql_fetch_assoc($AsideCate)); ?>
</ul>
</div>
</div>
<?php
mysql_free_result($AsideCate);
?>