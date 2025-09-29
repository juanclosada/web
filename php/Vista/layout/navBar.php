<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$home = $shop = $detail = $contact = $cart = $compras = '';
switch ($body) {
    case '2':
    case '3':
    case '5':
        $shop = 'active';
        break;
    case '4':
        $contact = 'active';
        break;
    case '6':
        $compras = 'active';
        break;
    default:
        $home = 'active';
        break;
}
// include_once dirname(__DIR__) . '/vista/layout/head.php';
include_once '../controlador/conexion.php';
$db = new Conexion();
$factura = [];
if (!empty($_SESSION['usuario']['id'])) {
    $factura = $db->consultarRegistro('SELECT * FROM factura WHERE usuario_id  = :id', ['id' => $_SESSION['usuario']['id']]);
}
?>
<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <!-- <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorias</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a> -->
            <!-- <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown dropright">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Muebles <i class="fa fa-angle-right float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                            <a href="" class="dropdown-item">Mesas de Noche</a>
                            <a href="" class="dropdown-item">Sillas</a>
                            <a href="" class="dropdown-item">Camacuna</a>
                        </div>
                    </div>
                    <a href="" class="nav-item nav-link">Mesas de Noche</a>
                    <a href="" class="nav-item nav-link">Camacuna</a>
                    <a href="" class="nav-item nav-link">Sofa</a>
                    <a href="" class="nav-item nav-link">Tocador</a>
                    <a href="" class="nav-item nav-link">Sillas</a>
                    <a href="" class="nav-item nav-link">Tendidos</a>
                    <a href="" class="nav-item nav-link">Camas</a>
                    <a href="" class="nav-item nav-link">Puff</a>
                    <a href="" class="nav-item nav-link">Juego de Alcobas</a>
                    <a href="" class="nav-item nav-link">Armarios</a>
                    <a href="" class="nav-item nav-link">Escritorio</a>
                    <a href="" class="nav-item nav-link">Mesa de Centro</a>
                </div>
            </nav> -->
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
                        <a href="index.php" class="nav-item nav-link <?php echo $home; ?>">Inicio</a>
                        <a href="shop.php" class="nav-item nav-link <?php echo $shop; ?>">Nuestros productos</a>
                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">Quienes somos <i class="fa fa-angle-down mt-1"></i></a>
                            <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                <a href="nosotros.php" class="dropdown-item">Sobre nosotros</a>
                                <a href="mision.php" class="dropdown-item">Misión</a>
                                <a href="vision.php" class="dropdown-item">Visión</a>
                            </div>
                        </div>
                        <?php if (!empty($factura)) {
                            echo '<a href="compras.php" class="nav-item nav-link ' . $compras . '">Compras</a>';
                        } ?>
                        <a href="Contact.php" class="nav-item nav-link <?php echo $contact; ?>">Contacto</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <!-- <a href="" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a> -->
                        <?php ?>
                        <a href="cart.php" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $_SESSION['car'] ?? 0; ?></span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->