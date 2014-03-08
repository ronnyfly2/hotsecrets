<?php
require_once('Connections/HotSecrets.php');
$tokem=base64_decode($_GET["tokem"]);
function getBrowser() 
{ 
$u_agent = $_SERVER['HTTP_USER_AGENT']; 
$bname = 'Unknown';
$platform = 'Unknown';
$version= "";
// Next get the name of the useragent yes seperately and for good reason
if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
{ 
$bname = 'Internet Explorer'; 
$ub = "MSIE"; 
} 
elseif(preg_match('/Firefox/i',$u_agent)) 
{ 
$bname = 'Mozilla Firefox'; 
$ub = "Firefox"; 
} 
elseif(preg_match('/Chrome/i',$u_agent)) 
{ 
$bname = 'Google Chrome'; 
$ub = "Chrome"; 
} 
elseif(preg_match('/Safari/i',$u_agent)) 
{ 
$bname = 'Apple Safari'; 
$ub = "Safari"; 
} 
elseif(preg_match('/Opera/i',$u_agent)) 
{ 
$bname = 'Opera'; 
$ub = "Opera"; 
} 
elseif(preg_match('/Netscape/i',$u_agent)) 
{ 
$bname = 'Netscape'; 
$ub = "Netscape"; 
} 

// finally get the correct version number
$known = array('Version', $ub, 'other');
$pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
if (!preg_match_all($pattern, $u_agent, $matches)) {
// we have no matching number just continue
}

// see how many we have
$i = count($matches['browser']);
if ($i != 1) {
//we will have two since we are not using 'other' argument yet
//see if version is before or after the name
if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
$version= $matches['version'][0];
}
else {
$version= $matches['version'][1];
}
}
else {
$version= $matches['version'][0];
}

// check if we have a number
if ($version==null || $version=="") {$version="?";}

return array(
'userAgent' => $u_agent,
'name' => $bname,
'version' => $version,
'pattern' => $pattern
);
} 
function getOs() 
{
$useragent= strtolower($_SERVER['HTTP_USER_AGENT']);

//winxp
if (strpos($useragent, 'windows nt 5.1') !== FALSE) {
return 'Windows XP';
}
elseif (strpos($useragent, 'windows nt 6.1') !== FALSE) {
return 'Windows 7';
}
elseif (strpos($useragent, 'windows nt 6.0') !== FALSE) {
return 'Windows Vista';
}
elseif (strpos($useragent, 'windows 98') !== FALSE) {
return 'Windows 98';
}
elseif (strpos($useragent, 'windows nt 5.0') !== FALSE) {
return 'Windows 2000';
}
elseif (strpos($useragent, 'windows nt 5.2') !== FALSE) {
return 'Windows 2003 Server';
}
elseif (strpos($useragent, 'windows nt') !== FALSE) {
return 'Windows NT';
}
elseif (strpos($useragent, 'win 9x 4.90') !== FALSE && strpos($useragent, 'win me')) {
return 'Windows ME';
}
elseif (strpos($useragent, 'win ce') !== FALSE) {
return 'Windows CE';
}
elseif (strpos($useragent, 'win 9x 4.90') !== FALSE) {
return 'Windows ME';
}
elseif (strpos($useragent, 'windows phone') !== FALSE) {
return 'Windows Phone';
}
elseif (strpos($useragent, 'iphone') !== FALSE) {
return 'iPhone';
}
// experimental
elseif (strpos($useragent, 'ipad') !== FALSE) {
return 'iPad';
}
elseif (strpos($useragent, 'webos') !== FALSE) {
return 'webOS';
}
elseif (strpos($useragent, 'symbian') !== FALSE) {
return 'Symbian';
}
elseif (strpos($useragent, 'android') !== FALSE) {
return 'Android';
}
elseif (strpos($useragent, 'blackberry') !== FALSE) {
return 'Blackberry';
}
elseif (strpos($useragent, 'mac os x') !== FALSE) {
return 'Mac OS X';
}
elseif (strpos($useragent, 'macintosh') !== FALSE) {
return 'Macintosh';
}
elseif (strpos($useragent, 'linux') !== FALSE) {
return 'Linux';
}
elseif (strpos($useragent, 'freebsd') !== FALSE) {
return 'Free BSD';
}
elseif (strpos($useragent, 'symbian') !== FALSE) {
return 'Symbian';
}
else 
{
return 'Desconocido';
}
}
$ip = getRealIP();
//$html = curl_init("http://ipinfodb.com/ip_locator.php?ip=".$ip);
//$iploc = curl_exec($html);
$sistema.="Sistema Operativo: ".getOs();
$ua=getBrowser();
$sistema.=" Navegador: ".$ua['name'] . " " . $ua['version'];
$sistema.=" <iframe SRC=\"http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=$ip\" WIDTH=\"600\" HEIGHT=\"400\" FRAMEBORDER=\"1\"></iframe>";
//********************Optenemos la url o el link anterior********************
$urlDrefe=$_SERVER['HTTP_REFERER'];
//echo $tokem;
//******************************************************************
//acá contamos el clic
	global $database_HotSecrets, $HotSecrets;
	mysql_select_db($database_HotSecrets, $HotSecrets);	
	$insertSQL = sprintf(
	"INSERT INTO click_productos (id_click, id_producto, fecha_click, hora_click, url_referen, navegador_click) VALUES (null, %s, NOW(), NOW(), %s, %s)",
        $tokem,
		GetSQLValueString($urlDrefe, "text"),
		GetSQLValueString($sistema, "text"));
  $Result1 = mysql_query($insertSQL, $HotSecrets) or die(mysql_error());


mysql_select_db($database_HotSecrets, $HotSecrets);
$query_ProductosNuevos = "update productos set clicks_producto=clicks_producto+1 where id_producto=$tokem";
$ProductosNuevos = mysql_query($query_ProductosNuevos, $HotSecrets) or die(mysql_error());

//*************************************************************
//obtenemos la URL del banner
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Destacados ="select url_seo_producto from productos where id_producto=$tokem";
$Destacados = mysql_query($query_Destacados, $HotSecrets) or die(mysql_error());
if ($row_Destacados = mysql_fetch_array($Destacados))
{
	//echo $reg["url"];
	//header("Location: ".$reg["url"]);
	//echo $fila["enlace"];
	header ("Location: producto-".$row_Destacados["url_seo_producto"].".html"); 
	 //header ("Location: ".$row_Destacados["urlseo"].".html");
	//header("Location: ".$row_Destacados["url_seo_producto"]);
}

//$sistema.="Sistema Operativo: ".getOs();
//$ua=getBrowser();
//$user_ip = $_SERVER['REMOTE_ADDR'];
// Iniciamos el handler de CURL y le pasamos la URL de la API externa
//$ch = curl_init("http://ipinfodb.com/ip_locator.php?ip=$user_ip");
// Con este comando le pedimos a CURL que, en vez de mostrar
// el resultado en pantalla, nos lo devuelva como una variable
//
// Y simplemente hacemos la petición HTTP.
//$country_code = curl_exec($ch);
//$sistema.="<br> Navegador: ".$ua['name'] . " " . $ua['version'];
//$sistema.="<br > ip: " .$country_code;
?>