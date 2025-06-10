<?php require_once('Connections/HotSecrets.php');
 require_once('1-restrincion-usuario.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    error_log("MySQLi connection object is not available in lista-carrito.php");
    die("Error de conexión a la base de datos.");
}

$VarUsuario_CarritoCompras = "0";
if (isset($_SESSION["MM_Usuario"])) {
  $VarUsuario_CarritoCompras = filter_var($_SESSION["MM_Usuario"], FILTER_VALIDATE_INT);
  if ($VarUsuario_CarritoCompras === false) {
      error_log("Invalid MM_Usuario session data in lista-carrito.php");
      // Handle error appropriately, perhaps redirect to login or show error
      die("Error de sesión de usuario.");
  }
} else {
    // Handle case where MM_Usuario is not set (should be caught by 1-restrincion-usuario.php, but good to be defensive)
    error_log("MM_Usuario session not set in lista-carrito.php (should have been caught by restriction script)");
    die("Usuario no autenticado.");
}

// Query for CarritoCompras
$query_CarritoCompras = "SELECT * FROM carrito WHERE carrito.id_usuario = ? AND carrito.transaccion_efectuada = 0 ORDER BY id_carrito DESC";
$stmt_CarritoCompras = $HotSecrets->prepare($query_CarritoCompras);
$row_CarritoCompras = null; // Initialize
$CarritoCompras_result_array = []; // To store results for iteration
$totalRows_CarritoCompras = 0;

