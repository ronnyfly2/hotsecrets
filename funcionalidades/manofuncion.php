<?php
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
//********Obtener la Fecha en Noticias*****************
function FechaFormateada($FechaStamp)
{ $ano = date('Y',$FechaStamp);
  $mes = date('n',$FechaStamp);
  $dia = date('d',$FechaStamp);
  $diasemana = date('w',$FechaStamp);
  $hora = date("h:m:s a",$FechaStamp); 
  $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
                      "Jueves","Viernes","Sábado"); 
  $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                 "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  return $diassemanaN[$diasemana].", $dia de ". $mesesN[$mes] ." de $ano " .$hora;}
//*************Obtener la Fecha en Noticias 2**********
function FechaFormateada2($FechaStamp)
{ $ano = date('Y',$FechaStamp);
  $mes = date('n',$FechaStamp);
  $dia = date('d',$FechaStamp);
  $diasemana = date('w',$FechaStamp); 
  $diassemanaN= array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
  $mesesN=array(1=>"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
  return " $dia ". $mesesN[$mes];}
//********Obtener la Fecha en Lista PRoductos*****************
function FechaFormateada3($FechaStamp)
{ $ano = date('Y',$FechaStamp);
  $mes = date('n',$FechaStamp);
  $dia = date('d',$FechaStamp);
  $diasemana = date('w',$FechaStamp);
  $hora = date("h:mA",$FechaStamp); 
  $diassemanaN= array("Dom","Lun","Mar","Miér",
                      "Jue","Vie","Sáb"); 
  $mesesN=array(1=>"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
  return $diassemanaN[$diasemana].", $dia de ". $mesesN[$mes] ." de $ano " .$hora;}
//**********Obtener Url del Dominio********************
function dameURL()
{$url="http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
return $url;}
//**************Comprobar Correo unico*********
function ComprobarCorreoUnico($correounic)
{global $database_Pinky, $Pinky;
	mysql_select_db($database_Pinky, $Pinky);
	$query_DatosFuncion = "SELECT usuarios.correo FROM usuarios WHERE correo='".$correounic."'";
	$DatosFuncion = mysql_query($query_DatosFuncion, $Pinky) or die(mysql_error());
	$row_DatosFuncion = mysql_fetch_assoc($DatosFuncion);
	$totalRows_DatosFuncion = mysql_num_rows($DatosFuncion);	
	if  ($totalRows_DatosFuncion==0) return true;
		else return false;
	mysql_free_result($DatosFuncion);}
//********Obtener nombre Categoria*********************
function MostarNombreCategoria($Categoria)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Jueguetes, $Jueguetes);
$query_Marcas = sprintf("SELECT nom_categoria FROM categorias WHERE id_categoria = %s", $Categoria);
$Marcas = mysql_query($query_Marcas, $Jueguetes) or die(mysql_error());
$row_Marcas = mysql_fetch_assoc($Marcas);
$totalRows_Marcas = mysql_num_rows($Marcas);
return $row_Marcas['nom_categoria']; 
mysql_free_result($Marcas);}
//********Obtener nombre Sub-Categoria*********************
function MostarNombreSubCategoria($NomSub)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Subcat = sprintf("SELECT nom_subcat FROM subcategorias WHERE id_subcat = %s", $NomSub);
$Subcat = mysql_query($query_Subcat, $Pinky) or die(mysql_error());
$row_Subcat = mysql_fetch_assoc($Subcat);
$totalRows_Subcat = mysql_num_rows($Subcat);
return $row_Subcat['nom_subcat']; 
mysql_free_result($Subcat);}
//********Obtener nombre Marca*********************
function MostarNombreMarca($NomMarca)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT nom_marca FROM marcas WHERE id_marca = %s", $NomMarca);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['nom_marca']; 
mysql_free_result($Marca);}
//*********Obtener la URL del SEO********************
function ObtenerUrlSEOProducto($identificador12)
{global $database_Pinky, $Pinky;
	mysql_select_db($database_Pinky, $Pinky);
	$query_ConsultaFuncion = sprintf("SELECT id_producto FROM productos WHERE url_seo_prod = '%s'", $identificador12);
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $Pinky) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);	
	return $row_ConsultaFuncion['id_producto']; 
	mysql_free_result($ConsultaFuncion);}
