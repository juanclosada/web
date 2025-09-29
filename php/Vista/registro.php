<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include dirname(__DIR__) . '/vista/layout/head.php';
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
    <div class="container">
        <form action="../controlador/controlador_registro_usuario.php" method="POST" class="form-register">
            <h4>Formulario de Registro</h4>

            <div class="form-group d-none">
                <label for="rol">Rol</label>
                <select class="custom-select" name="rol" id="rol" required>
                    <option value="3" selected>Cliente</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombres</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese sus nombres" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellidos</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese sus apellidos" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo" required>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required>
            </div>

            <div class="form-group">
                <label for="contrasena1">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="contrasena1" id="contrasena1" placeholder="Confirme su contraseña" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terminos" required>
                <label class="form-check-label" for="terminos">
                    Estoy de acuerdo con los <a href="#">Términos y Condiciones</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Registrar</button>

            <p class="text-center mt-3">
                <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
            </p>
        </form>
    </div>
    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    ?>
</body>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

</html>