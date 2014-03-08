<?php
require_once('Connections/HotSecrets.php');
$tokem=base64_decode($_GET["lista"]);
//echo $tokem;
//******************************************************************
//$sql="UPDATE bannerw SET clicks" 
	//." values "
	//." ('$tokem',clicks)";

//acá contamos el clic
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Categorias = "update categorias set clicks=clicks+1 where id_categoria=$tokem";
$Categorias = mysql_query($query_Categorias, $HotSecrets) or die(mysql_error());
	#$row_Relacionados = mysql_fetch_assoc($Relacionados);
	#$totalRows_Relacionados = mysql_num_rows($Relacionados);

//*************************************************************
//obtenemos la URL del banner
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Categorias ="select urlseo from categorias where id_categoria=$tokem ";
$Categorias = mysql_query($query_Categorias, $HotSecrets) or die(mysql_error());
if ($row_Categorias=mysql_fetch_array($Categorias))
{
	//echo $fila["enlace"];
	header("Location: categoria-".$row_Categorias["urlseo"]."/");
		 //header ("Location: ".$row_Destacados["urlseo"].".html");
	//header("Location: ".$row_Destacados["id_producto"]);
	
}
?>