//*************************************************************
function MostarImagenThumb($mostrarthumb)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Ofertas = sprintf("SELECT img_thumb_prod FROM imagenes_productos WHERE id_producto = %s", $mostrarthumb);
$Ofertas = mysql_query($query_Ofertas, $Pinky) or die(mysql_error());
$row_Ofertas = mysql_fetch_assoc($Ofertas);
$totalRows_Ofertas = mysql_num_rows($Ofertas);
return $row_Ofertas['img_thumb_prod']; 
	mysql_free_result($Ofertas);}	
//****************Mostrar tallas en Detalle***********************
function MostrarTallasProducto($identificador)
{
global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_ConsultaFuncion = sprintf("SELECT tallas_productos.id_talla, tallas_productos.nom_talla, tallas_productos.precio_talla FROM relacion_tallas Inner Join tallas_productos ON relacion_tallas.rel_talla = tallas_productos.id_talla WHERE relacion_tallas.rel_producto = %s", $identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $Pinky) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>
    <?php
	if ($totalRows_ConsultaFuncion > 0) { 
	?>
    <div class="option">
<b><span class="required">*</span> Selecciona Talla: </b>
    <select name="id_talla">
    <option value="0">Elegir talla</option>
    <?php
		do { 
		?>
<option value="<?php echo $row_ConsultaFuncion['id_talla']?>"><?php echo $row_ConsultaFuncion['nom_talla']?> (+ S/.<?php echo number_format($row_ConsultaFuncion['precio_talla'],2, '.', '');?>)</option>
	 <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		?>
        </select>
        </div>
        <?php
	}
	else
	{
	?>	
    <input name="id_talla" type="hidden" value="0" />
    <?php 
		}

	mysql_free_result($ConsultaFuncion);
}
//****************Mostrar tallas en Detalle***********************
function MostrarColorProducto($identificador)
{
global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_ConsultaFuncion = sprintf("SELECT colores_productos.id_color, colores_productos.nom_color, colores_productos.precio_color FROM relacion_colores Inner Join colores_productos ON relacion_colores.rel_color = colores_productos.id_color WHERE relacion_colores.rel_producto = %s", $identificador);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $Pinky) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>
    <?php
	if ($totalRows_ConsultaFuncion > 0) { 
	?>
    <div class="option">
<b><span class="required">*</span> Selecciona Color: </b>  
<?php
		do { 
		?> 
        <input name="id_color" type="hidden" value="0" />
<input type="radio" name="id_color" value="<?php echo $row_ConsultaFuncion['id_color']?>" id="option-value-5" />
<label for="option-value-5"><?php echo $row_ConsultaFuncion['nom_color']?> (+ S/.<?php echo number_format($row_ConsultaFuncion['precio_color'],2, '.', '');?>)</label><br />
	 <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		?>
        </select>
        </div>
        <?php
	}
	else
	{
	?>	<input name="id_color" type="hidden" value="0" />
    <?php 
		}

	mysql_free_result($ConsultaFuncion);
}
//********Obtener nombre Producto*********************
function MostarNombreProducto($NomProducto)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT nom_producto FROM productos WHERE id_producto = %s", $NomProducto);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['nom_producto']; 
mysql_free_result($Marca);}
//********Obtener nombre Producto*********************
function MostarPrecioProducto($PreProducto)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT precio_normal FROM productos WHERE id_producto = %s", $PreProducto);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['precio_normal']; 
mysql_free_result($Marca);}
//********Obtener nombre Producto*********************
function MostarPrecioOfertaProducto($PreOfProducto)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT precio_oferta FROM productos WHERE id_producto = %s", $PreOfProducto);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['precio_oferta']; 
mysql_free_result($Marca);}
//********Obtener nombre Producto*********************
function NombreTalla($tallarin)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT nom_talla FROM tallas_productos WHERE id_talla = %s", $tallarin);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nom_talla']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function PrecioTalla($tallarin)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT precio_talla FROM tallas_productos WHERE id_talla = %s", $tallarin);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['precio_talla']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function NombreColor($colorin)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT nom_color FROM colores_productos WHERE id_color = %s", $colorin);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nom_color']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function PrecioColor($Copre)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT precio_color FROM colores_productos WHERE id_color = %s", $Copre);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['precio_color']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function PrecioDistrito($Distrito)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT costo FROM distritos WHERE id_distrit = %s", $Distrito);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['costo']; 
mysql_free_result($Tallon);
PrecioDistrito($_SESSION['MM_UsuCliente']);}
//********Obtener nombre Producto*********************
function NombreDistrito($NomDistr)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT nombre_distr FROM distritos WHERE id_distrit = %s", $NomDistr);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nombre_distr']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function NombreDepa($NomDepart)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT nombre_depa FROM departamentos WHERE id_departamen = %s", $NomDepart);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nombre_depa']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function NombreCiudad($NomCiudad)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT nombre_ciud FROM ciudades WHERE id_ciudad = %s", $NomCiudad);
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['nombre_ciud']; 
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function ComproCuponDesc($Descupon)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT * FROM cupones WHERE estado > 0 AND codigo_cup = '".$Descupon."'");
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
if ($totalRows_Tallon > 0) return true; else return false;
mysql_free_result($Tallon);}
//********Obtener nombre Producto*********************
function Montocupon($Descupon)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Tallon = sprintf("SELECT valor_cup FROM cupones WHERE codigo_cup = '".$Descupon."'");
$Tallon = mysql_query($query_Tallon, $Pinky) or die(mysql_error());
$row_Tallon = mysql_fetch_assoc($Tallon);
$totalRows_Tallon = mysql_num_rows($Tallon);
return $row_Tallon['valor_cup']; 
mysql_free_result($Tallon);}
//********Obtener nombre Marca del producto*********************
function MostrarNombreMarca($NomMarca)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT nom_marca FROM marcas WHERE id_marca = %s", $NomMarca);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['nom_marca']; 
mysql_free_result($Marca);}
//*************************************************************
function recuperar_contrasena_admin($recuperar)
{$cadenarecuperacionpassadmin = substr(md5(rand()*time()),0,30);
global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
	$updateSQL = sprintf("UPDATE administradores SET recu_pass_admin=%s WHERE email_admin = %s",
					   GetSQLValueString($cadenarecuperacionpassadmin, "text"),
                       GetSQLValueString($recuperar, "text"));
	mysql_select_db($database_Pinky, $Pinky);
    $Result1 = mysql_query($updateSQL, $Pinky) or die(mysql_error());	
	$asunto="A un paso para recuperar tu password";
	$headers="Mime-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=utf-8\r\n";
	$headers .= 'From: Pinky <recuperar_tu_pass@hostcreat.com>' . "\r\n";
	$destinatario= $recuperar;
	$contenido='Haz solicitado la recuperación de tu contraseña de la administración<a href="http://www.hostcreat.com/livia/gextion/index.php">Pinky Girl</a><br />
	Por favor, haz click en el link siguiente para recuperar tu contraseña.
	<a href="http://www.hostcreat.com/livia/gextion/recuperar-pass-paso-3.php?id='.$cadenarecuperacionpassadmin.'&email='.$recuperar.'">Click aqui</a>';	
	mail($destinatario, $asunto, $contenido, $headers);}
