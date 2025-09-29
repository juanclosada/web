<?php

session_start();
require 'conexion.php';

$id_producto = $_POST['id'];
$cantidad_vendida = $_POST['stock'];

// Obtener stock actual
$sql = "SELECT cantidad FROM productos WHERE id = $id_producto";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$cantidad_actual = $row['stock'];

if ($cantidad_vendida <= $cantidad_actual) {
    // Descontar cantidad
    $nueva_cantidad = $cantidad_actual - $cantidad_vendida;
    $update = "UPDATE productos SET stock = $nueva_cantidad WHERE id = $id_producto";
    $conn->query($update);
    echo "Venta realizada. Nueva cantidad: $nueva_cantidad";
} else {
    echo "No hay suficiente stock para realizar esta venta.";
}

$conn->close();
?>
