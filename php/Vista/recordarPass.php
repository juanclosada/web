<?php
// TODO EL CÓDIGO PHP DEBE IR AQUÍ PRIMERO
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$txt = 'Digite su correo electrónico:';
if (!empty($_GET['error'])) {
    switch ($_GET['error']) {
        case '1':
            $txt = 'No se envio el correo.';
            break;
        case '2':
            $txt = 'No se encontro el usuario.';
            break;
    }
}

if (!empty($_SESSION['usuario'])) {
    switch ($_SESSION['usuario']['id_rol']) {
        case '1':
            header("Location: dashboardadmin.php");
            exit();
        case '2':
            header("Location: ../roles/dashboardjefe.php");
            exit();
        case '3':
            header("Location: ../vista/index.php");
            exit();
        default:
            echo "Rol no definido<a href='../vista/login.php'>Ingresar Nuevamente</a>";
            exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include dirname(__DIR__) . '/vista/layout/head.php'; ?>

<body>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="../vista/index.php" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">INDUSTRIA</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">ALCOBAS</span>
                <span class="h1 text-uppercase text-primary bg-dark px-2">2JACK</span>
            </a>
        </div>
    </div>
    <div class="container login-container d-flex align-items-center justify-content-center mt-5">
        <div class="login-box">
            <h4 class="text-center mb-4">Cambiar contraseña</h4>
            <div class="alert alert-info text-dark"><?php echo $txt; ?></div>
            <form action="../controlador/recuperar.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Recuperar</button>
                <div class="text-center mt-3">
                    <a href="login.php">Iniciar sesión</a>
                    <a href="registro.php">¿No tienes una cuenta? Regístrate aquí!</a>
                </div>
            </form>
        </div>
    </div>

    <?php include dirname(__DIR__) . '/vista/layout/footer.php'; ?>
</body>
<?php include dirname(__DIR__) . '/vista/layout/script.php'; ?>

</html>