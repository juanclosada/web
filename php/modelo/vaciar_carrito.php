<?php
session_start();
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: vista/login.php");
    die();
}
$db = new Conexion();
$db->eliminarRegistro('carrito', ['usuario_id' => $_SESSION['usuario']['id'], 'estado' => 1]);
redirecion();
