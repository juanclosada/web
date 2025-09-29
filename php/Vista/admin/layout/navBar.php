<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">INDUSTRIA</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">ALCOBAS</span>
                    <span class="h1 text-uppercase text-dark bg-light px-2">2JACK</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="dashboardadmin.php" class="nav-item nav-link <?php echo $home; ?>">Inicio</a>
                        <a href="productos.php" class="nav-item nav-link <?php echo $produc; ?>">Productos</a>
                        <a href="usuarios.php" class="nav-item nav-link <?php echo $user; ?>">Usuarios</a>
                        <a href="facturas.php" class="nav-item nav-link <?php
                                                                        echo $fac;
                                                                        ?>">Facturas</a>
                        <a href="comentarios.php" class="nav-item nav-link <?php echo $com; ?>">Comentarios</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->