<?php

session_start();
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../vista/login.php");
    die();
}

$db = new Conexion();
// Recibir datos del formulario (POST)
$data['nombre'] = $_POST['nombre'] ?? '';
$data['descripcion'] = $_POST['descripcion'] ?? '';
$data['precio'] = $_POST['precio'] ?? 0;
$data['stock'] = $_POST['stock'] ?? 0;
if (!empty($_POST['imagen'])) {
    $data['imagen'] = $_POST['imagen'];
}
// Validación básica
if ($data['nombre'] && $data['precio'] >= 0 && $data['stock'] >= 0) {
    $imagen_url = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = '../vista/img/' . time() . '_' . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $data['imagen'] = $rutaDestino;
        } else {
            die("❌ Error al mover la imagen.");
        }
    }
    $db->actualizarRegistro('productos', $data, ['id_producto' => $_POST['id']]);
    header("location: ../vista/admin/productos.php");
} else {
    echo "❗ Por favor, completa todos los campos correctamente.";
}
