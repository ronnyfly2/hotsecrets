<?php
if (!isset($_SESSION)) {
  session_start();
}?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_HotSecrets = "localhost";
$database_HotSecrets = "lenceriahot";
$username_HotSecrets = "root";
$password_HotSecrets = "eresmias";
$HotSecrets = mysql_pconnect($hostname_HotSecrets, $username_HotSecrets, $password_HotSecrets) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php 
if (is_file("funcionalidades/funciones-hot.php")){
include("funcionalidades/funciones-hot.php");
}
else
{
	include("../funcionalidades/funciones-hot.php");
}
 ?>