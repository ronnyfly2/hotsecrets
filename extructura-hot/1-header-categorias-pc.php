<?php 
$maxRows_CatePca = 4;
$pageNum_CatePca = 0;
if (isset($_GET['pageNum_CatePca'])) {
  $pageNum_CatePca = $_GET['pageNum_CatePca'];
}
$startRow_CatePca = $pageNum_CatePca * $maxRows_CatePca;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_CatePca = "SELECT * FROM categorias WHERE categorias.estado_categoria = 1";
$query_limit_CatePca = sprintf("%s LIMIT %d, %d", $query_CatePca, $startRow_CatePca, $maxRows_CatePca);
$CatePca = mysql_query($query_limit_CatePca, $HotSecrets) or die(mysql_error());
$row_CatePca = mysql_fetch_assoc($CatePca);

if (isset($_GET['totalRows_CatePca'])) {
  $totalRows_CatePca = $_GET['totalRows_CatePca'];
} else {
  $all_CatePca = mysql_query($query_CatePca);
  $totalRows_CatePca = mysql_num_rows($all_CatePca);
}
$totalPages_CatePca = ceil($totalRows_CatePca/$maxRows_CatePca)-1;
?>
<?php do { ?>
<div id="pt_menu135" class="pt_menu pt_menu_no_child">
<div class="parentMenu">
<a href="click-categorias.php?lista=<?php echo base64_encode($row_CatePca["id_categoria"]);?>" title="<?php echo $row_CatePca['nom_cate']; ?> <?php echo $row_CatePca['desc_cate']; ?>">
<span><?php echo $row_CatePca['nom_cate']; ?></span>
</a>  
</div>
</div>
  <?php } while ($row_CatePca = mysql_fetch_assoc($CatePca)); ?>
<?php
mysql_free_result($CatePca);
?>
