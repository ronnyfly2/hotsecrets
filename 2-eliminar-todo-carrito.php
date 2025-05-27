<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which is included by Connections/HotSecrets.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in 2-eliminar-todo-carrito.php");
    die("Error de conexión a la base de datos.");
}

// Check if the session variable is set
if (!isset($_SESSION['MM_Usuario'])) {
    error_log("Session variable MM_Usuario not set in 2-eliminar-todo-carrito.php");
    // Redirect to login or an error page, as appropriate
    header("Location: iniciar-sesion.php?error=session_expired");
    exit;
}

$id_usuario_to_delete = $_SESSION['MM_Usuario'];

// Validate that $_SESSION['MM_Usuario'] is an integer (it should be if set correctly)
if (!filter_var($id_usuario_to_delete, FILTER_VALIDATE_INT)) {
    error_log("Invalid session variable MM_Usuario in 2-eliminar-todo-carrito.php: " . $id_usuario_to_delete);
    // Redirect or show an error
    header("Location: lista-carrito.php?error=invalid_user");
    exit;
}

$deleteSQL = "DELETE FROM carrito WHERE id_usuario=? AND carrito.transaccion_efectuada = 0";
$stmt = $HotSecrets->prepare($deleteSQL);

if ($stmt === false) {
    error_log("Prepare failed in 2-eliminar-todo-carrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la consulta de eliminación total.");
}

$stmt->bind_param("i", $id_usuario_to_delete);

if (!$stmt->execute()) {
    error_log("Execute failed in 2-eliminar-todo-carrito.php: (" . $stmt->errno . ") " . $stmt->error);
    die("Error al ejecutar la eliminación total.");
}

$stmt->close();

// Construct the redirect URL carefully.
$deleteGoTo = "lista-carrito.php";
// Adding a success message might be good for UX, e.g., $deleteGoTo = "lista-carrito.php?status=cleared";
header(sprintf("Location: %s", $deleteGoTo));
exit; // Ensure script termination after header redirect

?>
