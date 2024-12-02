<?php
include 'config.php';

function isValidInput($input) {
    return preg_match('/^[a-zA-Z0-9]+$/', $input);
}

$action = $_POST['action'];
$user = $conn->real_escape_string($_POST['username']);
$pass = $_POST['password'];

if (!isValidInput($user) || !isValidInput($pass)) {
    die("El nombre de usuario o la contraseña contienen caracteres no permitidos.");
}

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



