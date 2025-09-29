<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once('conexion.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT u.*, r.cargo FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol WHERE correo = :correo";
$db = new Conexion();

$usuario = $db->consultarRegistro($sql, ['correo' => $correo]);

if (!empty($usuario)) {
    if (password_verify($contrasena, $usuario["contrasena"])) {
        // Login exitoso - configurar sesión y redireccionar
        $_SESSION['usuario']['rol'] = $usuario['cargo'];
        $_SESSION['usuario']['id_rol'] = $usuario['id_rol'];
        $_SESSION['usuario']['nombre'] = $usuario['nombre'];
        $_SESSION['usuario']['id'] = $usuario['id_usuario'];
        $_SESSION['usuario']['correo'] = $usuario['correo'];

        switch ($usuario['id_rol']) {
            case '1':
                header("Location: ../vista/admin/dashboardadmin.php");
                exit(); // IMPORTANTE: siempre usar exit() después de header()
                break;
            case '3':
                header("Location: ../vista/index.php");
                exit(); // IMPORTANTE: siempre usar exit() después de header()
                break;
            default:
                // Rol no definido - mostrar mensaje de error
                echo '
                <div class="text-center" style="margin: 50px auto; max-width: 500px;">
                    <div class="alert alert-danger text-center" role="alert">
                        Rol no definido.<br>
                    </div>
                    <a href="../vista/login.php" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
                </div>';
                exit(); // Terminar ejecución aquí
                break;
        }
    } else {
        // Contraseña incorrecta
        echo '
        <div class="text-center" style="margin: 50px auto; max-width: 500px;">
            <div class="alert alert-danger text-center" role="alert">
               Las contraseñas no coinciden.<br>
            </div>
            <a href="../vista/login.php" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
        </div>';
        exit(); // Terminar ejecución aquí
    }
} else {
    // Usuario no existe
    echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            El usuario no existe.<br>
        </div>
        <a href="../vista/login.php" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
    </div>';
    exit(); // Terminar ejecución aquí
}
