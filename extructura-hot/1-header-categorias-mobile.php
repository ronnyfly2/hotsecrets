<?php 
$maxRows_Recordset1 = 6;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Recordset1 = "SELECT * FROM categorias WHERE categorias.estado_categoria = 1";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $HotSecrets) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<?php do { ?>
<li class="level0 nav-2 level-top">
<a href="click-categorias.php?lista=<?php echo base64_encode($row_Recordset1["id_categoria"]);?>" title="<?php echo $row_Recordset1['desc_cate']; ?>" class="level-top">
<span><?php echo $row_Recordset1['nom_cate']; ?></span>
</a>
</li>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<?php
mysql_free_result($Recordset1);
?>
