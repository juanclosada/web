<head>
    <link href="../vista/css/style.css" rel="stylesheet">
</head>
<?php
include '../controlador/conexion.php';
$db = new Conexion();
$_POST['contrasena'] = $_POST['contrasena1'] = 123456789;
// Obtener datos del formulario
$datos['nombre'] = mb_strtoupper($_POST['nombre']);
$datos["correo"] = $_POST['correo'];
$datos["contrasena"] = $_POST['contrasena'];
$contrasena1 = $_POST['contrasena1'];
$datos["id_rol"] = $_POST['id_rol'];
$user = $db->consultarRegistro('SELECT * FROM usuarios WHERE correo = :email', ['email' => $datos["correo"]]);
if (!$user) {
    if (strlen($datos["contrasena"]) < 8) {
        echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            La contraseña debe tener entre 8 y 20 caracteres..<br>
            </div>
            <a href="../vista/admin/usuarios" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
    </div>
';
    } else {
        if ($datos["contrasena"] == $contrasena1) {
            $datos["contrasena"] = password_hash($datos["contrasena"], PASSWORD_DEFAULT);
            $valid = $db->insertarRegistro('usuarios', $datos);
            header("location: ../vista/admin/usuarios.php");
        } else {
            echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            Las contraseñas no coinciden.<br>
            </div>
            <a href="../vista/admin/usuarios" class="btn btn-sm btn-primary mt-3">Ingresar Nuevamente</a>
    </div>
';
        }
    }
} else {
    echo '
    <div class="text-center" style="margin: 50px auto; max-width: 500px;">
        <div class="alert alert-danger text-center" role="alert">
            El usuario ya existe.<br>
            </div>
            <a href="../vista/admin/usuarios" class="btn btn-sm btn-primary mt-3">Intentar Nuevamente</a>
    </div>
';
}
