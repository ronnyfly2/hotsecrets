<?php
require_once("class.phpmailer.php"); 
$mail = new PHPMailer();

//$mail->Host("http://curso.cesarcancino.com");

	//***************************************
	//configuramos la información del correo o email
	$mail->From = "ventas@hotsecretsperu.com";
    $mail->FromName = "Nueva Persona Subscrita";
    $mail->Subject = "Suscribcion de Usuarios";
    $mail->AddAddress("quiero@hotsecretsperu.com");
	$mail->AddAddress("ventas@hotsecretsperu.com");
  //  $mail->AddAddress("destino2@correo.com","Nombre 02");
    //$mail->AddCC("usuariocopia@correo.com");
    $mail->AddBCC("ronny_the_fly7@hotmail.com");
	
	//******************************   
	      $var4=$_POST['email'];		  		  	
		  $var9=$_SERVER['REMOTE_ADDR'];	  
	      $boundary = md5(time().rand(1,100));
		  $fecha = date("d-M-y H:i");
		  
  $cuerpo.="".utf8_decode("Nueva Persona Subscrita")." <br>";
  $cuerpo.="--------DATOS-----------".$var21."<br>";   
  $cuerpo.="Correo: ".utf8_decode($var4)."<br>";  
  $cuerpo.="Enviado El dia  : ".$fecha."<br>";
  $cuerpo.="IP : ".$var9."<br>";
 $mail->Body = $cuerpo;
	 $mail->AltBody = "Nueva Persona Subscrita";
	  $mail->Send();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>HotScrets Perú | Tienda de Lenceria</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!--[if IE]>
            <style type="text/css">
                div.subscribe, div.timeblock {
                    background:transparent;
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#5081cece,endColorstr=#5081cece); 
                    zoom: 1;
                }

                h1.logo {
                    background:transparent;
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50FFFFFF,endColorstr=#50FFFFFF); 
                    zoom: 1;
                }        

                div.social a {
                    background:transparent;
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50e67a79,endColorstr=#50e67a79); 
                    zoom: 1;
                }        
            </style>
        <![endif]-->
    
</head>
    <body>
        <div class="wrapper">
            <div class="container header">
                <h1 class="logo" style="background:url(../imagenes/logo.png);"><strong style="display:none">HotSecrets Perú</strong></h1>
                <h3>No te preocupes, el nuevo sitio está casi hecho.</h3>
                <p><strong>Hot</strong>Secrets, una tienda online con lo mejor de lenceria</p>
            </div>
            <div class="timeblock clearfix">
                <div class="container">
                    <div class="timer clearfix">
                        <ul id="countdown">
                            <li>
                             
                                <span class="es">Muchas Gracias</span>
                                <p class=""> por suscribirte a nuestras ofertas</p>
                            </li>
                        </ul>
                    </div>
                </div>
       
        </div>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">/* CloudFlare analytics upgrade */
</script>
    </body>
</html>
