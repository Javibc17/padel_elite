<?php
session_start();
include 'db_connection.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['contraseña'];

    // Consulta para verificar las credenciales del usuario
    $query = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Credenciales correctas, redirige al usuario al index
        $_SESSION['user'] = $email;
        echo json_encode(['status' => 'success']);
    } else {
        // Credenciales incorrectas
        echo json_encode(['status' => 'error', 'message' => 'Credenciales incorrectas']);
    }
}
?>