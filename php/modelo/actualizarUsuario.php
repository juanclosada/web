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
$data['correo'] = $_POST['correo'] ?? '';
$data['id_rol'] = $_POST['id_rol'] ?? '';
// Validación básica
if ($data['nombre'] && $data['correo'] && $data['id_rol']) {

    $db->actualizarRegistro('usuarios', $data, ['id_usuario' => $_POST['id']]);
    header("location: ../vista/admin/usuarios.php");
} else {
    echo "❗ Por favor, completa todos los campos correctamente.";
}