//*************************************************************
function recuperar_contrasena_admin_final($passfinnal, $control)
{$cadenalimpiadmin = substr((rand()*time()*50*325),0,50);
$nuevopasswordadmin = md5($cadenalimpiadmin);
global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$updateSQL = sprintf("UPDATE administradores SET recu_pass_admin='', pass_admin = %s WHERE email_admin = %s",
GetSQLValueString($nuevopasswordadmin, "text"),
GetSQLValueString($passfinnal, "text"));
	mysql_select_db($database_Pinky, $Pinky);
    $Result1 = mysql_query($updateSQL, $Pinky) or die(mysql_error());	
	$asunto="Tu nuevo password";
	$headers="Mime-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=utf-8\r\n";
	$headers .= 'From: Pinky <recuperar_tu_pass@hostcreat.com>' . "\r\n";
	$destinatario= $passfinnal;
	$contenido='Has solicitado la recuperacion de contraseña en la administracion <a href="http://www.hostcreat.com/livia/gextion/index.php">Pinky Girl</a>. Tu nueva password es: <strong style="font-size:15px;">'.$cadenalimpiadmin.'</strong><br />
	Por favor, cambia tu password cuendo vuelvas a entrar al <a href="http://www.hostcreat.com/livia/gextion/index.php">Sistema</a>';	
	mail($destinatario, $asunto, $contenido, $headers);}