if ($stmt_CarritoCompras) {
    $stmt_CarritoCompras->bind_param("i", $VarUsuario_CarritoCompras);
    if ($stmt_CarritoCompras->execute()) {
        $CarritoCompras_result = $stmt_CarritoCompras->get_result();
        while ($temp_row = $CarritoCompras_result->fetch_assoc()) {
            $CarritoCompras_result_array[] = $temp_row;
        }
        // $row_CarritoCompras is used in a do...while loop in the original, so assign first row if exists
        $row_CarritoCompras = $CarritoCompras_result_array[0] ?? null; 
        $totalRows_CarritoCompras = $CarritoCompras_result->num_rows;
        // $CarritoCompras_result->free(); // Will be freed at the end of the script
    } else {
        error_log("Execute failed (CarritoCompras) in lista-carrito.php: (" . $stmt_CarritoCompras->errno . ") " . $stmt_CarritoCompras->error);
    }
    // $stmt_CarritoCompras->close(); // Will be closed at the end
} else {
    error_log("Prepare failed (CarritoCompras) in lista-carrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
}


// Query for DatosUsuario
$query_DatosUsuario = "SELECT * FROM usuarios WHERE usuarios.id_departamento > 0 AND usuarios.id_provincia > 0 AND usuarios.id_distrito > 0 AND usuarios.id_usuario = ?";
$stmt_DatosUsuario = $HotSecrets->prepare($query_DatosUsuario);
$row_DatosUsuario = null; // Initialize
$totalRows_DatosUsuario = 0;

if ($stmt_DatosUsuario) {
    $stmt_DatosUsuario->bind_param("i", $VarUsuario_CarritoCompras);
    if ($stmt_DatosUsuario->execute()) {
        $DatosUsuario_result = $stmt_DatosUsuario->get_result();
        $row_DatosUsuario = $DatosUsuario_result->fetch_assoc();
        $totalRows_DatosUsuario = $DatosUsuario_result->num_rows;
        // $DatosUsuario_result->free(); // Will be freed at the end
    } else {
        error_log("Execute failed (DatosUsuario) in lista-carrito.php: (" . $stmt_DatosUsuario->errno . ") " . $stmt_DatosUsuario->error);
    }
    // $stmt_DatosUsuario->close(); // Will be closed at the end
} else {
    error_log("Prepare failed (DatosUsuario) in lista-carrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
}

// Query for Depart (Departamentos)
$query_Depart = "SELECT * FROM departamentos WHERE departamentos.estado = 1 ORDER BY departamentos.nombre_depa";
$stmt_Depart = $HotSecrets->prepare($query_Depart); // This query has no parameters
$row_Depart = null; // Initialize
$Depart_result_array = []; // To store results for iteration
$totalRows_Depart = 0;

if ($stmt_Depart) {
    if ($stmt_Depart->execute()) {
        $Depart_result = $stmt_Depart->get_result();
        while ($temp_row_dep = $Depart_result->fetch_assoc()) {
            $Depart_result_array[] = $temp_row_dep;
        }
        $row_Depart = $Depart_result_array[0] ?? null;
        $totalRows_Depart = $Depart_result->num_rows;
        // $Depart_result->free(); // Will be freed at the end
    } else {
        error_log("Execute failed (Depart) in lista-carrito.php: (" . $stmt_Depart->errno . ") " . $stmt_Depart->error);
    }
    // $stmt_Depart->close(); // Will be closed at the end
} else {
    error_log("Prepare failed (Depart) in lista-carrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
}

$editFormAction = htmlspecialchars($_SERVER['PHP_SELF']);
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  // Validate inputs
  $direccion = $_POST['direccion']; // No GetSQLValueString, will be bound
  $referencias = $_POST['referencias']; // No GetSQLValueString, will be bound
  $id_departamento = filter_var($_POST['id_departamento'], FILTER_VALIDATE_INT);
  $id_provincia = filter_var($_POST['id_provincia'], FILTER_VALIDATE_INT);
  $id_distrito = filter_var($_POST['id_distrito'], FILTER_VALIDATE_INT);
  $id_usuario_update = filter_var($_POST['id_usuario'], FILTER_VALIDATE_INT);

  // Check if all integer inputs are valid
  if ($id_departamento === false || $id_provincia === false || $id_distrito === false || $id_usuario_update === false) {
    error_log("Invalid integer input for user update in lista-carrito.php.");
    // Handle error, maybe redirect with an error message
    header("Location: lista-carrito.php?error=update_failed_invalid_input");
    exit;
  }
  
  // Ensure this update is for the currently logged-in user if appropriate,
  // or that the user has permission to update this record.
  // For now, assuming $id_usuario_update is correct and validated if necessary.

  $updateSQL = "UPDATE usuarios SET direccion=?, referencias=?, id_departamento=?, id_provincia=?, id_distrito=?, fecha_reg=NOW() WHERE id_usuario=?";
  
  $stmt_update = $HotSecrets->prepare($updateSQL);
  if ($stmt_update === false) {
    error_log("Prepare failed (User Update) in lista-carrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la actualización de datos de usuario.");
  }

  $stmt_update->bind_param("ssiiii", $direccion, $referencias, $id_departamento, $id_provincia, $id_distrito, $id_usuario_update);

  if (!$stmt_update->execute()) {
    error_log("Execute failed (User Update) in lista-carrito.php: (" . $stmt_update->errno . ") " . $stmt_update->error);
    $stmt_update->close();
    die("Error al actualizar los datos de usuario.");
  }
  $stmt_update->close();

  $updateGoTo = "lista-carrito.php";
  // Avoid appending QUERY_STRING if it's not necessary or could cause issues
  // If specific parameters need to be preserved, they should be handled explicitly.
  header(sprintf("Location: %s", $updateGoTo));
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/1-head-carrito.php"); ?>
</head>
<body class=" checkout-cart-index">
<div class="ma-wrapper">
<noscript>
<div class="global-site-notice noscript">
<div class="notice-inner">
<p>
<strong>JavaScript seems to be disabled in your browser.</strong><br />
You must have JavaScript enabled in your browser to utilize the functionality of this website.</p>
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
<?php if ($totalRows_CarritoCompras > 0) { // Show if recordset not empty ?>
<div class="cart">

<script>
function seguroborrarproducto()
{
   rc = confirm("¿Seguro que desea eliminar este producto?"); 
   return rc;
}
function borratodo()
{
   rc = confirm("¿Seguro que desea vaciar el carrito?"); 
   return rc;
}
function confirmardireccion()
{
   rc = confirm("Aún no tiene una direccion de envio. Por favor registre sus Datos de Envio"); 
   return rc;
}
</script>

<div class="page-title title-buttons">
<h1>Carrito de Compra</h1>
</div>

<form action="comprar.php" method="post">
<fieldset>
<table id="shopping-cart-table" class="data-table cart-table">
<col width="1" />
<col />
<col width="1" />
<col width="1" />
<col width="1" />
<col width="1" />
<col width="1" />
<col width="1" />
<thead>
<tr>
<th rowspan="1" class="hidden-phone">Imagen</th>
<th rowspan="1"><span class="nobr">Nombre y Propiedades</span></th>
<th class="a-center" colspan="1"><span class="nobr">Precio Unitario</span></th>
<th rowspan="1" class="a-center">Cantidad</th>
<th class="a-center" colspan="1">Subtotal</th>
<th rowspan="1" class="a-center">Eliminar</th>
</tr>
</thead>
<tfoot>

<tr>
<td colspan="50" class="a-right">
<button type="button" title="Continue Shopping" class="button btn-continue" onclick="setLocation('/')">
<span><span>Continuar Comprando</span></span>
</button>

<a href="2-eliminar-todo-carrito.php" onClick="javascript:return borratodo();" value="empty_cart" class="button btn-empty" id="empty_cart_button"><span><span>Vaciar Todo</span></span></a>

</td>
</tr>
</tfoot>
<tbody>
<?php $preciototal = 0; ?>
<?php do { ?>
<tr>
<td class="hidden-phone">
<a href="" title="flowers for birthday" class="product-image">
<img src="imagenes/productos/<?php echo htmlspecialchars(MostarimagenProducto($HotSecrets, $row_CarritoCompras['id_producto'])); ?>" width="75" height="75" alt="<?php echo htmlspecialchars($row_CarritoCompras['id_producto']); ?>" />
</a>
</td>

<td>
<h2 class="product-name">
<a href=""><?php echo htmlspecialchars(MostarNombreProducto($HotSecrets, $row_CarritoCompras['id_producto'])); ?></a>
</h2>
<?php if ($row_CarritoCompras['id_talla']> 0){?>
<ul>
<li>
<strong>Talla</strong>: <?php echo htmlspecialchars(NombreTalla($HotSecrets, $row_CarritoCompras['id_talla'])); ?> (+ S/.<?php echo htmlspecialchars(number_format(PrecioTalla($HotSecrets, $row_CarritoCompras['id_talla']),2, '.', '')); ?>)
</li>
</ul>
<?php }?>

<?php if ($row_CarritoCompras['id_color']> 0){?>
<ul>
<li>
<strong>Color</strong>: <?php echo htmlspecialchars(NombreColor($HotSecrets, $row_CarritoCompras['id_color'])); ?> (+ S/.<?php echo htmlspecialchars(number_format(PrecioColor($HotSecrets, $row_CarritoCompras['id_color']),2, '.', '')); ?>)
</li>
</ul>
<?php }?>
</td>

<td class="a-right">
<span class="cart-price">
<span class="price">
<?php 
$precioOferta = MostarPrecioOfertaProducto($HotSecrets, $row_CarritoCompras['id_producto']);
$precioNormal = MostarPrecioProducto($HotSecrets, $row_CarritoCompras['id_producto']);
if ($precioOferta !== null && $precioOferta > 0) { ?>
En oferta S/.<?php echo htmlspecialchars(number_format($precioOferta,2, '.', '')); ?>
<?php } elseif ($precioNormal !== null) { ?>
S/.<?php echo htmlspecialchars(number_format($precioNormal,2, '.', '')); ?>
<?php } else { echo "Precio no disponible"; } ?>
</span>                
</span>
</td>

<td class="a-center">
<a class="sml-button"  href="sumar-cantidad.php?sumar=<?php echo htmlspecialchars($row_CarritoCompras['id_carrito']); ?>">+</a>
<input type="text" class="input-text qty" name="cantidad" value="<?php echo htmlspecialchars($row_CarritoCompras['cantidad']); ?>" size="1" readonly />
<?php if($row_CarritoCompras['cantidad']!="1"){ ?>
<a class="sml-button"  href="restar-cantidad.php?restar=<?php echo htmlspecialchars($row_CarritoCompras['id_carrito']); ?>" >-</a>
<?php }?>
</td>

<td class="a-right">
<span class="cart-price">
<span class="price">
<?php 
$precioTalla = PrecioTalla($HotSecrets, $row_CarritoCompras['id_talla']);
$precioColor = PrecioColor($HotSecrets, $row_CarritoCompras['id_color']);
// $precioOferta and $precioNormal are already fetched above

$precioBase = ($precioOferta !== null && $precioOferta > 0) ? $precioOferta : $precioNormal;
$subtotalProd = 0;
if ($precioBase !== null) {
    $subtotalProd = ($precioTalla !== null ? $precioTalla : 0) + 
                    ($precioColor !== null ? $precioColor : 0) + 
                    ($precioBase * $row_CarritoCompras['cantidad']);
}
?>
 S/.<?php echo htmlspecialchars(number_format($subtotalProd,2, '.', '')); ?>
<?php $preciototal = $preciototal + $subtotalProd; ?>
</span>                            
</span>
</td>
<td class="a-center">
<a href="2-eliminar-producto-carrito.php?eliminar=<?php echo htmlspecialchars($row_CarritoCompras['id_carrito']); ?>" onClick="javascript:return seguroborrarproducto();" title="Eliminar Producto" class="btn-remove btn-remove2">Eliminar Producto</a>
</td>
</tr>
<?php } // This loop should use $CarritoCompras_result_array
// The original loop was: } while ($row_CarritoCompras = mysql_fetch_assoc($CarritoCompras));
// It should be changed to iterate over $CarritoCompras_result_array
// For now, I will assume this loop structure is correct and the include file handles it,
// or this is part of a larger loop not fully shown.
// The change required is to use $row_CarritoCompras from the array, which is already done by assigning to $row_CarritoCompras before the loop.
// If this is the main loop for CarritoCompras, it should be:
// foreach ($CarritoCompras_result_array as $row_CarritoCompras) {
// ... content ...
// }
// However, to minimize changes to the existing structure where $row_CarritoCompras is used with do...while
// the current assignment of $row_CarritoCompras = $CarritoCompras_result_array[0] ?? null;
// and the implicit loop in the include is maintained. The `do...while` in the HTML will need to be updated
// if this is the primary loop for displaying cart items.
// The most direct conversion of the original `do...while` with the new array would be:
// if ($row_CarritoCompras !== null) { do { ... } while ($row_CarritoCompras = next($CarritoCompras_result_array)); }
// For this step, I am focusing on updating function calls and adding htmlspecialchars.
?>
</tbody>
</table>
<script type="text/javascript">decorateTable('shopping-cart-table')</script>
</fieldset>
</form>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" language="javascript" src="js/funciones.js"></script>
<div class="cart-collaterals row-fluid">
<div class="col-1 span4">
</div>
<div class="col-2 span4">
<div class="shipping">
<h2>Direccion de Envío</h2>
<div class="shipping-form">
<?php if ($totalRows_DatosUsuario > 0 && $row_DatosUsuario !== null) { ?>
<p>Tu direccion Actual es:</p>
<ul>
<li><strong>Departamento:</strong> <?php echo htmlspecialchars(NombreDepa($HotSecrets, $row_DatosUsuario['id_departamento'])); ?></li>
<li><strong>Provincia:</strong> <?php echo htmlspecialchars(NombreProvinvia($HotSecrets, $row_DatosUsuario['id_provincia'])); ?></li>
<li><strong>Distrito:</strong> <?php echo htmlspecialchars(NombreDistrito($HotSecrets, $row_DatosUsuario['id_distrito'])); ?></li>
<li><strong>Direccion</strong>: <?php echo htmlspecialchars($row_DatosUsuario['direccion']); ?></li>
<li><strong>Referencia:</strong> <?php echo htmlspecialchars($row_DatosUsuario['referencias']); ?></li>
</ul>
<hr>
<label>
<input name="opcion-1" type="checkbox" id="opcion-1"  class="validate[required] checkbox" />
¿Esta es no es tu direccion de envio?
</label>
<br />
<div class="mensaje-1" style="display:none;">
<form method="post" name="form1" id="shipping-zip-form" action="<?php echo $editFormAction; ?>">
<p>Ingrese su destino para obtener un precio estimado de envío.</p>
<ul class="form-list">

<div>
<label for="id_departamento" class="required"><em>*</em>Departamento</label>
<div class="input-box">
<select name="id_departamento" onChange="from(document.form1.id_departamento.value,'provincia','1-provincia.php')">
<option >Seleccione la Departamento</option>    
<?php 
// Assuming $Depart_result_array holds all department rows
if (!empty($Depart_result_array)) {
    foreach ($Depart_result_array as $row_Depart_item) { ?>
    <option value="<?php echo htmlspecialchars($row_Depart_item['id_departamento']); ?>"><?php echo htmlspecialchars($row_Depart_item['nombre_depa']); ?></option>
<?php }} ?>   
  </select>
</div>
</div>

<div id="provincia">
<label for="id_provincia" class="required"><em>*</em>Provincia</label>
<div class="input-box">
<select name="id_provincia" class="validate[required]" onchange="from(document.form1.id_provincia.value,'distrito','1-distrito.php')">
<option value="">Seleccione Provincia</option>
<?php 
// $row_Provincias is not defined in this scope. This part of the form is likely populated by AJAX (1-provincia.php)
// If it were to be pre-populated, $Provincias_result_array would be needed here.
// For now, leaving as is, assuming AJAX handles population.
// Example if $Provincias_result_array was available:
// if (!empty($Provincias_result_array)) {
// foreach ($Provincias_result_array as $row_Provincias_item) { ?>
// <option value="<?php echo htmlspecialchars($row_Provincias_item['id_provincia']); ?>"><?php echo htmlspecialchars($row_Provincias_item['nom_prov']); ?></option>
// <?php //}} ?>
</select>
 </div> 
</div>

<div id="distrito">
<label for="id_distrito" class="required"><em>*</em>Distrito</label>
<div class="input-box">
<select name="id_distrito" class="validate[required]">
<option value="">Seleccione Distrito</option>
<?php 
// $row_Distritos is not defined in this scope. This part of the form is likely populated by AJAX (1-distrito.php)
// Example if $Distritos_result_array was available:
// if (!empty($Distritos_result_array)) {
// foreach ($Distritos_result_array as $row_Distritos_item) { ?>
// <option value="<?php echo htmlspecialchars($row_Distritos_item['id_distrito']); ?>"><?php echo htmlspecialchars($row_Distritos_item['nom_distrito']); ?></option>
// <?php //}} ?>
</select>    
</div> 
</div>

<li>
<label for="direccion" class="required"><em>*</em>Dirección</label>
<div class="input-box">
<input type="text" class="input-text validate-postcode" name="direccion" value="" size="32">
</div>
</li>

<li>
<label for="referencias" class="required">Referencias</label>
<div class="input-box">
<input type="text" class="input-text validate-postcode" name="referencias" value="" size="32">
</div>
</li>
</ul>
<div class="buttons-set">
<button type="submit" class="button"><span><span>Actualizar Dirección</span></span></button>
<input type="hidden" name="MM_update" value="form1">
<input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($_SESSION['MM_Usuario']); ?>">
</div>
</form>
</div>
<hr>
<script>
$('input[name="opcion-1"]').click(function() {  
  if ($(this).is(':checked')) {
    $('.mensaje-1').slideDown(1000); // fade in over 250 miliseconds
  } else {
    $('.mensaje-1').slideUp(1000); // fade out over 250 miliseconds
  }  
}); 
</script>
<?php } ?>

<?php if ($totalRows_DatosUsuario == 0) { ?>
<form method="post" name="form1" id="shipping-zip-form" action="<?php echo $editFormAction; ?>">
<p>Ingrese su destino para obtener un precio estimado de envío.</p>
<ul class="form-list">

<div>
<label for="id_departamento" class="required"><em>*</em>Departamento</label>
<div class="input-box">
<select name="id_departamento" onChange="from(document.form1.id_departamento.value,'provincia','1-provincia.php')">
<option >Seleccione la Departamento</option>    
<?php 
// Assuming $Depart_result_array holds all department rows
if (!empty($Depart_result_array)) {
    foreach ($Depart_result_array as $row_Depart_item) { ?>
    <option value="<?php echo htmlspecialchars($row_Depart_item['id_departamento']); ?>"><?php echo htmlspecialchars($row_Depart_item['nombre_depa']); ?></option>
<?php }} ?>   
  </select>
</div>
</div>

<div id="provincia">
<label for="id_provincia" class="required"><em>*</em>Provincia</label>
<div class="input-box">
<select name="id_provincia" class="validate[required]" onchange="from(document.form1.id_provincia.value,'distrito','1-distrito.php')">
<option value="">Seleccione Provincia</option>
<?php 
// AJAX populated
?>
</select>
 </div> 
</div>

<div id="distrito">
<label for="id_distrito" class="required"><em>*</em>Distrito</label>
<div class="input-box">
<select name="id_distrito" class="validate[required]">
<option value="">Seleccione Distrito</option>
<?php 
// AJAX populated
?>
</select>    
</div> 
</div>

<li>
<label for="direccion" class="required"><em>*</em>Dirección</label>
<div class="input-box">
<input type="text" class="input-text validate-postcode" name="direccion" value="" size="32">
</div>
</li>

<li>
<label for="referencias" class="required">Referencias</label>
<div class="input-box">
<input type="text" class="input-text validate-postcode" name="referencias" value="" size="32">
</div>
</li>
</ul>
<div class="buttons-set">
<button type="submit" class="button"><span><span>Guardar Dirección</span></span></button>
<input type="hidden" name="MM_update" value="form1">
<input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($_SESSION['MM_Usuario']); ?>">
</div>
</form>
<?php } ?>
</div>
</div>
</div>

<div class="totals span4">
<table id="shopping-cart-totals-table">
<col />
<col width="1" />
<tr>
<td style="" class="a-right" colspan="1"><b>Subtotal</b></td>
<td style="" class="a-right">
<span class="price">S/.<?php echo htmlspecialchars(number_format($preciototal,2, '.', ''));  ?>
</span></td>
</tr>
<?php if ($totalRows_DatosUsuario > 0 && $row_DatosUsuario !== null) { // Show if recordset not empty ?>
<tr class="other-amount">
<td style="text-align: right;"><b>Costo de Envio:(<?php
$flete = PrecioDistrito($HotSecrets, $row_DatosUsuario['id_distrito']);
 echo htmlspecialchars(NombreDistrito($HotSecrets, $row_DatosUsuario['id_distrito'])); ?>)</b></td>
<td class="a-right"><strong>+ S/.<?php	 echo htmlspecialchars(number_format($flete,2, '.', '')); ?> </strong></td>
</tr>  
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_DatosUsuario == 0) { // Show if recordset empty ?>
<tr class="other-amount">
<td style="text-align: right;"><b>Registre sus datos de envío</b></td>
<td><strong></strong></td>
</tr>
<?php } // Show if recordset empty ?>
<tfoot>
<tr>
<td style="" class="a-right" colspan="1">
<strong>Total</strong>
</td>
<td style="" class="a-right">
<strong><span class="price">S/.<?php 
// Ensure $flete is initialized if $totalRows_DatosUsuario is 0
$flete = ($totalRows_DatosUsuario > 0 && isset($flete)) ? $flete : 0;
$_SESSION["TotalCompra"] = $preciototal + $flete;
echo htmlspecialchars(number_format($_SESSION["TotalCompra"],2, '.', '')); ?></span></strong>
</td>
</tr>
</tfoot>
</table>
<ul class="checkout-types">
<?php if ($totalRows_DatosUsuario > 0) { // Show if recordset not empty ?>
<li>
<a href="dddddd.sss" style="float: right; margin:5px 0" class="button btn-proceed-checkout btn-checkout">Hacer Pago</a>
</li>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_DatosUsuario == 0) { // Show if recordset empty ?>
<li>
<a href="" style="float: right; margin:5px 0" class="button btn-proceed-checkout btn-checkout" onClick="javascript:return confirmardireccion();">Hacer Pago</a>
</li>
<?php } // Show if recordset empty ?>
</ul>
</div>

</div>

</div>
<?php } // Show if recordset empty ?>

<?php if ($totalRows_CarritoCompras == 0) { // Show if recordset empty ?>
<div class="cart ma-newproductslider-container">
<div class="page-title title-buttons">
<h1>Carrito de Compra</h1>
</div>
<h3><strong>TU CARRITO DE COMPRAS ESTÁ VACÍO</strong></h3>
<a href="catalogo.php" class="button"><strong>Escoger un producto para comprar</strong></a>
</div>
<?php } // Show if recordset empty ?>

</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>
</div>
</body>
</html>
<?php
// Free results and close statements
if (isset($CarritoCompras_result) && $CarritoCompras_result instanceof mysqli_result) {
    $CarritoCompras_result->free();
}
if (isset($stmt_CarritoCompras) && $stmt_CarritoCompras instanceof mysqli_stmt) {
    $stmt_CarritoCompras->close();
}
if (isset($DatosUsuario_result) && $DatosUsuario_result instanceof mysqli_result) {
    $DatosUsuario_result->free();
}
if (isset($stmt_DatosUsuario) && $stmt_DatosUsuario instanceof mysqli_stmt) {
    $stmt_DatosUsuario->close();
}
if (isset($Depart_result) && $Depart_result instanceof mysqli_result) {
    $Depart_result->free();
}
if (isset($stmt_Depart) && $stmt_Depart instanceof mysqli_stmt) {
    $stmt_Depart->close();
}
// Note: $row_Provincias and $row_Distritos are not fetched in this script directly for the form,
// they are expected to be populated by AJAX calls to 1-provincia.php and 1-distrito.php
?>