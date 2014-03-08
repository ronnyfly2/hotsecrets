<?php
$maxRows_CategPcz = 16;
$pageNum_CategPcz = 0;
if (isset($_GET['pageNum_CategPcz'])) {
  $pageNum_CategPcz = $_GET['pageNum_CategPcz'];
}
$startRow_CategPcz = $pageNum_CategPcz * $maxRows_CategPcz;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_CategPcz = "SELECT * FROM categorias WHERE categorias.estado_categoria = 1 AND categorias.id_categoria > 5";
$query_limit_CategPcz = sprintf("%s LIMIT %d, %d", $query_CategPcz, $startRow_CategPcz, $maxRows_CategPcz);
$CategPcz = mysql_query($query_limit_CategPcz, $HotSecrets) or die(mysql_error());
$row_CategPcz = mysql_fetch_assoc($CategPcz);

if (isset($_GET['totalRows_CategPcz'])) {
  $totalRows_CategPcz = $_GET['totalRows_CategPcz'];
} else {
  $all_CategPcz = mysql_query($query_CategPcz);
  $totalRows_CategPcz = mysql_num_rows($all_CategPcz);
}
$totalPages_CategPcz = ceil($totalRows_CategPcz/$maxRows_CategPcz)-1;
?>
<div id="popup_pt_item_menu_custom_menu" class="popup cmsblock" style="display: none; width:800px;">
<div class="block2" id="block2_pt_item_menu_custom_menu">

<!--<div class="span2">
<div class="static-menu-img">
<a href="#"><img src="imagenes/custom_menu2.jpg" alt="" /></a>
</div>
<a href="#"><p>Categoria-4</p></a>
</div>-->
<?php do { ?>
<div class="span2">
<a href="click-categorias.php?lista=<?php echo base64_encode($row_CategPcz["id_categoria"]);?>"><p><?php echo $row_CategPcz['nom_cate']; ?></p></a>    
</div>
<?php } while ($row_CategPcz = mysql_fetch_assoc($CategPcz)); ?>
</div>
</div>
<?php
mysql_free_result($CategPcz);
?>
