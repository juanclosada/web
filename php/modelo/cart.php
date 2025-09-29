<?php
// 1. PRIMERO: Toda la lógica PHP al inicio
include 'controlador/conexion.php';
// Aquí ya debería haber session_start() desde conexion.php

// 2. Verificar sesión (si es necesario)
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// 3. Consultas a la base de datos
$resultado = $conn->query("SELECT * FROM productos");
$carrito = $conn->query(
    "SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id = p.id_producto 
    WHERE c.usuario_id = " . $_SESSION['usuario']['id']
);

// 4. DESPUÉS: Todo el HTML
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <!-- Incluir Bootstrap si es necesario -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include '/vista/Encabezado.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <!-- Productos -->
            <div class="col-md-8">
                <div class="row">
                    <?php
                    // Reiniciar el cursor del resultado
                    $resultado->data_seek(0);
                    while ($row = $resultado->fetch_assoc()) { ?>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <img src="<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nombre']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                                    <p><?= htmlspecialchars($row['descripcion']) ?></p>
                                    <p><strong>$<?= number_format($row['precio'], 2) ?></strong></p>
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
                        echo htmlspecialchars($item['nombre']) . " x " . $item['cantidad'];
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
        <div class="card mb-4">
            <div class="card-body">
                <h5>Gracias por su compra</h5>
            </div>
        </div>
        <div class="row">
            <?php
            // Reiniciar cursor para mostrar productos nuevamente
            $resultado->data_seek(0);
            while ($row = $resultado->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nombre']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                            <p><?= htmlspecialchars($row['descripcion']) ?></p>
                            <p><strong>$<?= number_format($row['precio'], 2) ?></strong></p>
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

    <?php include_once PIEPAGINA; ?>

</body>

</html>