<?php require_once('Connections/HotSecrets.php'); ?>
<?php
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which is included by Connections/HotSecrets.php

$VarDeparta_Provincias = "0";
if (isset($_GET["id"])) {
  $VarDeparta_Provincias = $_GET["id"];
}

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    // Handle error: $HotSecrets is not correctly initialized
    error_log("MySQLi connection object is not available in 1-provincia.php");
    die("Error de conexión a la base de datos."); // Or a more user-friendly error
}

$query_Provincias = "SELECT * FROM provincias WHERE provincias.id_departamento = ?";
$stmt = $HotSecrets->prepare($query_Provincias);

if ($stmt === false) {
    error_log("Prepare failed in 1-provincia.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la consulta."); // Or a more user-friendly error
}

$stmt->bind_param("i", $VarDeparta_Provincias);

if (!$stmt->execute()) {
    error_log("Execute failed in 1-provincia.php: (" . $stmt->errno . ") " . $stmt->error);
    die("Error al ejecutar la consulta."); // Or a more user-friendly error
}

$Provincias_result = $stmt->get_result();
$totalRows_Provincias = $Provincias_result->num_rows;

?>
<div id="provincia">
<label for="id_provincia" class="required"><em>*</em>Provincia</label>
<div class="input-box">
<select name="id_provincia" class="validate[required]" onchange="from(document.form1.id_provincia.value,'distrito','1-distrito.php')">
<option value="">Escoja su Provincia</option>
<?php while ($row_Provincias = $Provincias_result->fetch_assoc()) { ?>
<option value="<?php echo $row_Provincias['id_provincia']; ?>"><?php echo htmlspecialchars($row_Provincias['nom_prov']); ?></option>
<?php } ?>
</select>
 </div> 
</div>
<?php
if (isset($Provincias_result)) {
    $Provincias_result->free();
}
if (isset($stmt)) {
    $stmt->close();
}
?>
