<head>
    <link href="../vista/css/style.css" rel="stylesheet">
</head>
<?php
include('conexion.php');
$db = new Conexion();

// Obtener datos del formulario
$datos['nombre'] = mb_strtoupper($_POST['nombre']) . ' ' . mb_strtoupper($_POST['apellido']);
$datos["correo"] = $_POST['correo'];
$datos["contrasena"] = $_POST['contrasena'];
$contrasena1 = $_POST['contrasena1'];
$datos["id_rol"] = $_POST['rol'];

$user = $db->consultarRegistro('SELECT * FROM usuarios WHERE correo = :email', ['email' => $datos["correo"]]);

if (!$user) {
    if (strlen($datos["contrasena"]) < 8) {
        echo '
        <div class="text-center" style="margin: 50px auto; max-width: 500px;">
            <div style="background-color:#f8d7da; color:#721c24; padding:10px; border-radius:4px; margin-bottom:15px;">
                La contraseña debe tener entre 8 y 20 caracteres.
            </div>
            <a href="../vista/registro.php" style="background-color:#ffc107; color:#000; padding:8px 16px; border-radius:4px; text-decoration:none;">Registrar Nuevamente</a>
        </div>';
    } else {
        if ($datos["contrasena"] == $contrasena1) {
            $datos["contrasena"] = password_hash($datos["contrasena"], PASSWORD_DEFAULT);
            $valid = $db->insertarRegistro('usuarios', $datos);
            if (!$valid) {
                echo '
                <div class="text-center" style="margin: 50px auto; max-width: 500px;">
                    <div style="background-color:#f8d7da; color:#721c24; padding:10px; border-radius:4px; margin-bottom:15px;">
                        El usuario no se registró correctamente.
                    </div>
                    <a href="../vista/registro.php" style="background-color:#ffc107; color:#000; padding:8px 16px; border-radius:4px; text-decoration:none;">Registrar Nuevamente</a>
                </div>';
            } else {
                echo '
                <div class="text-center" style="margin: 50px auto; max-width: 500px;">
                    <div style="background-color:#d4edda; color:#155724; padding:10px; border-radius:4px; margin-bottom:15px;">
                        Usuario registrado correctamente.
                    </div>
                    <a href="../vista/login.php" style="background-color:#ffc107; color:#000; padding:8px 16px; border-radius:4px; text-decoration:none;">Iniciar sesión</a>
                </div>';
            }
        } else {
            echo '
            <div class="text-center" style="margin: 50px auto; max-width: 500px;">
                <div style="background-color:#f8d7da; color:#721c24; padding:10px; border-radius:4px; margin-bottom:15px;">
                    Las contraseñas no coinciden.
                </div>
                <a href="../vista/registro.php" style="background-color:#ffc107; color:#000; padding:8px 16px; border-radius:4px; text-decoration:none;">Volver a intentar</a>
            </div>';
        }
    }
} else {
    echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div style="background-color:#f8d7da; color:#721c24; padding:10px; border-radius:4px; margin-bottom:15px;">
            El usuario ya está registrado.
        </div>
        <a href="../vista/login.php" style="background-color:#ffc107; color:#000; padding:8px 16px; border-radius:4px; text-decoration:none;">Iniciar sesión</a>
    </div>';
}
