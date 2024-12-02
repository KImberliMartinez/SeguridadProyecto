<?php
// Incluir el archivo de configuración
include 'config.php';

// Función para validar las entradas (solo letras, números y guiones bajos)
function isValidInput($input) {
    return preg_match('/^[a-zA-Z0-9_]+$/', $input);
}

// Verificar si el formulario ha sido enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la acción desde el formulario
    $action = $_POST['action'];
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    // Validar los datos
    if (!isValidInput($user) || !isValidInput($pass)) {
        echo json_encode(["status" => "error", "message" => "El nombre de usuario o la contraseña contienen caracteres no permitidos."]);
        exit;
    }

    // Registro de usuario
    if ($action == "register") {
        // Verificar si el nombre de usuario ya existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Si el usuario ya existe, mostrar mensaje de error
            echo json_encode(["status" => "error", "message" => "El nombre de usuario ya está registrado."]);
        } else {
            // Hashear la contraseña antes de guardarla
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $stmt = $conn->prepare("INSERT INTO usuarios (username,password) VALUES (?, ?)");
            $stmt->bind_param("ss",$user,$hashed_password);

            if ($stmt->execute()) {
                // Si el registro es exitoso, devolver mensaje de éxito
                echo json_encode(["status" => "success", "message" => "Registro exitoso. Redirigiendo al login..."]);
            } else {
                // Si hay un error al insertar, devolver el mensaje de error
                echo json_encode(["status" => "error", "message" => "Error al registrar el usuario: " . $stmt->error]);
            }
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Acción no válida."]);
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método de solicitud no permitido."]);
}
?>


