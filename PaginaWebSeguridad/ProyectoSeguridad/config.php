<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "registro";

// Habilitar la visualizacion de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexion
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}
echo "Conexion exitosa";
?>
