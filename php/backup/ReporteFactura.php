<?php
include '../jack2/config/config.php';
include '../jack2/Controlador/conexion.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../Inicio_sesion.php");
    exit();
}

$factura_id = isset($_GET['factura_id']) ? intval($_GET['factura_id']) : 0;

$sql = "SELECT * FROM detalle_factura WHERE factura_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $factura_id);
$stmt->execute();
$resultado = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Factura #<?= $factura_id ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            max-height: 80px;
        }

        .factura-header {
            border-bottom: 2px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .factura-footer {
            border-top: 2px solid #ccc;
            padding-top: 10px;
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }

        .total-row td {
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- Encabezado -->
        <div class="row factura-header align-items-center">
            <div class="col-md-2">
                <img src="<?php echo IMG_PATH; ?>Favicon.jpg" alt="Logo" class="logo"> <!-- logo empresa 2JACK-->
            </div>
            <div class="col-md-10 text-end">
                <h4>2JACK S.A.S</h4>
                <p>NIT: 900000000-1<br>
                    Dirección: Calle Ficticia #123, Bogotá, Colombia<br>
                    Tel: (+57) 603520236 | Email: contacto@2jack.com</p>
            </div>
        </div>

        <!-- Título -->
        <h4 class="text-center mb-4">Factura #<?= $factura_id ?></h4>

        <!-- Tabla de productos -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) {
                    $subtotal = $row['Subtotal'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $row['nombre_p'] ?></td>
                        <td><?= $row['desc_p'] ?></td>
                        <td><?= $row['cantidad'] ?></td>
                        <td>$<?= number_format($row['Precio'], 0, ',', '.') ?></td>
                        <td>$<?= number_format($subtotal, 0, ',', '.') ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="table-light total-row">
                    <td colspan="4" class="text-end">Total:</td>
                    <td>$<?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="text-end mb-4">
            <button class="btn btn-primary" onclick="window.print()">
                🖨️ Imprimir factura
            </button>
        </div>

        <!-- Pie de página -->
        <div class="factura-footer">
            Gracias por su compra. Esta factura fue generada automáticamente.<br>
            Si tiene preguntas, contáctenos en <strong>contacto@2jack.com</strong>
        </div>
    </div>
</body>

</html>