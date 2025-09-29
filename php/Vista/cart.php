<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['usuario']['id'])) {
    header("Location: login.php?error=1");
    exit();
}
include dirname(__DIR__) . '/vista/layout/head.php';
//
include_once '../controlador/conexion.php';
$sql = "SELECT c.*, p.*
    FROM carrito c 
    JOIN productos p ON c.producto_id   = p.id_producto 
    WHERE c.usuario_id =:id AND c.estado = 1";
$db = new Conexion();
$carrito = $db->consultarRegistros2($sql, ['id' =>  $_SESSION['usuario']['id']]);
// mostrar($carrito);
$total = $articulos = 0;
if (!empty($carrito)) {
    foreach ($carrito as $car) {
        $articulos = $articulos + $car['cantidad'];
        $total = $total + ($car['Precio'] * $car['cantidad']);
    }
    $_SESSION['car'] = count($carrito);
} else {
    $_SESSION['car'] = 0;
}
// mostrar($carrito);
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    $body = 5;
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>


    <!-- Breadcrumb Start -->
    <!-- <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Inicio</a>
                    <a class="breadcrumb-item text-dark" href="#">Tienda</a>
                    <span class="breadcrumb-item active">Carrito de Compras</span>
                </nav>
            </div>
        </div>
    </div> -->
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">

                <?php
                if (!empty($carrito)) { ?>
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sec</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php
                            foreach ($carrito as $key => $value) { ?>
                                <tr>
                                    <td class="align-middle"><?php echo $key + 1; ?></td>
                                    <td class="align-middle"><img src="<?php echo $value['imagen'] ?>" alt="" style="width: 50px;"> <?php echo $value['nombre'] ?> </td>
                                    <td class="align-middle">$<?php echo number_format($value['precio']); ?></td>
                                    <td class="align-middle">
                                        <form action="../modelo/agregar_carrito.php" method="post">
                                            <input type="hidden" name="producto_id" value="<?= $value['id_producto'] ?>">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button typye="submit" class="btn btn-sm btn-primary btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="cantidad" value="<?php echo $value['cantidad']; ?>">
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-sm btn-primary btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="align-middle">$<?php echo number_format($value['precio'] * $value['cantidad']); ?></td>
                                    <td class="align-middle">
                                        <form action='../modelo/eliminar_carrito.php' method='post' class='m-0'>
                                            <input type='hidden' name='carrito_id' value="<?php echo $value['id']; ?>">
                                            <button type='submit' class='btn btn-danger btn-sm'>🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="shop.php" class="btn btn-block btn-primary font-weight-bold mt-2">Seguir comprando</a>
                <?php
                } else {
                    echo "<h5>Sin productos seleccionados.</h5>";
                    echo "<a href='shop.php' class='btn btn-warning'>Comprar productos</a>";
                }
                ?>

            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <!-- <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Aplicar Cupon de Descuento</button>
                        </div>
                    </div> -->
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">🛒 Tu carrito</span></h5>
                <div class="bg-light p-30 mb-5">

                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Articulos</h6>
                            <h6 class="font-weight-medium"><?php echo $articulos; ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$<?php echo number_format($total); ?></h5>
                        </div>
                        <form action="../vista/checkout.php" method="post">
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 <?php echo ($total > 0 ? '' : 'disabled'); ?>">Proceso de Compras</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    ?>
</body>
<script>
    function modificarCantidad(button, cambio) {
        const input = button.closest('.input-group').querySelector('input[name="cantidad"]');
        let cantidad = parseInt(input.value) || 0;
        cantidad += cambio;
        if (cantidad < 1) cantidad = 1;
        input.value = cantidad;
    }
</script>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

</html>