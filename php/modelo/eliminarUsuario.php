<?php
session_start();
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: vista/login.php");
    die();
}
$db = new Conexion();
$db->eliminarRegistro('usuarios', ['id_usuario' => base64_decode($_GET['id'])]);
header("location: ../vista/admin/usuarios.php");
