<?php
ob_start();
include '../controlador/conexion.php';

$db = new Conexion();
$redirect_url = '';

if (empty($_POST['correo'])) {
    $redirect_url = "../vista/recordarPass.php?error=1";
} else {
    $usuario = $db->consultarRegistro('SELECT * FROM usuarios WHERE correo = :email', ['email' => $_POST['correo']]);

    if (!$usuario) {
        $redirect_url = "../vista/recordarPass.php?error=2";
    } else {
        $aleatorio = random_int(100000, 999999);
        $update = $db->actualizarRegistro('usuarios', ['contrasena' => password_hash($aleatorio, PASSWORD_DEFAULT)], ['id_usuario' => $usuario['id_usuario']]);

        if ($update) {
            $redirect_url = "../vista/login.php?error=3";
        } else {
            $redirect_url = "../vista/recordarPass.php?error=2";
        }
    }
}

header("Location: $redirect_url");
exit();
