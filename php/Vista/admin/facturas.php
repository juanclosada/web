<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('America/Bogota');
include dirname(__DIR__) . '/admin/layout/head.php';
include_once('../../controlador/conexion.php');

$fac = 'active';
$home = $user = $com = $produc = '';
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
$db = new Conexion('N');
$facturas = $db->consultarRegistros2('SELECT f.*, e.estado_envio FROM factura f LEFT JOIN envios e ON e.id_factura = f.id WHERE 1=1 ORDER BY id DESC');
// mostrar($facturas);
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include dirname(__DIR__) . '/admin/layout/topBar.php';
    include dirname(__DIR__) . '/admin/layout/navBar.php';
    ?>
    <!-- start section -->
    <div class="container">
        <h4>Facturas</h4>
        <p><?php
            //echo $formatter->format(new DateTime()) 
            ?></p>
        <div class="table-responsive mt-3">
            <?php
            if (!empty($facturas)) { ?>
                <table id="facturas" class="table table-light table-borderless table-hover text-center mb-0 ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sec</th>
                            <th>Fecha</th>
                            <th>Forma de pago</th>
                            <th class="text-center">Descuento</th>
                            <th>IVA</th>
                            <th>Total</th>
                            <th>Factura</th>
                            <th>Detalle de envío</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        foreach ($facturas as $key => $fac) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $key + 1; ?></td>
                                <td class="align-middle"><?php echo $fac['fecha']; ?></td>
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
                        <?php } ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<h5>Sin comentarios seleccionados.</h5>";
                echo "<a href='shop.php' class='btn btn-warning'>Comprar productos</a>";
            }
            ?>
        </div>
    </div>
</body>

<?php
include dirname(__DIR__) . '/admin/layout/footer.php';
?>

</html>
<?php
include dirname(__DIR__) . '/admin/layout/script.php';
?>
<script>
    $('#facturas').DataTable({
        language: {
            url: './language.json'
        },
        dom: 'Bfrtip', // Dom layout para que aparezcan los botones
        buttons: [{
                extend: 'excelHtml5',
                title: 'Reporte_Usuarios'
            },
            {
                extend: 'pdfHtml5',
                title: 'Reporte_Usuarios',
                orientation: 'landscape',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                title: 'Reporte de Usuarios'
            }
        ]
    });
</script>