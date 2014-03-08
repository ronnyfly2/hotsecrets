<?php require_once('Connections/HotSecrets.php');
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
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['correo'])) {
  $loginUsername=$_POST['correo'];
  $password=md5($_POST['password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "iniciar-sesion.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_HotSecrets, $HotSecrets);
  
  $LoginRS__query=sprintf("SELECT id_usuario, correo, password FROM usuarios WHERE correo=%s AND password=%s AND estado= 1",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $HotSecrets) or die(mysql_error());
  $row_LoginRS = mysql_fetch_assoc($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['MM_Usuario'] = $row_LoginRS["id_usuario"];	    

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/4-registro-head.php"); ?></head>
<body class=" customer-account-login">
<div class="ma-wrapper">
<noscript>
<div class="global-site-notice noscript">
<div class="notice-inner">
<p>
<strong>Parece que su navegador tiene desactivado JavaScript.</strong><br />
Usted debe tener Javascript activado en tu navegador para utilizar la funcionalidad de este sitio web.</p>
</div>
</div>
</noscript>
<div class="ma-page">
<?php include("extructura-hot/1-header.php"); ?>
<div class="ma-main-container col1-layout">
<div class="container">
<div class="main">
<div class="main-inner">
<div class="col-main">
<div class="account-login">
<div class="page-title" style=" background:#FFF;">
<h1 style="margin-left:15px;">Iniciar Sesion</h1>
</div>
<form action="<?php echo $loginFormAction; ?>" name="ingreso" method="POST" id="login-form">
<div class="col2-set">
<div class="col-1 new-users">
<div class="content">
<h2>Nuevo Cliente</h2> 
<p>Al crear una cuenta en nuestra tienda, usted será capaz de realizar el proceso de compra más rápidamente, almacenar varias direcciones de envío, ver y hacer un seguimiento de sus pedidos en su cuenta y más.</p>
</div>
</div>
<div class="col-2 registered-users">
<div class="content">
<h2>Ingresos de Clientes Registrados</h2>
<p>Si usted tiene una cuenta con nosotros, por favor ingrese.</p>
<ul class="form-list">
<li>
<label for="email" class="required"><em>*</em>E-mail</label>
<div class="input-box">
<input type="text" name="correo" value="" class="input-text required-entry validate-email" />
</div>
</li>
<li>
<label for="pass" class="required"><em>*</em>Password</label>
<div class="input-box">
<input type="password" name="password" class="input-text required-entry validate-password" />
</div>
</li>
</ul>
<p class="required">* Campos requeridos</p>
</div>
</div>
</div>
<div class="col2-set">
<div class="col-1 new-users">
<div class="buttons-set">
<button type="button" title="Crear una cuenta en HotSecrets" class="button"><span><span>Registrate</span></span></button>
</div>
</div>
<div class="col-2 registered-users">
<div class="buttons-set">
<a href="" class="f-left">¿Has olvidado tu contraseña?</a>
<button type="submit" class="button"><span><span>Iniciar Sesion</span></span></button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>
</body>
</html>