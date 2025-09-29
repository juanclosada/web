<?php

require_once 'utilitarias.php';
require_once '../controlador/conexion.php';
include_once '../config/config.php';
$db = new Conexion();
$datos['usuario_id'] = $_POST['id'];
$datos['nombre'] = $_POST['name'];
$datos['correo'] = $_POST['email'];
$datos['asunto'] = $_POST['subject'];
$datos['mensaje'] = $_POST['message'];
$db->insertarRegistro('contactos', $datos);
header("location: ../vista/contact.php?success=1");
// enviarEmail($_POST['email'], $_POST['subject'], $_POST['message']);
