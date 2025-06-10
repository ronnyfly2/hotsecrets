<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in sumar-cantidad.php");
    die("Error de conexión a la base de datos.");
}

$VarSumar_Carrito = "0";
if (isset($_GET["sumar"])) {
  $VarSumar_Carrito = filter_var($_GET["sumar"], FILTER_VALIDATE_INT);
  if ($VarSumar_Carrito === false) {
      error_log("Invalid input for sumar in sumar-cantidad.php: " . $_GET["sumar"]);
      header("Location: lista-carrito.php?error=invalid_input_sumar");
      exit;
  }
} else {
    header("Location: lista-carrito.php?error=missing_param_sumar");
    exit;
}

// Consider adding a limit to the quantity if necessary, e.g., stock check.
$updateSQL = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id_carrito = ?";
$stmt = $HotSecrets->prepare($updateSQL);

if ($stmt === false) {
    error_log("Prepare failed (sumar cantidad) in sumar-cantidad.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la actualización de cantidad.");
}

$stmt->bind_param("i", $VarSumar_Carrito);

if (!$stmt->execute()) {
    error_log("Execute failed (sumar cantidad) in sumar-cantidad.php: (" . $stmt->errno . ") " . $stmt->error);
    $stmt->close();
    die("Error al actualizar la cantidad.");
}
$stmt->close();

$updateGoTo = "lista-carrito.php";
// Avoid appending $_SERVER['QUERY_STRING'] as it might contain the 'sumar' param.
header(sprintf("Location: %s", $updateGoTo));
exit;
?>