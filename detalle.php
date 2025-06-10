<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// The ObtenerUrlSEOProducto function is also from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in detalle.php");
    die("Error de conexión a la base de datos.");
}

$varUlr_DetalleProd = "0"; // Default value
if (isset($_GET["detalle"])) {
    // It's assumed ObtenerUrlSEOProducto handles sanitization or uses the input safely
    $id_producto_from_seo = ObtenerUrlSEOProducto($HotSecrets, $_GET["detalle"]);
    if ($id_producto_from_seo !== null && filter_var($id_producto_from_seo, FILTER_VALIDATE_INT)) {
        $varUlr_DetalleProd = $id_producto_from_seo;
    } elseif (filter_var($_GET["detalle"], FILTER_VALIDATE_INT)) {
        // Fallback if SEO URL lookup fails but a valid integer ID might have been passed
        $varUlr_DetalleProd = $_GET["detalle"];
    } else {
        // Handle cases where $_GET["detalle"] is neither a valid SEO URL nor an integer ID
        error_log("Invalid product identifier in detalle.php: " . $_GET["detalle"]);
        // You might want to redirect to a 404 page or show an error message
        die("Producto no encontrado.");
    }
} else {
    // Handle cases where $_GET["detalle"] is not set
    // Redirect or show error, as product ID is crucial for this page
    die("Producto no especificado.");
}


