<?php
require_once('Connections/HotSecrets.php');
$tokem=base64_decode($_GET["tokem"]);
//echo $tokem;
//******************************************************************
//$sql="UPDATE bannerw SET clicks" 
	//." values "
	//." ('$tokem',clicks)";

//acá contamos el clic
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Relacionados = "update subcategorias set clicks=clicks+1 where id_subcategoria=$tokem";
$Relacionados = mysql_query($query_Relacionados, $HotSecrets) or die(mysql_error());
	#$row_Relacionados = mysql_fetch_assoc($Relacionados);
	#$totalRows_Relacionados = mysql_num_rows($Relacionados);

//*************************************************************
//obtenemos la URL del banner
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Relacionados ="select url_seo_subcat from subcategorias where id_subcategoria=$tokem";
$Relacionados = mysql_query($query_Relacionados, $HotSecrets) or die(mysql_error());
if ($row_Relacionados=mysql_fetch_array($Relacionados))
{
	//echo $fila["enlace"];
	header("Location: sub-categoria-".$row_Relacionados["url_seo_subcat"]."/");
		 //header ("Location: ".$row_Destacados["urlseo"].".html");
	//header("Location: ".$row_Destacados["id_producto"]);
	
}
?>