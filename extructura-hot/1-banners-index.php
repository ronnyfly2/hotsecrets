<?php 
$maxRows_BannerIndex = 5;
$pageNum_BannerIndex = 0;
if (isset($_GET['pageNum_BannerIndex'])) {
  $pageNum_BannerIndex = $_GET['pageNum_BannerIndex'];
}
$startRow_BannerIndex = $pageNum_BannerIndex * $maxRows_BannerIndex;

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_BannerIndex = "SELECT * FROM banners_publicidad WHERE banners_publicidad.cate_banner = 1 AND banners_publicidad.estado_banner = 1";
$query_limit_BannerIndex = sprintf("%s LIMIT %d, %d", $query_BannerIndex, $startRow_BannerIndex, $maxRows_BannerIndex);
$BannerIndex = mysql_query($query_limit_BannerIndex, $HotSecrets) or die(mysql_error());
$row_BannerIndex = mysql_fetch_assoc($BannerIndex);

if (isset($_GET['totalRows_BannerIndex'])) {
  $totalRows_BannerIndex = $_GET['totalRows_BannerIndex'];
} else {
  $all_BannerIndex = mysql_query($query_BannerIndex);
  $totalRows_BannerIndex = mysql_num_rows($all_BannerIndex);
}
$totalPages_BannerIndex = ceil($totalRows_BannerIndex/$maxRows_BannerIndex)-1;
?>

<div class="ma-banner7-container">
<div class="flexslider ma-nivoslider">
<div class="ma-loading"></div>
<div id="ma-inivoslider" class="slides">			
<?php do { ?>
<a href="#"><img style="display: none;" src="imagenes/publicidad/banners-index/<?php echo $row_BannerIndex['img_banner']; ?>" alt="<?php echo $row_BannerIndex['nom_banner']; ?>" title="<?php echo $row_BannerIndex['nom_banner']; ?>"  /></a>
<?php } while ($row_BannerIndex = mysql_fetch_assoc($BannerIndex)); ?>
</div>
<script type="text/javascript">
$jq(window).load(function() {
$jq('#ma-inivoslider').nivoSlider({
effect: 'random',
slices: 15,
boxCols: 8,
boxRows: 4,
animSpeed: 600,
pauseTime: 5000,
startSlide: 0,
controlNav: false,
controlNavThumbs: false,
pauseOnHover: true,
manualAdvance: false,
prevText: 'Prev',
nextText: 'Next',
afterLoad: function(){
$jq('.ma-loading').css("display","none");
//$jq('.banner7-title, .banner7-des, .banner7-readmore').css("left","100px") ;
},     
//beforeChange: function(){ 
//$jq('.banner7-title, .banner7-des').css("left","-550px" );
//$jq('.banner7-readmore').css("left","-1500px"); 
//}, 
//afterChange: function(){ 
//$jq('.banner7-title, .banner7-des, .banner7-readmore').css("left","100px") 
//}
});
});
</script>
</div>
</div>
<?php
mysql_free_result($BannerIndex);
?>