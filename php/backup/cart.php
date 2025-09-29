<!DOCTYPE html>
<html lang="en">


<?php
include 'Controlador/conexion.php';
// include 'conexion.php';
$resultado = $conn->query("SELECT * FROM productos");
include '/jack2/Vista/Encabezado.php'; // contiene el navbar
    $carrito = $conn->query(" SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id   = p.id_producto 
    WHERE c.usuario_id = " . $_SESSION['usuario']['id']
);
?>


<div class="container mt-4">
    <div class="row">
        <!-- Productos -->
        <div class="col-md-8">
            <div class="row">
                <?php while($row = $resultado->fetch_assoc()) { ?>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img src="<?= $row['URL.Imagen']?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['nombre'] ?></h5>
                                <p><?= $row['descripcion'] ?></p>
                                <p><strong>$<?= $row['precio'] ?></strong></p>
                                <form action="agregar_carrito.php" method="post">
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
            if ($carrito->num_rows > 0) {
                echo "<ul class='list-group mb-3'>";
                while ($item = $carrito->fetch_assoc()) {
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo $item['nombre'] . " x " . $item['cantidad'];
                    echo "<span>$" . number_format($subtotal, 2) . "</span>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "<p><strong>Total: $" . number_format($total, 2) . "</strong></p>";
                echo "<a href='checkout.php' class='btn btn-success'>Generar factura</a>";
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
                    <img src="<?= $row['URL.Imagen'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nombre'] ?></h5>
                        <p><?= $row['descripcion'] ?></p>
                        <p><strong>$<?= $row['precio'] ?></strong></p>
                        <form action="agregar_carrito.php" method="post">
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



<?php
// include 'conexion.php';
include_once PIEPAGINA; // contiene el navbar
?>