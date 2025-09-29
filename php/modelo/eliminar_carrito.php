<?php
session_start();
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: vista/login.php");
    die();
}
$db = new Conexion();
$db->eliminarRegistro('carrito', ['id' => $_POST['carrito_id']]);
redirecion();
