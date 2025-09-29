<?php
session_start();
require_once '../config/config.php';
include  ENCABEZADO;

?>
<!DOCTYPE html>
<html lang="en">


<body>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrador</title>
    </head>


    <h1>Bienvenido al panel de administración</h1>
    <p>Hola,
        <?php
        echo $_SESSION['nombre'];
        ?>.
        Eres un administrador.</p>
    <a href="../logout.php">Cerrar sesión</a>

    <h2>Opciones de administración</h2>
    <ul>
        <li><a href="http://localhost:3000/">Gestionar usuarios</a></li>
        <li><a href="../roles/AdministracionRoles/verreportes.php">Ver reportes</a></li>
        <li><a href="../roles/AdministracionRoles/configuracion.php">Configuración del sistema</a></li>
    </ul>
</body>

</html>

<?php
// include 'conexion.php';
include_once PIEPAGINA; // contiene el navbar
?>