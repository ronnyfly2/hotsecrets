<?php require_once('Connections/HotSecrets.php'); ?>
<?php
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which is included by Connections/HotSecrets.php

$VarProvincia_Distritos = "0";
if (isset($_GET["id"])) {
  $VarProvincia_Distritos = $_GET["id"];
}

// Ensure $HotSecrets is a valid mysqli object
if (!($HotSecrets instanceof mysqli)) {
    // Handle error: $HotSecrets is not correctly initialized
    error_log("MySQLi connection object is not available in 1-distrito.php");
    die("Error de conexión a la base de datos."); // Or a more user-friendly error
}

$query_Distritos = "SELECT * FROM distritos WHERE distritos.id_provincia = ?";
$stmt = $HotSecrets->prepare($query_Distritos);

if ($stmt === false) {
    error_log("Prepare failed in 1-distrito.php: (" . $HotSecrets->errno . ") " . $HotSecrets->error);
    die("Error al preparar la consulta."); // Or a more user-friendly error
}

$stmt->bind_param("i", $VarProvincia_Distritos);

if (!$stmt->execute()) {
    error_log("Execute failed in 1-distrito.php: (" . $stmt->errno . ") " . $stmt->error);
    die("Error al ejecutar la consulta."); // Or a more user-friendly error
}

$Distritos_result = $stmt->get_result();
$totalRows_Distritos = $Distritos_result->num_rows;

?>
<div id="distrito">
<label for="id_distrito" class="required"><em>*</em>Distrito</label>
<div class="input-box">
<select name="id_distrito" class="validate[required]">
<option value="">Escoja su Distrito</option>
<?php while ($row_Distritos = $Distritos_result->fetch_assoc()) { ?>
<option value="<?php echo $row_Distritos['id_distrito']; ?>"><?php echo htmlspecialchars($row_Distritos['nom_distrito']); ?></option>
<?php } ?>
</select>
</div> 
</div>
<?php
if (isset($Distritos_result)) {
    $Distritos_result->free();
}
if (isset($stmt)) {
    $stmt->close();
}
?>
