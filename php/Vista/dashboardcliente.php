<?php
session_start();
// include  ENCABEZADO;
include_once '../controlador/conexion.php';
$sql = "SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id   = p.id_producto 
    WHERE c.usuario_id =:id AND c.estado = 1";
$db = new Conexion();
$productos = $db->consultarRegistros2("SELECT * FROM productos");
$carrito = $db->consultarRegistros2($sql, ['id' =>  $_SESSION['usuario']['id']]);
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <title>INDUSTRIA ALCOBAS 2JACK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="favicon..jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../vista/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../vista/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../vista/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>
    <div class="container mt-4">
        <div class="row">
            <!-- Productos -->
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($productos as $key => $row) { ?>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <img src="<?= $row['imagen'] ?>" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nombre'] ?></h5>
                                    <p><?= $row['descripcion'] ?></p>
                                    <p><strong>$<?= $row['precio'] ?></strong></p>
                                    <form action="../modelo/agregar_carrito.php" method="post">
                                        <input type="hidden" name="producto_id" value="<?= $row['id_producto'] ?>">
                                        <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>

            <!-- Carrito -->
            <div class="col-md-4">
                <h3>🛒 Tu carrito</h3>
                <?php
                $total = 0;
                if (!empty($carrito)) {
                    echo "<ul class='list-group mb-3'>";
                    foreach ($carrito as $key => $item) {
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                        echo "<div>";
                        echo $item['nombre'] . " x " . $item['cantidad'];
                        echo "</div>";
                        echo "<div class='d-flex align-items-center'>";
                        echo "<span class='me-3'>$" . number_format($subtotal, 2) . "</span>";
                        echo "<form action='../modelo/eliminar_carrito.php' method='post' class='m-0'>";
                        echo "<input type='hidden' name='carrito_id' value='" . $item['id'] . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>🗑️</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "<p><strong>Total: $" . number_format($total, 2) . "</strong></p>";
                    echo "<a href='../vista/checkout.php' class='btn btn-success'>Pagar</a>";
                    echo "<form action='../modelo/vaciar_carrito.php' method='post' class='mt-2'>";
                    echo "<button type='submit' class='btn btn-warning'>Vaciar carrito 🗑️</button>";
                    echo "</form>";
                } else {
                    echo "<p>Tu carrito está vacío.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card mb-4">Gracias por su compra</div>
        <div class="row">

            <?php while ($row = $resultado->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $row['imagen'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nombre'] ?></h5>
                            <p><?= $row['descripcion'] ?></p>
                            <p><strong>$<?= $row['precio'] ?></strong></p>
                            <form action="../Clientes/agregar_carrito.php" method="post">
                                <input type="hidden" name="producto_id" value="<?= $row['id_producto'] ?>">
                                <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>


</body>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script src="../vista/lib/easing/easing.min.js"></script>
<script src="../vista/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="../vista/mail/jqBootstrapValidation.min.js"></script>
<script src="../vista/mail/contact.js"></script>

<!-- Template Javascript -->
<script src="../vista/js/main.js"></script>

</html>