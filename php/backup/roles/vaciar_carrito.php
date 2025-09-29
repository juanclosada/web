<?php
session_start();
include '../controlador/conexion.php';

if (isset($_SESSION['id'])) {
    $usuario_id = $_SESSION['id'];

    $sql = "DELETE FROM carrito WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);

    if ($stmt->execute()) {
        header("Location: ../roles/dashboardcliente.php");
        exit();
    } else {
        echo "Error al vaciar el carrito.";
    }
} else {
    echo "Sesión no válida.";
}
