<?php 
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_AsideBan = "SELECT * FROM banners_publicidad WHERE banners_publicidad.estado_banner=1";
$AsideBan = mysql_query($query_AsideBan, $HotSecrets) or die(mysql_error());
$row_AsideBan = mysql_fetch_assoc($AsideBan);
$totalRows_AsideBan = mysql_num_rows($AsideBan);
?>
<div class="block block-banner-right">
<a href="<?php echo $row_AsideBan['url_banner']; ?>" title="<?php echo $row_AsideBan['nom_banner']; ?>" target="_blank">
<img src="img.php?imagen=imagenes/publicidad/banners-aside/<?php echo $row_AsideBan['img_banner']; ?>&ancho=270&alto=357&cut&mark=false" alt="<?php echo $row_AsideBan['nom_banner']; ?>" title="<?php echo $row_AsideBan['nom_banner']; ?>" />
</a>
</div>
<?php
mysql_free_result($AsideBan);
?>
