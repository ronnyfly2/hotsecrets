<?php require_once('Connections/HotSecrets.php');
 require_once('1-restrincion-usuario.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$VarUsuario_CarritoCompras = "0";
if (isset($_SESSION["MM_Usuario"])) {
  $VarUsuario_CarritoCompras = $_SESSION["MM_Usuario"];
}
mysql_select_db($database_HotSecrets, $HotSecrets);
$query_CarritoCompras = sprintf("SELECT * FROM carrito WHERE carrito.id_usuario = %s AND carrito.transaccion_efectuada = 0 ORDER BY id_carrito DESC", GetSQLValueString($VarUsuario_CarritoCompras, "int"));
$CarritoCompras = mysql_query($query_CarritoCompras, $HotSecrets) or die(mysql_error());
$row_CarritoCompras = mysql_fetch_assoc($CarritoCompras);
$totalRows_CarritoCompras = mysql_num_rows($CarritoCompras);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_DatosUsuario = sprintf("SELECT * FROM usuarios WHERE usuarios.id_departamento>0 AND usuarios.id_provincia>0 AND usuarios.id_distrito>0 AND usuarios.id_usuario = %s", GetSQLValueString($VarUsuario_CarritoCompras, "int"));
$DatosUsuario = mysql_query($query_DatosUsuario, $HotSecrets) or die(mysql_error());
$row_DatosUsuario = mysql_fetch_assoc($DatosUsuario);
$totalRows_DatosUsuario = mysql_num_rows($DatosUsuario);

mysql_select_db($database_HotSecrets, $HotSecrets);
$query_Depart = "SELECT * FROM departamentos WHERE departamentos.estado = 1 ORDER BY departamentos.nombre_depa";
$Depart = mysql_query($query_Depart, $HotSecrets) or die(mysql_error());
$row_Depart = mysql_fetch_assoc($Depart);
$totalRows_Depart = mysql_num_rows($Depart);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET  direccion=%s, referencias=%s, id_departamento=%s, id_provincia=%s, id_distrito=%s, fecha_reg=NOW() WHERE id_usuario=%s",
  						GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['referencias'], "text"),
                        GetSQLValueString($_POST['id_departamento'], "int"),
                       GetSQLValueString($_POST['id_provincia'], "int"),
                       GetSQLValueString($_POST['id_distrito'], "int"),                                              
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_HotSecrets, $HotSecrets);
  $Result1 = mysql_query($updateSQL, $HotSecrets) or die(mysql_error());

  $updateGoTo = "lista-carrito.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
<img src="imagenes/productos/<?php echo MostarimagenProducto($row_CarritoCompras['id_producto']); ?>" width="75" height="75" alt="<?php echo $row_CarritoCompras['id_producto']; ?>" />
</a>
</td>

<td>
<h2 class="product-name">
<a href=""><?php echo MostarNombreProducto($row_CarritoCompras['id_producto']); ?></a>
</h2>
<?php if ($row_CarritoCompras['id_talla']> 0){?>
<ul>
<li>
<strong>Talla</strong>: <?php echo NombreTalla($row_CarritoCompras['id_talla']); ?> (+ S/.<?php echo number_format(PrecioTalla($row_CarritoCompras['id_talla']),2, '.', ''); ?>)
</li>
</ul>
<?php }?>

<?php if ($row_CarritoCompras['id_color']> 0){?>
<ul>
<li>
<strong>Color</strong>: <?php echo NombreColor($row_CarritoCompras['id_color']); ?> (+ S/.<?php echo number_format(PrecioColor($row_CarritoCompras['id_color']),2, '.', ''); ?>)
</li>
</ul>
<?php }?>
</td>

<td class="a-right">
<span class="cart-price">
<span class="price">
<?php if (MostarPrecioOfertaProducto($row_CarritoCompras['id_producto']) > 0) { // Show if recordset not empty ?>
En oferta S/.<?php echo number_format(MostarPrecioOfertaProducto($row_CarritoCompras['id_producto']),2, '.', ''); ?>
<?php } // Show if recordset not empty ?>
<?php if (MostarPrecioOfertaProducto($row_CarritoCompras['id_producto']) == 0) { // Show if recordset empty ?>
S/.<?php echo number_format(MostarPrecioProducto($row_CarritoCompras['id_producto']),2, '.', ''); ?>
<?php } // Show if recordset empty ?>
</span>                
</span>
</td>

<td class="a-center">
<a class="sml-button"  href="sumar-cantidad.php?sumar=<?php echo $row_CarritoCompras['id_carrito']; ?>">+</a>
<input type="text" class="input-text qty" name="cantidad" value="<?php echo $row_CarritoCompras['cantidad']; ?>" size="1" readonly />
<?php if($row_CarritoCompras['cantidad']!="1"){ ?>
<a class="sml-button"  href="restar-cantidad.php?restar=<?php echo $row_CarritoCompras['id_carrito']; ?>" >-</a>
<?php }?>
</td>

<td class="a-right">
<span class="cart-price">
<span class="price">
<?php if ((MostarPrecioOfertaProducto($row_CarritoCompras['id_producto'])) && (MostarPrecioOfertaProducto($row_CarritoCompras['id_producto']) != "")){?>
<?php 
$subtotalProd = PrecioTalla($row_CarritoCompras['id_talla']) + PrecioColor($row_CarritoCompras['id_color'])+ MostarPrecioOfertaProducto($row_CarritoCompras['id_producto'])*$row_CarritoCompras['cantidad'];  ?>
<?php  }else {?>
<?php
$subtotalProd =PrecioTalla($row_CarritoCompras['id_talla']) + PrecioColor($row_CarritoCompras['id_color'])+ MostarPrecioProducto($row_CarritoCompras['id_producto'])*$row_CarritoCompras['cantidad'];  ?>
<?php }?>
 S/.<?php echo number_format($subtotalProd,2, '.', ''); ?>
