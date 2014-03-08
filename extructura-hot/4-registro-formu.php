<style>
.capaerrores{
	display:none;
	font-size: 12px;
	background-color: #FFB7B9;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	margin: 3px;
	font-weight: 100;
	color: #A50505;
	background-image: url(../imagenes/iconos/error.png);
	background-repeat: no-repeat;
	background-position: left top;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 25px;
	float: left;	
}
.capaexito{
	display:none;
	font-size: 12px;
	background-color: #8bea92;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	padding: 5px;
	margin-top: 3px;
	font-weight: 100;
	float: left;	
	color: #276d2c;
	background-image: url(../imagenes/iconos/check.png);
	background-repeat: no-repeat;
	background-position: left top;
	padding-top: 5px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 25px;
	width: 182px;
}
</style>
<script>
function valEmail(valor){ 
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(valor))    {
        return false;
    }else{
        return true;
    }
}
function validateformregistro()
{
    valid = true;
	$("#aviso1").hide("slow");
	$("#aviso2").hide("slow");
	$("#aviso3").hide("slow");
	$("#aviso4").hide("slow");
	$("#aviso5").hide("slow");
	$("#aviso6").hide("slow");
	$("#aviso7").hide("slow");
	$("#aviso10").hide("slow");
	$("#aviso11").hide("slow");
	document.formregistro.nombre.style.border='1px solid #EEEEEE';
	document.formregistro.correo.style.border='1px solid #EEEEEE';	
	document.formregistro.password.style.border='1px solid #EEEEEE';
	document.formregistro.password2.style.border='1px solid #EEEEEE';
	document.formregistro.suma.style.border='1px solid #EEEEEE';
	//COLORES
	if (document.formregistro.nombre.value == ""){
		$("#aviso1").show("slow");
		document.formregistro.nombre.style.border='1px solid red';
	    valid = false;
	}
	if (document.formregistro.correo.value == ""){
		$("#aviso2").show("slow");
		document.formregistro.correo.style.border='1px solid red';
	    valid = false;
	}
	if (document.formregistro.password.value == ""){
		$("#aviso5").show("slow");
		document.formregistro.password.style.border='1px solid red';
	    valid = false;
	}
	if (document.formregistro.password2.value == ""){
		$("#aviso6").show("slow");
		document.formregistro.password2.style.border='1px solid red';
	    valid = false;
	}
	if (document.formregistro.acepto.checked == false)
		{
			$("#aviso10").show("slow");
	        valid = false;
		}
		
	//FIN ERRORES DE CAMPOS VACIOS
	if (!valEmail(document.formregistro.correo.value)){
		$("#aviso2").show("slow");
		document.formregistro.correo.style.border='1px solid red';
	    valid = false;
	}	
	if (document.formregistro.suma.value != 22){
			$("#aviso11").show("slow");
			document.formregistro.suma.style.border='1px solid red';
			valid = false;
		}
	//FIN DE ERRORES DE EMAIL	
		if (document.formregistro.password.value != document.formregistro.password2.value){
		$("#aviso7").show("slow");
		document.formregistro.password2.style.border='1px solid red';
	    valid = false;
	}

	return valid;
}</script>
<form name="formregistro" id="formregistro" action="<?php echo $editFormAction; ?>" method="post" onsubmit="javascript:return validateformregistro();">
<div class="fieldset">
<h2 class="legend">Informacion Personal</h2>
<ul class="form-list">
<li class="fields">
<div class="customer-name">
<div class="field name-firstname">
<label for="nombre" class="required"><em>*</em>Nombres</label>
<div class="input-box">
<input type="text" name="nombre" value="" maxlength="255" class="input-text required-entry" />
<div class="capaerrores" id="aviso1">Debes escribir un nombre.</div>
</div>
</div>
<div class="field name-lastname">
<label for="apellido" class="required"><em>*</em>Apellidos</label>
<div class="input-box">
<input type="text" name="apellido" value="" maxlength="255" class="input-text required-entry"  />
</div>
</div>
</div>
</li>
<li>
<label for="correo" class="required"><em>*</em>Email</label>
<div class="input-box">
<input type="text" name="correo" value="" onblur="javascript:controlaremailunico();" class="input-text validate-email required-entry" />
</div>
<div class="capaerrores" id="aviso2">Debes escribir un e-mail válido y existente.</div>
<div class="capaerrores" id="aviso8">
Atención, el usuario ya está siendo utilizado. Escoge otro email o recupera tu contraseña.</div>
<div class="capaexito" id="exito1">E-mail válido.</div>
</li>

<li class="control">
<div class="input-box">
<input type="checkbox" name="suscrito" value="" id="suscrito" class="checkbox" />
</div>
<label for="suscrito">Registrarse al newsletter</label>
</li>
<li class="control">
<div class="input-box">
<input type="checkbox" name="acepto" value="1" class="checkbox" />
</div>
<label for="acepto">Acepto los Términos y Condiciones</label>
<div class="capaerrores" id="aviso10">Atención, debes aceptar la política de uso.</div>
</li>
</ul>
</div>

<div class="fieldset">
<h2 class="legend">Informacion de sesión</h2>
<ul class="form-list">
<li class="fields">
<div class="field">
<label for="password" class="required"><em>*</em>Password</label>
<div class="input-box">
<input type="password" name="password" id="password" class="input-text" />
</div>
</div>
<div class="field">
<label for="password2" class="required"><em>*</em>Confirmar Password</label>
<div class="input-box">
<input type="password" name="password2" id="password2" class="input-text" />
</div>
<div class="capaerrores" id="aviso6">Debes escribir una contraseña.</div>
<div class="capaerrores" id="aviso7">Atención, las contraseñas no coinciden.</div>
</div>
<div class="field">
<label class="required"><em>*</em>¿Cuanto es 8+14?:</label>
<input type="text" name="suma"  maxlength="5" class="input-text" />

<div class="capaerrores" id="aviso11">No es la respuesta.</div>
</div>
</li>
</ul>
<p class="required">* Campos requeridos</p>
</div>
<div class="buttons-set">
<p class="back-link"><a href="index.php" class="back-link"><small>&laquo; </small>Regresar</a></p>
<button type="submit" title="Submit" class="button" id="registrarme" name="registrarme" disabled><span><span>Registrarme</span></span></button>
<input type="hidden" name="MM_insert" value="formregistro">
</div>
</form>
<script type="text/javascript">
function controlaremailunico()
{
	var emailinsertado = document.formregistro.correo.value;
	$.ajax({
		type: "POST",
		url:"funcionalidades/dinafuncion-ajax.php",
		data: 'correo='+emailinsertado+'&formid=1',
		success: function(resp)
		{  
			//El email no se encuentra en la BD, el alta se puede dar.
			if (resp==1)
			{
 				 $("#aviso8").hide("fast");
				 $("#aviso2").hide("slow");	
				 $("#exito1").show("slow");
				 document.formregistro.registrarme.disabled=false;
			}
			//El email se ecncuentra en la BD, no podemos dejar que se de de alta.
			if (resp==0)
			{
				 $("#exito1").hide("fast");
				 $("#aviso2").hide("slow");
				 $("#aviso8").show("slow");				 
				 document.formregistro.registrarme.disabled=true;
			}
			if (resp==2)
			{
				 $("#exito1").hide("fast");
				 $("#aviso8").hide("slow");	
				 $("#aviso2").show("slow");				 				 
				 document.formregistro.registrarme.disabled=true;
			}
		}
		});
}
</script>