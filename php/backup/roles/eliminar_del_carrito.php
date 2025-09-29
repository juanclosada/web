<?php
session_start();
include '../controlador/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carrito_id'])) {
    $carrito_id = intval($_POST['carrito_id']);

    $sql = "DELETE FROM carrito WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $carrito_id, $_SESSION['id']);

    if ($stmt->execute()) {
        header('Location: ../roles/dashboardcliente.php');
        exit();
    } else {
        echo "Error al eliminar del carrito.";
    }
} else {
    echo "Petición inválida.";
}