// Query for DetalleProd
$row_DetalleProd = null;
$totalRows_DetalleProd = 0;
$query_DetalleProd = "SELECT * FROM productos WHERE productos.id_producto = ?";
$stmt_DetalleProd = $HotSecrets->prepare($query_DetalleProd);
if ($stmt_DetalleProd === false) {
    error_log("Prepare failed (DetalleProd) in detalle.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
} else {
    $stmt_DetalleProd->bind_param("i", $varUlr_DetalleProd);
    if ($stmt_DetalleProd->execute()) {
        $DetalleProd_result = $stmt_DetalleProd->get_result();
        $row_DetalleProd = $DetalleProd_result->fetch_assoc();
        $totalRows_DetalleProd = $DetalleProd_result->num_rows;
        // $DetalleProd_result->free(); // Free this result after usage if $row_DetalleProd is enough
    } else {
        error_log("Execute failed (DetalleProd) in detalle.php: (" . $stmt_DetalleProd->errno . ") " . $stmt_DetalleProd->error);
    }
    // $stmt_DetalleProd->close(); // Close statement after usage
}

// Query for Imagenes
$row_Imagenes = null;
$totalRows_Imagenes = 0;
// It seems $Imagenes result is iterated in included files, so we fetch all.
$Imagenes_result_array = []; // To store all image rows

$query_Imagenes = "SELECT * FROM imagenes_productos WHERE imagenes_productos.id_producto = ?";
$stmt_Imagenes = $HotSecrets->prepare($query_Imagenes);
if ($stmt_Imagenes === false) {
    error_log("Prepare failed (Imagenes) in detalle.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
} else {
    $stmt_Imagenes->bind_param("i", $varUlr_DetalleProd);
    if ($stmt_Imagenes->execute()) {
        $Imagenes_result = $stmt_Imagenes->get_result();
        // Fetch all rows if they are iterated over in the included file
        while ($temp_row = $Imagenes_result->fetch_assoc()) {
            $Imagenes_result_array[] = $temp_row;
        }
        $row_Imagenes = $Imagenes_result_array[0] ?? null; // Keep original logic for first row
        $totalRows_Imagenes = $Imagenes_result->num_rows;
        // $Imagenes_result->free(); // Result will be freed after the include or loop
    } else {
        error_log("Execute failed (Imagenes) in detalle.php: (" . $stmt_Imagenes->errno . ") " . $stmt_Imagenes->error);
    }
    // $stmt_Imagenes->close(); // Close statement after usage
}

// Query for javaimag (Seems identical to Imagenes, might be redundant or for a different purpose in includes)
$row_javaimag = null;
$totalRows_javaimag = 0;
$javaimag_result_array = []; // To store all image rows

$query_javaimag = "SELECT * FROM imagenes_productos WHERE imagenes_productos.id_producto = ?";
$stmt_javaimag = $HotSecrets->prepare($query_javaimag);
if ($stmt_javaimag === false) {
    error_log("Prepare failed (javaimag) in detalle.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
} else {
    $stmt_javaimag->bind_param("i", $varUlr_DetalleProd);
    if ($stmt_javaimag->execute()) {
        $javaimag_result = $stmt_javaimag->get_result();
        while ($temp_row_java = $javaimag_result->fetch_assoc()) {
            $javaimag_result_array[] = $temp_row_java;
        }
        $row_javaimag = $javaimag_result_array[0] ?? null; // Keep original logic for first row
        $totalRows_javaimag = $javaimag_result->num_rows;
        // $javaimag_result->free(); // Result will be freed after the include or loop
    } else {
        error_log("Execute failed (javaimag) in detalle.php: (" . $stmt_javaimag->errno . ") " . $stmt_javaimag->error);
    }
    // $stmt_javaimag->close(); // Close statement after usage
}

// Note: The actual freeing of results and closing of statements for Imagenes_result and javaimag_result
// should happen after extructura-hot/2-contenido-detalle-producto.php is included if it uses these results.
// For simplicity in this step, I'm showing where they would be if processing was only in this file.
// The included file will need access to $Imagenes_result_array and $javaimag_result_array (or the result objects themselves).
?>
<!DOCTYPE html>
<html>
<?php include("extructura-hot/2-head-detalle-producto.php"); ?>
</head>
<body class=" catalog-product-view catalog-product-view product-product">
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

<div class="ma-main-container col2-right-layout">
<div class="container">
<div class="main">
<div class="main-inner">


<?php include("extructura-hot/2-contenido-detalle-producto.php"); ?>

<?php include("extructura-hot/3-aside.php"); ?>

</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>

<div id="ajaxconfig_info" style ="display:none">
<a href =""></a>
<div>
<img src ="imagenes/productos/loading.gif" alt ="Loading Image" />
</div>
</div>

<div id="ajaxcart-checkout-content" style="display:none;"></div>
<div id ="productHaveOption"  style="display:block;" ></div>
<script type="text/javascript">

    function initLightbox(){
        new Lightbox({
            fileLoadingImage: 'imagenes/productos/loading.gif',
            fileBottomNavCloseImage: 'imagenes/productos/closelabel.gif',
            overlayOpacity: 0.8,   // controls transparency of shadow overlay
            animate: true,         // toggles resizing animations
            resizeSpeed: 7,        // controls the speed of the image resizing animations (1=slowest and 10=fastest)
            borderSize: 10,
            // When grouping images this is used to write: Image # of #.
            // Change it for non-english localization
            labelImage: "Image",
            labelOf: "of"
        });
    }


    if (Prototype.Browser.IE) {
        Event.observe(window, 'load', function(){ //KB927917 fix
            initLightbox();
        });
    } else {
        document.observe("dom:loaded", function(){
            initLightbox();
        });
    }
</script>

</div>
</div>
<?php
// Free results and close statements after includes are done with them
if (isset($DetalleProd_result) && $DetalleProd_result instanceof mysqli_result) {
    $DetalleProd_result->free();
}
if (isset($stmt_DetalleProd) && $stmt_DetalleProd instanceof mysqli_stmt) {
    $stmt_DetalleProd->close();
}
// Assuming Imagenes_result and javaimag_result were used by included files
// and are now safe to free. If they were arrays, this is not needed.
// If they were mysqli_result objects, they should be freed.
// For the current refactoring, $Imagenes_result and $javaimag_result are mysqli_result objects.
if (isset($Imagenes_result) && $Imagenes_result instanceof mysqli_result) {
    $Imagenes_result->free();
}
if (isset($stmt_Imagenes) && $stmt_Imagenes instanceof mysqli_stmt) {
    $stmt_Imagenes->close();
}
if (isset($javaimag_result) && $javaimag_result instanceof mysqli_result) {
    $javaimag_result->free();
}
if (isset($stmt_javaimag) && $stmt_javaimag instanceof mysqli_stmt) {
    $stmt_javaimag->close();
}
?>
</body>
</html>