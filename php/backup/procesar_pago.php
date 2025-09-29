<?php
session_start();
include '../jack2/config/config.php';
include '../jack2/Controlador/conexion.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../Inicio_sesion.php");
    exit();
}

$usuario_id = $_SESSION['id'];


$subtotal = 0;     // Ejemplo: reemplaza con tus cálculos reales
$descuento = 0;         // Ejemplo
$iva = 0;           // Ejemplo
$total = 0;
$estado = 'Pagada';

$carrito = $conn->query("
        SELECT c.ID, c.usuario_id, c.producto_id, c.cantidad, p.nombre, p.precio,p.descripcion 
        FROM carrito c 
        JOIN productos p ON c.producto_id = p.id_producto
        WHERE c.usuario_id = $usuario_id
    ");

// Calcular el subtotal a partir de los productos del carrito
while ($item = $carrito->fetch_assoc()) {
    $producto_subtotal = $item['precio'] * $item['cantidad'];
    $subtotal += $producto_subtotal;
}

// Calcular IVA (por ejemplo, 19%)
$iva = $subtotal * 0.19;

// Calcular total final
$total = $subtotal - $descuento + $iva;

// Convertir a enteros si la columna es decimal(10,0) como en tu tabla
$subtotal = round($subtotal);
$iva = round($iva);
$total = round($total);



// Preparar consulta
$fact = $conn->prepare("INSERT INTO factura (usuario_id, subtotal, descuento, IVA, total, estado) VALUES (?, ?, ?, ?, ?, ?)");
$fact->bind_param("iiiiis", $usuario_id, $subtotal, $descuento, $iva, $total, $estado);

// Ejecutar
$factura_id = 1;
if ($fact->execute()) {
    echo "Factura creada correctamente con estado PENDIENTE. ID: " . $fact->insert_id;
    $factura_id = $fact->insert_id;
} else {
    echo "Error al crear la factura: " . $fact->error;
}

if ($carrito && $carrito->num_rows > 0) {
    while ($item = $carrito->fetch_assoc()) {
        $producto_id = $item['producto_id'];
        $cantidad = $item['cantidad'];
        $precio = $item['precio'];
        $subtotal = $precio * $cantidad;
        $estado = 1; // Puedes asignar el estado que desees (ej: 1 = pagado)
        $nombre_p = $item['nombre'];
        $desc_p = $item['descripcion'];

        // Insertar en detalle_factura
        $stmt = $conn->prepare("INSERT INTO detalle_factura (usuario_id, producto_id, factura_id, cantidad, Precio, Subtotal, estado,nombre_p,desc_p) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param(
            "iiiidisss",
            $usuario_id,
            $producto_id,
            $factura_id,
            $cantidad,
            $precio,
            $subtotal,
            $estado,
            $nombre_p,
            $desc_p
        );
        $stmt->execute();
    }

    echo "Detalle de factura generado correctamente.";
} else {
    echo "El carrito está vacío.";
}


if ($conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id")) {
    echo "Carrito eliminado correctamente.";
} else {
    echo
    "Error al eliminar el carrito: " . $conn->error;
}



if ($factura_id != 1) {
?>
    <script>
        // Abre en una nueva ventana
        window.open("ReporteFactura.php?factura_id=<?= $factura_id ?>", "_blank");

        // Redirige la ventana actual a otra página, si quieres
        window.location.href = "/jack2/roles/dashboardcliente.php"; // opcional
    </script>
<?php
} else {
    echo "Error al crear la factura.";
}


$conn->close();
