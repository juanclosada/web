<?php
session_start();
session_unset();
session_destroy();
?>
<?php
require_once 'config/config.php';
include  ENCABEZADO;
?>
<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <title>Sesión cerrada</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center shadow">
                    <div class="card-header bg-danger text-white">
                        <h4>Sesión cerrada</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Has cerrado sesión correctamente.</p>
                        <a href="Inicio_sesion.php" class="btn btn-primary">🔑 Iniciar Sesión de nuevo</a>

                    </div>
                    <div class="card-footer text-muted">
                        Gracias por tu visita.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// include 'conexion.php';
include_once PIEPAGINA; // contiene el navbar
?>