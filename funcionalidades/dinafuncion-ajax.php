<?php require_once('../Connections/HotSecrets.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$email=$_POST['correo'];
$email=filter_var($email,FILTER_VALIDATE_EMAIL);
if ($_POST["formid"]==1)
{
	if ($email=="") 
	{
	echo "2";
	}
	else
	{
	mysql_select_db($database_HotSecrets, $HotSecrets);
	$query_Registro = "SELECT id_usuario FROM usuarios WHERE correo = '".$_POST['correo']."'";
	$Registro = mysql_query($query_Registro, $HotSecrets) or die(mysql_error());
	$row_Registro = mysql_fetch_assoc($Registro);
	$totalRows_Registro = mysql_num_rows($Registro);			
		{
			if($totalRows_Registro>0)echo "0";
			else echo "1";			
	    }	
	}
	}
?>