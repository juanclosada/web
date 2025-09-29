<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('../../controlador/conexion.php');
session_start();
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
$factura_id = base64_decode($_GET['factura_id']);
$db = new Conexion('N');
$factura = $db->consultarRegistro('SELECT * FROM factura WHERE id = :id', ['id' => $factura_id]);
if (empty($factura)) {
    echo "Factura no encontrada.";
    exit();
}
$productos = $db->consultarRegistros2('SELECT d.*, p.nombre, p.descripcion FROM detalle_factura d  JOIN productos p ON d.producto_id   = p.id_producto WHERE factura_id = :factura_id', ['factura_id' => $factura_id]);
//mostrar($productos);
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
    <?php
    include dirname(__DIR__) . '/admin/layout/head.php'; ?>
</head>

<body>
    <div class="container mt-4">
        <!-- Encabezado -->
        <div class="row factura-header align-items-center">
            <div class="col-md-2">
                <img src="../favicon.jpg" alt="Logo" class="logo"> <!-- logo empresa 2JACK-->
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
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>NombreP</th>
                        <th>Descripción</th>
                        <th class="text-center">Cantidad</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $prod): ?>
                        <tr>
                            <td><?= htmlspecialchars($prod['nombre']) ?></td>
                            <td><?= htmlspecialchars($prod['descripcion']) ?></td>
                            <td class="text-center"><?= $prod['cantidad'] ?></td>
                            <td>$<?= number_format($prod['Subtotal'], 2) ?></td>
                            <td>$<?= number_format($prod['Precio'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-light total-row">
                        <td colspan="4" class="text-end">Total:</td>
                        <td>$<?= number_format($factura['total'], 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-end mb-4">
            <button class="btn btn-primary" onclick="window.print()">
                🖨️ Imprimir factura
            </button>
            <a href="facturas.php" class="btn btn-secondary">
                Volver
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