<?php $preciototal = $preciototal + $subtotalProd; ?>
</span>                            
</span>
</td>
<td class="a-center">
<a href="2-eliminar-producto-carrito.php?eliminar=<?php echo $row_CarritoCompras['id_carrito']; ?>" onClick="javascript:return seguroborrarproducto();" title="Eliminar Producto" class="btn-remove btn-remove2">Eliminar Producto</a>
</td>
</tr>
<?php } while ($row_CarritoCompras = mysql_fetch_assoc($CarritoCompras)); ?>
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
<?php if ($totalRows_DatosUsuario > 0) { ?>
<p>Tu direccion Actual es:</p>
<ul>
<li><strong>Departamento:</strong> <?php echo NombreDepa($row_DatosUsuario['id_departamento']); ?></li>
<li><strong>Provincia:</strong> <?php echo NombreProvinvia($row_DatosUsuario['id_provincia']); ?></li>
<li><strong>Distrito:</strong> <?php echo NombreDistrito($row_DatosUsuario['id_distrito']); ?></li>
<li><strong>Direccion</strong>: <?php echo $row_DatosUsuario['direccion']; ?></li>
<li><strong>Referencia:</strong> <?php echo $row_DatosUsuario['referencias']; ?></li>
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
<?php do { ?>
    <option value="<?php echo $row_Depart['id_departamento']; ?>"><?php echo $row_Depart['nombre_depa']; ?></option>
<?php } while ($row_Depart = mysql_fetch_assoc($Depart)); ?>   
  </select>
</div>
</div>

<div id="provincia">
<label for="id_provincia" class="required"><em>*</em>Provincia</label>
<div class="input-box">
<select name="id_provincia" class="validate[required]" onchange="from(document.form1.id_provincia.value,'distrito','1-distrito.php')">
<option value="">Seleccione Provincia</option>
<?php do { ?>
<option value="<?php echo $row_Provincias['id_provincia']; ?>"><?php echo $row_Provincias['nom_prov']; ?></option>
<?php } while ($row_Provincias = mysql_fetch_assoc($Provincias)); ?>
</select>
 </div> 
</div>

<div id="distrito">
<label for="id_distrito" class="required"><em>*</em>Distrito</label>
<div class="input-box">
<select name="id_distrito" class="validate[required]">
<option value="">Seleccione Distrito</option>
<?php do { ?>
<option value="<?php echo $row_Distritos['id_distrito']; ?>"><?php echo $row_Distritos['nom_distrito']; ?></option>
<?php } while ($row_Distritos = mysql_fetch_assoc($Distritos)); ?>
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
<button type="submit" onclick="coShippingMethodForm.submit()" class="button"><span><span>Obtener Costo</span></span></button>
<input type="hidden" name="MM_update" value="form1">
<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['MM_Usuario']; ?>">
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
<?php do { ?>
    <option value="<?php echo $row_Depart['id_departamento']; ?>"><?php echo $row_Depart['nombre_depa']; ?></option>
<?php } while ($row_Depart = mysql_fetch_assoc($Depart)); ?>   
  </select>
</div>
</div>

<div id="provincia">
<label for="id_provincia" class="required"><em>*</em>Provincia</label>
<div class="input-box">
<select name="id_provincia" class="validate[required]" onchange="from(document.form1.id_provincia.value,'distrito','1-distrito.php')">
<option value="">Seleccione Provincia</option>
<?php do { ?>
<option value="<?php echo $row_Provincias['id_provincia']; ?>"><?php echo $row_Provincias['nom_prov']; ?></option>
<?php } while ($row_Provincias = mysql_fetch_assoc($Provincias)); ?>
</select>
 </div> 
</div>

<div id="distrito">
<label for="id_distrito" class="required"><em>*</em>Distrito</label>
<div class="input-box">
<select name="id_distrito" class="validate[required]">
<option value="">Seleccione Distrito</option>
<?php do { ?>
<option value="<?php echo $row_Distritos['id_distrito']; ?>"><?php echo $row_Distritos['nom_distrito']; ?></option>
<?php } while ($row_Distritos = mysql_fetch_assoc($Distritos)); ?>
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
<button type="submit" onclick="coShippingMethodForm.submit()" class="button"><span><span>Obtener Costo</span></span></button>
<input type="hidden" name="MM_update" value="form1">
<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['MM_Usuario']; ?>">
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
<span class="price">S/.<?php echo number_format($preciototal,2, '.', '');  ?>
</span></td>
</tr>
<?php if ($totalRows_DatosUsuario > 0) { // Show if recordset not empty ?>
<tr class="other-amount">
<td style="text-align: right;"><b>Costo de Envio:(<?php
$flete = PrecioDistrito($row_DatosUsuario['id_distrito']);
 echo NombreDistrito($row_DatosUsuario['id_distrito']); ?>)</b></td>
<td class="a-right"><strong>+ S/.<?php	 echo number_format($flete,2, '.', ''); ?> </strong></td>
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
$_SESSION["TotalCompra"] = $preciototal + $flete;
echo number_format($_SESSION["TotalCompra"],2, '.', ''); ?></span></strong>
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
mysql_free_result($CarritoCompras);
mysql_free_result($DatosUsuario);
mysql_free_result($Depart);
?>