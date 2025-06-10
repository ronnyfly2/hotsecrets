<?php require_once('../Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// and has been updated to require a mysqli connection object as the first parameter.
// Ensure that funcionalidades/funciones-hot.php is included if GetSQLValueString is used directly in this file later.
// For the login query, we will use prepared statements instead.

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['usuario_ordenador'])) {
  $loginUsername = $_POST['usuario_ordenador'];
  $password = md5($_POST['password_ordenador']); // MD5 is not secure for passwords. Consider migrating to password_hash().
  $MM_redirectLoginSuccess = "panel.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true; // This variable is set but not used in the provided snippet.

  // Ensure $HotSecrets is a valid mysqli object from Connections/HotSecrets.php
  if (!($HotSecrets instanceof mysqli)) {
    // Handle error: $HotSecrets is not correctly initialized
    // For example, log the error and redirect to an error page or show a generic error message.
    error_log("MySQLi connection object is not available in organizador/index.php");
    header("Location: ". $MM_redirectLoginFailed . "?error=db_connection");
    exit;
  }

  $stmt = $HotSecrets->prepare("SELECT id_ordenador, usuario_ordenador, password_ordenador FROM ordenador WHERE usuario_ordenador=? AND password_ordenador=? AND estao_ordenador > 0");
  
  if ($stmt === false) {
    // Handle error: prepare failed
    error_log("Prepare failed: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    header("Location: ". $MM_redirectLoginFailed . "?error=prepare_failed");
    exit;
  }
  
  $stmt->bind_param("ss", $loginUsername, $password);
  
  if (!$stmt->execute()) {
    // Handle error: execute failed
    error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    header("Location: ". $MM_redirectLoginFailed . "?error=execute_failed");
    $stmt->close();
    exit;
  }
  
  $result = $stmt->get_result();
  $loginFoundUser = $result->num_rows;
  $row_LoginRS = $result->fetch_assoc(); // Fetch the first row

  if ($loginFoundUser) {
    $loginStrGroup = ""; // This variable seems unused or its purpose needs clarification.
    if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    
    $_SESSION['MM_Username2'] = $loginUsername;
    $_SESSION['MM_UserGroup2'] = $loginStrGroup; // Consider if this is still needed.
    $_SESSION['MM_IdAdmin'] = $row_LoginRS["id_ordenador"];

    if (isset($_SESSION['PrevUrl']) && true) { // The 'true' condition is redundant here.
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    header("Location: " . $MM_redirectLoginSuccess );
    $stmt->close();
    exit;
  } else {
    header("Location: ". $MM_redirectLoginFailed );
    $stmt->close();
    exit;
  }
}
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