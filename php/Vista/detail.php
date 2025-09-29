<?php
// TODO EL CÓDIGO PHP DEBE IR PRIMERO - ANTES DE CUALQUIER HTML
include_once '../controlador/conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['usuario']['id'])) {
    header("Location: login.php?error=1");
    exit();
}

$db = new Conexion();
$id = empty($_GET['id']) ? '' : base64_decode($_GET['id']);
$producto = $db->consultarRegistro("SELECT * FROM productos WHERE id_producto = '$id'");
?>
<!DOCTYPE html>
<html lang="en">
<?php include dirname(__DIR__) . '/vista/layout/head.php'; ?>

<body>
    <?php
    $body = 3;
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <?php if (empty($producto)) {
                echo "<h4>No se encontró el producto.<h4/>";
            } else { ?>
                <div class="col-lg-5 mb-30">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner bg-light">
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="<?php echo $producto['imagen'] ?>" style="max-height:600px" alt="Image">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $producto['nombre'] ?></h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(<?php echo rand(10, 99); ?> Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">$<?php echo number_format($producto['precio']); ?></h3>

                    <form action="../modelo/agregar_carrito.php" method="post">
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <input type="number" name="cantidad" class="form-control bg-secondary border-0 text-center" value="1" min="1" required>
                                <input type="hidden" name="producto_id" value="<?= $producto['id_producto'] ?>">
                            </div>
                            <?php
                            if (empty($_SESSION['usuario']['id'])) {
                                echo '<a href="login.php" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Agregar al carrito de Compras</a>';
                            } else {
                                echo '<button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Agregar al carrito de Compras</button>';
                            }
                            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Descripción del Producto</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Información</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Descripción del Producto</h4>
                        <p><?php echo $producto['descripcion'] ?></p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Información Adicional</h4>
                        <p>¿Cuáles son los tipos de muebles? Existe una gran variedad de tipos de muebles para cada ambiente de tu hogar. Entre estos se encuentran: muebles de dormitorio, muebles de oficina y escritorio, muebles de sala y comedor, muebles de cocina, muebles para baño, muebles de terraza, entre otros.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        1. Clasificación de muebles por Funcionalidad:
                                    </li>
                                    <li class="list-group-item px-0">
                                        3. Muebles de Dormitorio: Camas, Mesitas, Cómodas.
                                    </li>
                                    <li class="list-group-item px-0">
                                        5. Muebles de Oficina: Escritorios, Sillas ergonómicas, Archivadores.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        2. Muebles de Sala: Sofás, sillones, Mesas de centro.
                                    </li>
                                    <li class="list-group-item px-0">
                                        4. Muebles de Cocina y Comedor: Mesas, sillas.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include dirname(__DIR__) . '/vista/layout/footer.php'; ?>
</body>
<?php include dirname(__DIR__) . '/vista/layout/script.php'; ?>

</html>