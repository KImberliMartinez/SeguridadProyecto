<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // El servidor MySQL, típicamente 'localhost' si usas XAMPP o MAMP
$username = "root";         // El nombre de usuario para acceder a MySQL
$password = "root";         // La contraseña para acceder a MySQL (si estás utilizando XAMPP o MAMP, normalmente es "root")
$dbname = "registro";       // El nombre de la base de datos que estás utilizando

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);



// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    // Si ocurre un error en la conexión, lo mostramos
    die("Conexión fallida: " . $conn->connect_error);
}

// Si la conexión es exitosa, no es necesario imprimir nada, ya que la conexión está abierta.
// Opcionalmente puedes habilitar la visualización de errores en desarrollo:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
