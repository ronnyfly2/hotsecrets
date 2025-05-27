<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which is included by Connections/HotSecrets.php

if (isset($_GET['eliminar'])) {
  $id_carrito_to_delete = $_GET['eliminar'];

  // Ensure $HotSecrets is a valid mysqli object
  if (!($HotSecrets instanceof mysqli)) {
      error_log("MySQLi connection object is not available in 2-eliminar-producto-carrito.php");
      die("Error de conexión a la base de datos.");
  }

  // Validate that $_GET['eliminar'] is an integer
  if (!filter_var($id_carrito_to_delete, FILTER_VALIDATE_INT)) {
      error_log("Invalid input for id_carrito in 2-eliminar-producto-carrito.php: " . $id_carrito_to_delete);
      // Redirect or show an error, but avoid using the invalid input in a query
      header("Location: lista-carrito.php?error=invalid_input");
      exit;
  }
  
  $deleteSQL = "DELETE FROM carrito WHERE id_carrito=?";
  $stmt = $HotSecrets->prepare($deleteSQL);

  if ($stmt === false) {
      error_log("Prepare failed in 2-eliminar-producto-carrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
      die("Error al preparar la consulta de eliminación.");
  }

  $stmt->bind_param("i", $id_carrito_to_delete);

  if (!$stmt->execute()) {
      error_log("Execute failed in 2-eliminar-producto-carrito.php: (" . $stmt->errno . ") " . $stmt->error);
      die("Error al ejecutar la eliminación.");
  }

  $stmt->close();

  // Construct the redirect URL carefully, avoiding direct use of $_SERVER['QUERY_STRING']
  // if it might contain the 'eliminar' parameter, leading to a loop or error.
  // For simplicity, just redirecting to lista-carrito.php without query string.
  // If specific query parameters need to be preserved, they should be explicitly added.
  $deleteGoTo = "lista-carrito.php";
  header(sprintf("Location: %s", $deleteGoTo));
  exit; // Ensure script termination after header redirect
}
?>
