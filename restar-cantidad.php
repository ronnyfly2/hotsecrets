<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in restar-cantidad.php");
    die("Error de conexión a la base de datos.");
}

$VarRestar_Carrito = "0";
if (isset($_GET["restar"])) {
  $VarRestar_Carrito = filter_var($_GET["restar"], FILTER_VALIDATE_INT);
  if ($VarRestar_Carrito === false) {
      error_log("Invalid input for restar in restar-cantidad.php: " . $_GET["restar"]);
      // Redirect or show an error, but avoid using the invalid input in a query
      header("Location: lista-carrito.php?error=invalid_input_restar");
      exit;
  }
} else {
    // Redirect or show an error if 'restar' is not set
    header("Location: lista-carrito.php?error=missing_param_restar");
    exit;
}

// Ensure quantity does not go below 1 (or handle as needed, e.g., delete if 0)
// This logic should ideally be more robust, perhaps checking current quantity first
// or using a WHERE clause like `AND cantidad > 1` if you don't want it to go to 0.
// If quantity can become 0, the item might need to be deleted.
// For now, just decrementing. A more complex logic might be:
// $updateSQL = "UPDATE carrito SET cantidad = IF(cantidad > 1, cantidad - 1, 1) WHERE id_carrito = ?";
// Or delete if quantity becomes 0:
// First, update: "UPDATE carrito SET cantidad = cantidad - 1 WHERE id_carrito = ? AND cantidad > 0"
// Then, check if affected rows > 0. If not, quantity might already be 0 or 1.
// Or, "DELETE FROM carrito WHERE id_carrito = ? AND cantidad = 0" after an update.
// Sticking to direct translation of original logic for now which is just decrementing.

$updateSQL = "UPDATE carrito SET cantidad = GREATEST(0, cantidad - 1) WHERE id_carrito = ?"; 
// GREATEST(0, ...) ensures quantity doesn't go negative if it was already 0 or some error.
// Or, if quantity should not go below 1:
// $updateSQL = "UPDATE carrito SET cantidad = GREATEST(1, cantidad - 1) WHERE id_carrito = ?";

$stmt = $HotSecrets->prepare($updateSQL);

if ($stmt === false) {
    error_log("Prepare failed (restar cantidad) in restar-cantidad.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la actualización de cantidad.");
}

$stmt->bind_param("i", $VarRestar_Carrito);

if (!$stmt->execute()) {
    error_log("Execute failed (restar cantidad) in restar-cantidad.php: (" . $stmt->errno . ") " . $stmt->error);
    $stmt->close();
    die("Error al actualizar la cantidad.");
}
$stmt->close();

// Optional: Delete item if quantity is now 0
// $deleteIfZeroSQL = "DELETE FROM carrito WHERE id_carrito = ? AND cantidad = 0";
// $stmt_delete = $HotSecrets->prepare($deleteIfZeroSQL);
// if ($stmt_delete) {
//    $stmt_delete->bind_param("i", $VarRestar_Carrito);
//    $stmt_delete->execute();
//    $stmt_delete->close();
// }

$updateGoTo = "lista-carrito.php";
// Avoid appending $_SERVER['QUERY_STRING'] as it might contain the 'restar' param, causing issues.
header(sprintf("Location: %s", $updateGoTo));
exit;
?>