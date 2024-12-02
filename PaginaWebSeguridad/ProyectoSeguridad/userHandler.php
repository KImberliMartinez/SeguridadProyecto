<?php
$servername = "localhost"; // Asegúrate de que 'localhost' sea correcto para tu servidor MySQL
$username = "root";        // Nombre de usuario de MySQL
$password = "";        // Contraseña de MySQL
$dbname = "";      // Nombre de la base de datos

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que las variables estén definidas y no estén vacías
if (!isset($_POST['action'], $_POST['username'], $_POST['password'])) {
    die("Datos incompletos proporcionados.");
}

$action = $_POST['action'];
$user = $conn->real_escape_string($_POST['username']); // Escapar caracteres especiales
$pass = $_POST['password'];

if ($action == "register") {
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (username, password) VALUES ('$user', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action == "login") {
    $sql = "SELECT password FROM usuarios WHERE username='$user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            echo "Inicio de sesión exitoso";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

$conn->close();
?>