//*************************************************************
function Darse_Alta_usuario($darsealta)
{$altausuario = substr(md5(rand()*time()),0,30);
global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
	$updateSQL = sprintf("UPDATE usuarios SET altaok=%s WHERE correo = %s",
					   GetSQLValueString($altausuario, "text"),
                       GetSQLValueString($darsealta, "text"));
	mysql_select_db($database_Pinky, $Pinky);
    $Result1 = mysql_query($updateSQL, $Pinky) or die(mysql_error());	
	$asunto="Confirma tu correo";
	$headers="Mime-Version: 1.0\r\n";
    $headers.="Content-type: text/html; charset=utf-8\r\n";
	$headers .= 'From: Registro Pinky <no-reply@hostcreat.com>' . "\r\n";
	$destinatario= $darsealta;
	$contenido='Tus datos han sido registrados solo te falta un paso mas para darte de alta:<br />
	Para finalizar el proceso de registro deberar confirmar tu correo porfavor dale
	<a href="http://www.hostcreat.com/livia/alta-usuario-ok.php?id='.$altausuario.'&email='.$darsealta.'">Click aqui</a> para confirmar tu correo.';	
	mail($destinatario, $asunto, $contenido, $headers);}
//*************************************************************
function UsuarioAltaListo($Confirm, $control)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$updateSQL = sprintf("UPDATE usuarios SET altaok='', estado = 1 WHERE correo = %s",
GetSQLValueString($Confirm, "text"));
mysql_select_db($database_Pinky, $Pinky);
$Result1 = mysql_query($updateSQL, $Pinky) or die(mysql_error());}	
//********Obtener nombre Usuario*********************
function NombreUsuario($UsuarioNombre)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT nombre FROM usuarios WHERE id_usuario = %s", $UsuarioNombre);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['nombre']; 
mysql_free_result($Marca);}
//********Obtener nombre Usuario*********************
function ApellidoUsuario($UsuarioNombre)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT apellido FROM usuarios WHERE id_usuario = %s", $UsuarioNombre);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
return $row_Marca['apellido']; 
mysql_free_result($Marca);}
//***************************************************
function Comprobarexistensia($idproducto,$idtalla,$idcolor)
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_ConsultaFuncion = sprintf("SELECT * FROM carrito WHERE id_usuario = %s AND id_producto=%s AND id_talla=%s AND id_color=%s AND transaccion_efectuada = 0", $_SESSION['MM_UsuCliente'],$idproducto,$idtalla,$idcolor);
$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $Pinky) or die(mysql_error());
$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);	
if ($totalRows_ConsultaFuncion >0) 
return $row_ConsultaFuncion['id_carrito'];
else
return 0;
mysql_free_result($ConsultaFuncion);}
//********Obtener nombre Usuario*********************
function ComprobarCup()
{global $database_Pinky, $Pinky;
mysql_select_db($database_Pinky, $Pinky);
$query_Marca = sprintf("SELECT * FROM carrito WHERE id_usuario = %s AND id_producto=90000 AND transaccion_efectuada = 0", $_SESSION['MM_UsuCliente']);
$Marca = mysql_query($query_Marca, $Pinky) or die(mysql_error());
$row_Marca = mysql_fetch_assoc($Marca);
$totalRows_Marca = mysql_num_rows($Marca);
if ($totalRows_Marca>0)return true; return false;}
