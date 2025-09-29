<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include dirname(__DIR__) . '/vista/layout/head.php';
$error = '';
if (!empty($_GET['error'])) {
    switch ($_GET['error']) {
        case '1':
            $error = '<span class="text-dark mb-2 pb-2">Por favor inicia sesión para poder continuar con tu compra:</span>';
            break;
        case '3':
            $error = '<span class="text-dark mb-2 pb-2">La nueva clave de acceso fue enviado a su correo electrónico.</span>';
            break;
        default:
            $error = '';
            break;
    }
}
if (!empty($_SESSION['usuario'])) {
    switch ($_SESSION['usuario']['id_rol']) {
        case '1':
            header("location: ../vista/admin/dashboardadmin.php");
            break;
        case '2':
            header("location: ../roles/dashboardjefe.php");
            break;
        case '3':
            header("location: ../vista/index.php");
            break;
        default:
            echo "Rol no definido<a href='../vista/login.php'>Ingresar Nuevamente</a>";
            break;
    }
}
?>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

<!DOCTYPE html>
<html lang="en">

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
            <h4 class="text-center mb-4">Iniciar Sesión</h4>
            <?php if ($error != '') {
                echo '<div class="alert alert-dark">' . $error . '</div>';
            }
            ?>
            <form action="../controlador/validar_login.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-warning" type="button" onclick="togglePassword()">
                                <i class="fas fa-eye" id="icono-ojo"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                <div class="text-center mt-3">
                    <a href="recordarPass.php">¿Olvidó su contraseña?</a>
                    <a href="registro.php">¿No tienes una cuenta? Regístrate aquí!</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    ?>
</body>

<script>
    function togglePassword() {
        const input = document.getElementById("contrasena");
        const icono = document.getElementById("icono-ojo");

        if (input.type === "password") {
            input.type = "text";
            icono.classList.remove("fa-eye");
            icono.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icono.classList.remove("fa-eye-slash");
            icono.classList.add("fa-eye");
        }
    }
</script>

</html>