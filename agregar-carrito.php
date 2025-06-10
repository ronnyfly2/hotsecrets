<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// The comprobarexistensia function is also from funcionalidades/funciones-hot.php and will need $HotSecrets passed

if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in agregar-carrito.php");
    die("Error de conexión a la base de datos.");
}

if (isset($_POST['cantidad']) && $_POST['cantidad'] > 0) {
    $cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);
    $producto_id = filter_var($_POST['producto'], FILTER_VALIDATE_INT); // Assuming producto is id_producto
    $id_talla = $_POST['id_talla']; // Assuming this might not always be an int, handle as string
    $id_color = $_POST['id_color']; // Assuming this might not always be an int, handle as string

    if ($cantidad === false || $producto_id === false) {
        error_log("Invalid input in agregar-carrito.php");
        // Redirect or show an error
        header("Location: lista-carrito.php?error=invalid_input");
        exit;
    }
    
    // Ensure session variable exists
    if (!isset($_SESSION['MM_Usuario'])) {
        error_log("MM_Usuario session not set in agregar-carrito.php");
        header("Location: iniciar-sesion.php?error=session_expired");
        exit;
    }
    $id_usuario = $_SESSION['MM_Usuario'];
    if (!filter_var($id_usuario, FILTER_VALIDATE_INT)) {
        error_log("Invalid MM_Usuario session data in agregar-carrito.php");
        header("Location: iniciar-sesion.php?error=invalid_session");
        exit;
    }


    // Assuming comprobarexistensia is updated to accept $HotSecrets as the first argument
    // and returns an integer (id_carrito or 0)
    $valorrespuesta = comprobarexistensia($HotSecrets, $producto_id, $id_talla, $id_color, $id_usuario);

    if ($valorrespuesta != 0 && filter_var($valorrespuesta, FILTER_VALIDATE_INT)) {
        //UPDATE
        $updateSQL = "UPDATE carrito SET cantidad = cantidad + ? WHERE id_carrito = ?";
        $stmt = $HotSecrets->prepare($updateSQL);
        if ($stmt === false) {
            error_log("Prepare failed (UPDATE) in agregar-carrito.php: " . $HotSecrets->error);
            die("Error al preparar la actualización del carrito.");
        }
        $stmt->bind_param("ii", $cantidad, $valorrespuesta);
    } else {
        //INSERT
        $insertSQL = "INSERT INTO carrito (id_usuario, id_producto, cantidad, id_talla, id_color, fecha_carrito) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $HotSecrets->prepare($insertSQL);
        if ($stmt === false) {
            error_log("Prepare failed (INSERT) in agregar-carrito.php: " . $HotSecrets->error);
            die("Error al preparar la inserción en el carrito.");
        }
        // Ensure id_talla and id_color are treated as strings if they can be non-numeric, or 'i' if integers
        $stmt->bind_param("iiiss", $id_usuario, $producto_id, $cantidad, $id_talla, $id_color);
    }

    if (!$stmt->execute()) {
        error_log("Execute failed in agregar-carrito.php: " . $stmt->error);
        die("Error al actualizar el carrito.");
    }
    $stmt->close();

    $insertGoTo = "lista-carrito.php";
    // Avoid appending QUERY_STRING directly if it might contain sensitive or problematic data
    header(sprintf("Location: %s", $insertGoTo));
    exit;

} elseif (isset($_POST['cantidad']) && $_POST['cantidad'] == 0) { ?>
<meta http-equiv="refresh" content="1;URL=index.php" />
No se especificó una cantidad válida. Redireccionando...
<?php 
    exit;
} else {
    // Handle cases where cantidad is not set or not > 0 if needed, or redirect
    header("Location: index.php?error=no_quantity");
    exit;
}
?>