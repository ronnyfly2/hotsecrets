<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_HotSecrets = "localhost";
$database_HotSecrets = "hotsecre_lenceri";
$username_HotSecrets = "hotsecre_hot";
$password_HotSecrets = "ciDtA6n?8Mgg";

// Attempt to establish a persistent connection
$HotSecrets = new mysqli("p:" . $hostname_HotSecrets, $username_HotSecrets, $password_HotSecrets, $database_HotSecrets);

// Check connection
if ($HotSecrets->connect_error) {
    trigger_error("Connection failed: " . $HotSecrets->connect_error, E_USER_ERROR);
}

// Set character set to UTF-8
if (!$HotSecrets->set_charset("utf8mb4")) {
    trigger_error("Error loading character set utf8mb4: " . $HotSecrets->error, E_USER_ERROR);
}

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