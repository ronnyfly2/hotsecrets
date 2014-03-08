<?php 

if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
	
	if (($_FILES['userfile']['size']>1048576 ) || ((end(explode(".", $_FILES['userfile']['name']))!="jpg") && (end(explode(".", $_FILES['userfile']['name']))!="png")))
		echo "No puedes subir archivos que pesen mas de 1Mb. Y los archivos deben ser .jpg o .png";
		else 
		{
	$nombre_archivo = $_FILES['userfile']['name'];
	move_uploaded_file($_FILES['userfile']['tmp_name'], "../imagenes/productos/".$nombre_archivo);	
	?>
    <script>
		opener.document.form1.imagenes.value="<?php echo $nombre_archivo; ?>";
		//opener.document.getElementById("img_peque").src="../imagenes/productos/tumbs/<?php //echo $nombre_archivo; ?>"			
		self.close();
	</script>
    <?php
	 }
	  }
	   else {  ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Subir imagen pequeña</title>
</head>

<body>

<form action="2-subir-imagenes-del-producto.php" method="post" enctype="multipart/form-data" id="form1">
<p>
<input name="userfile" type="file">
</p>
<p>
<input type="submit" name="button" id="button" value="subir imagen">
</p>
<input type="hidden" name="enviado" value="form1">
</form>

</body>
</html>
<?php }?>