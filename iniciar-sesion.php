<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in iniciar-sesion.php");
    die("Error de conexión a la base de datos.");
}

$loginFormAction = htmlspecialchars($_SERVER['PHP_SELF']);
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck']; // Note: Consider sanitizing or validating accesscheck
}

if (isset($_POST['correo'])) {
  $loginUsername = $_POST['correo'];
  $password = $_POST['password']; // Password will be hashed before comparison or use
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "iniciar-sesion.php?login_failed=1"; // Add a parameter for feedback
  // $MM_redirecttoReferrer = true; // This variable is set but not used

  // Validate email format
  if (!filter_var($loginUsername, FILTER_VALIDATE_EMAIL)) {
      error_log("Invalid email format on login attempt: " . $loginUsername);
      header("Location: ". $MM_redirectLoginFailed );
      exit;
  }
  
  $hashed_password = md5($password); // Still md5 as per original, but recommend password_hash() and password_verify()

  $LoginRS__query = "SELECT id_usuario, correo, password FROM usuarios WHERE correo=? AND password=? AND estado=1";
  $stmt = $HotSecrets->prepare($LoginRS__query);

  if ($stmt === false) {
      error_log("Prepare failed (LoginRS) in iniciar-sesion.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
      die("Error al preparar la consulta de inicio de sesión.");
  }

  $stmt->bind_param("ss", $loginUsername, $hashed_password);
  
  if (!$stmt->execute()) {
      error_log("Execute failed (LoginRS) in iniciar-sesion.php: (" . $stmt->errno . ") " . $stmt->error);
      $stmt->close();
      die("Error al ejecutar la consulta de inicio de sesión.");
  }

  $result = $stmt->get_result();
  $loginFoundUser = $result->num_rows;
  $row_LoginRS = $result->fetch_assoc(); // Fetch the first row

  $stmt->close();
  $result->free();

  if ($loginFoundUser) {
    $loginStrGroup = ""; // This variable seems unused or its purpose needs clarification.
    
    if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup; // Consider if this is still needed.
    $_SESSION['MM_Usuario'] = $row_LoginRS["id_usuario"];	    

    if (isset($_SESSION['PrevUrl']) && $_SESSION['PrevUrl']) { // Ensure PrevUrl is not empty
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
    exit;
  } else {
    header("Location: ". $MM_redirectLoginFailed );
    exit;
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