<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "registro";

// Habilitar la visualizaci�n de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear conexi�n
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexi�n
if ($conn->connect_error) {
    die("Conexi�n fallida: " . $conn->connect_error);
}
echo "Conexi�n exitosa";
?>
