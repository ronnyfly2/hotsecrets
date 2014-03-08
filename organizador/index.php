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
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['usuario_ordenador'])) {
  $loginUsername=$_POST['usuario_ordenador'];
  $password=md5($_POST['password_ordenador']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "panel.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_HotSecrets, $HotSecrets);  
  $LoginRS__query=sprintf("SELECT id_ordenador, usuario_ordenador, password_ordenador FROM ordenador WHERE usuario_ordenador=%s AND password_ordenador=%s AND estao_ordenador>0",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $HotSecrets) or die(mysql_error());
  $row_LoginRS = mysql_fetch_assoc($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username2'] = $loginUsername;
    $_SESSION['MM_UserGroup2'] = $loginStrGroup;
	$_SESSION['MM_IdAdmin'] = $row_LoginRS["id_ordenador"];	    
    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" href="img/favicon.png">
<title>Login Administrador - HotSecrets</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="css/font-awesome.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body class="login-body">

<div class="container">
<form class="form-signin" action="<?php echo $loginFormAction; ?>"  METHOD="POST" name="formulario">
<h2 class="form-signin-heading">Administrador</h2>
<div class="login-wrap">

<input type="text" name="usuario_ordenador" class="form-control" placeholder="Usuario" autofocus>
<input type="password" name="password_ordenador" class="form-control" placeholder="Password">
<label class="checkbox">
<input type="checkbox" value="remember-me"> 
Recosdarme
<span class="pull-right">
<a data-toggle="modal" href="#myModal"> ¿Olvidaste tu password?</a>
</span>
</label>
<button class="btn btn-lg btn-login btn-block" type="submit">Iniciar Sesion</button>

<!--<p>or you can sign in via social network</p>
<div class="login-social-link">
<a href="index.html" class="facebook">
<i class="fa fa-facebook"></i>
Facebook
</a>
<a href="index.html" class="twitter">
<i class="fa fa-twitter"></i>
Twitter
</a>
</div>
<div class="registration">
Don't have an account yet?
<a class="" href="registration.html">
Create an account
</a>
</div>-->
</form>
</div>
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">¿Olvidaste tu password?</h4>
</div>
<form method="post" action="" name="otroformuilario">
<div class="modal-body">
<p>Ingrese su dirección de correo electrónico a continuación para restablecer su contraseña.</p>
<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
</div>

<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
<button class="btn btn-success" type="submit">Enviar</button>
</div>
</form>
</div>
</div>
</div>
<!-- modal -->
</form>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>