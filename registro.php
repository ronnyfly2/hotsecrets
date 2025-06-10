<?php require_once('Connections/HotSecrets.php'); 
// The GetSQLValueString, getRealIP, ComprobarCorreoUnico, Darse_Alta_usuario functions are from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in registro.php");
    die("Error de conexión a la base de datos.");
}

// It's better to initialize these from $_POST directly inside the form processing block
// $estadoinactivo = 0; // Default state
// $ipusuario = getRealIP(); // getRealIP() doesn't need $HotSecrets

$editFormAction = htmlspecialchars($_SERVER['PHP_SELF']);
if (isset($_SERVER['QUERY_STRING'])) {
  // Sanitize QUERY_STRING if it's used to construct redirect URLs
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formregistro")) {
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $password = $_POST['password']; // Consider using password_hash() instead of md5()
    $suscrito = isset($_POST['suscrito']) ? 1 : 0;
    $estadoinactivo = 0; // Explicitly set state for new registration
    $ipusuario = getRealIP();

    // Validate email
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email, maybe redirect back with an error
        $insertGoTo = "registro.php?error=invalid_email";
        header(sprintf("Location: %s", $insertGoTo));
        exit;
    }

    if (!ComprobarCorreoUnico($HotSecrets, $correo)) {
        $insertGoTo = "correo-repetido.php";
        header(sprintf("Location: %s", $insertGoTo));
        exit;
    } else {
        $hashed_password = md5($password); // Still md5 as per original, but recommend password_hash()

        $insertSQL = "INSERT INTO usuarios (nombre, apellido, correo, password, fecha_reg, estado, suscrito, ipus) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";
        $stmt = $HotSecrets->prepare($insertSQL);

        if ($stmt === false) {
            error_log("Prepare failed (User Insert) in registro.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
            die("Error al preparar el registro de usuario.");
        }

        $stmt->bind_param("ssssiis", $nombre, $apellido, $correo, $hashed_password, $estadoinactivo, $suscrito, $ipusuario);

        if (!$stmt->execute()) {
            error_log("Execute failed (User Insert) in registro.php: (" . $stmt->errno . ") " . $stmt->error);
            $stmt->close();
            die("Error al registrar el usuario.");
        }
        $stmt->close();

        Darse_Alta_usuario($HotSecrets, $correo, $nombre); // Pass $HotSecrets
        
        $insertGoTo = "confirmar-correo.php";
        // Avoid appending QUERY_STRING if it's not necessary or could cause issues
        header(sprintf("Location: %s", $insertGoTo));
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/4-registro-head.php"); ?>
</head>
<body class=" customer-account-create">
<div class="ma-wrapper">
<noscript>
<div class="global-site-notice noscript">
<div class="notice-inner">
<p>
<strong>Parece que su navegador tiene desactivado JavaScript.</strong><br />
Usted debe tener Javascript activado en tu navegador para utilizar la funcionalidad de este sitio web.
</p>
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
<div class="account-create">
<div class="page-title" style=" background:#FFF;">
<h1 style="margin-left:15px;">Formulario de Registro</h1>
</div>
<?php include("extructura-hot/4-registro-formu.php"); ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>
</body>
</html>