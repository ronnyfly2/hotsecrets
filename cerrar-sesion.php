<?php require_once('Connections/HotSecrets.php');
// The GetSQLValueString function is now expected to be included from funcionalidades/funciones-hot.php
// which is included by Connections/HotSecrets.php

// Ensure session is started. Connections/HotSecrets.php should handle this.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['MM_Username'] = "";
$_SESSION['MM_UserGroup'] = "";	
$_SESSION['MM_Usuario'] = "";

// Optional: Destroy the session completely for a more secure logout
// session_unset(); // Unset all session variables
// session_destroy(); // Destroy the session

$updateGoTo = "index.php";
header(sprintf("Location: %s", $updateGoTo));	
exit; // Ensure script termination after redirect
?>