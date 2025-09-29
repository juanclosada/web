<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['usuario']['id'])) {
    header("Location: login.php?error=1");
    exit();
}
include_once dirname(__DIR__) . '/vista/layout/head.php';
$body = 6;
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include_once '../controlador/conexion.php';
    $db = new Conexion();
    $facturas = [];
    if (!empty($_SESSION['usuario']['id'])) {
        $facturas = $db->consultarRegistros2('SELECT f.*, e.estado_envio FROM factura f LEFT JOIN envios e ON f.id = e.id_factura WHERE f.estado = 2 AND f.usuario_id  = :id', ['id' => $_SESSION['usuario']['id']]);
    } else {
        if (empty($_SESSION['usuario']['id'])) {
            header("Location: login.php?error=1");
            exit();
        }
    }
    // mostrar($facturas);
    ?>

    <body>

        <?php
        include_once dirname(__DIR__) . '/vista/layout/topBar.php';
        include_once dirname(__DIR__) . '/vista/layout/navBar.php'; ?>



        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <?php if (empty($facturas)) { ?>
                    <h5 class='text-center'>No hay compras registradas</h5>

                <?php
                } else { ?>
                    <h2>Detalle de compras</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-dark">
                            <thead class="table-success">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Forma de pago</th>
                                    <th class="text-center">Descuento</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                    <th>Factura</th>
                                    <th>Detalle de envío</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturas as $fac): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($fac['fecha_pago']) ?></td>
                                        <td><?= formaPago($fac['forma_pago']) ?></td>
                                        <td>$<?= number_format($fac['descuento'], 2) ?></td>
                                        <td>$<?= number_format($fac['IVA'], 2) ?></td>
                                        <td>$<?= number_format($fac['total'], 2) ?></td>
                                        <td>
                                            <a href="ReporteFactura.php?factura_id=<?php echo base64_encode($fac['id']); ?>" type='submit' class='btn btn-warning btn-sm'><i class="fas fa-file-pdf"></i> Ver factura</a>

                                        </td>
                                        <td>
                                            <?php
                                            switch ((int)($fac['estado_envio'] ?? 0)) {
                                                case 1:
                                                    echo 'Pendiente <a href="verEnvio.php?factura_id=' . base64_encode($fac['id']) . '" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-truck"></i> Ver envío</a>';
                                                    break;
                                                case 2:
                                                    echo 'Entregado ' . '<a href="verEnvio.php?factura_id=' . base64_encode($fac['id']) . '" type="submit" class="btn btn-success btn-sm"><i class="fas fa-truck"></i> Ver envío</a>';;
                                                    break;
                                                default:
                                                    echo 'Sin envio';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        <?php  } ?>

        </div>
        <!-- Shop End -->


        <?php
        include 'layout/footer.php';
        ?>
    </body>
    <?php
    include 'layout/script.php';
    ?>

</html>