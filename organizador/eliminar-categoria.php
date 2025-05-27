<?php
require_once('../Connections/HotSecrets.php'); // Provides $HotSecrets mysqli object

// Ensure session is started (Connections/HotSecrets.php should ideally handle this)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Optional: Session check for admin
// Adjust 'MM_IdAdmin' if your admin session variable is different.
// 'no-entra.php' is used in other admin files, so using it here for consistency.
if (!isset($_SESSION['MM_IdAdmin'])) { 
    error_log("Admin session not found in eliminar-categoria.php. MM_IdAdmin: " . (isset($_SESSION['MM_IdAdmin']) ? $_SESSION['MM_IdAdmin'] : 'Not Set'));
    header("Location: no-entra.php"); 
    exit;
}

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in organizador/eliminar-categoria.php");
    // Set a generic error message for the user.
    $_SESSION['delete_error'] = "Error de conexión. No se pudo eliminar la categoría.";
    header("Location: lista-categorias.php");
    exit;
}

$id_categoria_to_delete = null;

if (isset($_GET['idcategoria'])) {
    // Validate that idcategoria is a positive integer
    if (filter_var($_GET['idcategoria'], FILTER_VALIDATE_INT, array("options" => array("min_range"=>1))) !== false) {
        $id_categoria_to_delete = (int)$_GET['idcategoria'];
    } else {
        error_log("Invalid or non-positive category ID for deletion in eliminar-categoria.php. Value: " . $_GET['idcategoria']);
        $_SESSION['delete_error'] = "ID de categoría inválido para eliminar.";
    }
} else {
    error_log("Category ID (idcategoria) not provided for deletion in eliminar-categoria.php.");
    $_SESSION['delete_error'] = "No se proporcionó ID de categoría para eliminar.";
}

if ($id_categoria_to_delete !== null) {
    $stmt = $HotSecrets->prepare("DELETE FROM categorias WHERE id_categoria = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id_categoria_to_delete);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['delete_message'] = "Categoría eliminada exitosamente.";
            } else {
                $_SESSION['delete_error'] = "No se encontró la categoría para eliminar o ya fue eliminada.";
                error_log("No category found with ID: " . $id_categoria_to_delete . " for deletion, or no rows affected.");
            }
        } else {
            // Execution failed
            error_log("Error executing category deletion in eliminar-categoria.php: " . $stmt->error . " for ID: " . $id_categoria_to_delete);
            $_SESSION['delete_error'] = "Error al eliminar la categoría: Falló la ejecución.";
        }
        $stmt->close();
    } else {
        // Statement preparation failed
        error_log("Error preparing category deletion statement in eliminar-categoria.php: " . $HotSecrets->error);
        $_SESSION['delete_error'] = "Error al eliminar la categoría: Falló la preparación de la consulta.";
    }
}
// If $id_categoria_to_delete was null due to missing or invalid param, 
// an error message in session should have been set already.

header("Location: lista-categorias.php");
exit;
?>
