<?php
$servername = "localhost"; // Aseg�rate de que 'localhost' sea correcto para tu servidor MySQL
$username = "root";        // Nombre de usuario de MySQL
$password = "itson";        // Contrase�a de MySQL
$dbname = "registro";      // Nombre de la base de datos

// Habilitar la visualizaci�n de errores para depuraci�n
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear conexi�n
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexi�n
if ($conn->connect_error) {
    die("Conexi�n fallida: " . $conn->connect_error);
}

// Verificar que las variables est�n definidas y no est�n vac�as
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
            echo "Inicio de sesi�n exitoso";
        } else {
            echo "Contrase�a incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

$conn->close();
?>

