<?php
session_start();
include '../jack2/config/config.php';
include '../jack2/Controlador/conexion.php';

// PRIMERO: Validar la sesión ANTES de cualquier HTML
if (!isset($_SESSION['id'])) {
    header("Location: ../Inicio_sesion.php");
    exit();
}

// Obtener datos del usuario
$usuario_id = $_SESSION['id'];

// Procesar todos los datos ANTES de incluir HTML
$carrito = $conn->query("
    SELECT c.*, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id = p.id_producto
    WHERE c.usuario_id = " . $usuario_id);

$total = 0;
$productos = [];

while ($item = $carrito->fetch_assoc()) {
    $item['subtotal'] = $item['precio'] * $item['cantidad'];
    $total += $item['subtotal'];
    $productos[] = $item;
}

// DESPUÉS: Incluir archivos con HTML (al final)
include '../jack2/Vista/Encabezado.php'; // contiene el navbar
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <!-- Tu contenido HTML aquí -->
    <div class="container">
        <h2>Checkout</h2>
        
        <?php if (empty($productos)): ?>
            <p>No tienes productos en el carrito.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                            <td>$<?php echo number_format($item['precio']); ?></td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td>$<?php echo number_format($item['subtotal']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total:</th>
                        <th>$<?php echo number_format($total); ?></th>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>