<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
include dirname(__DIR__) . '/admin/layout/head.php';
include_once('../../controlador/conexion.php');
$body = 6;
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    $fac = 'active';
    $home = $user = $com = $produc = '';
    $factura_id = base64_decode($_GET['factura_id']);
    $db = new Conexion('N');
    $envio = $db->consultarRegistro('SELECT f.*, e.* FROM factura f JOIN envios e ON f.id = e.id_factura WHERE f.estado = 2 AND f.id  = :id', ['id' => $factura_id]);
    if (empty($envio)) {
        echo "Envio no encontrado.";
        exit();
    }
    $productos = $db->consultarRegistros2('SELECT d.*, p.nombre, p.descripcion FROM detalle_factura d  JOIN productos p ON d.producto_id   = p.id_producto WHERE factura_id = :factura_id', ['factura_id' => $factura_id]);
    // mostrar([$envios, $productos]);
    ?>

    <body>

        <?php
        include dirname(__DIR__) . '/admin/layout/topBar.php';
        include dirname(__DIR__) . '/admin/layout/navBar.php'; ?>



        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <h2>Detalle de Envío</h2>
                <table class="table table-bordered text-dark">
                    <tr>
                        <th>ID Envío</th>
                        <td><?= htmlspecialchars($envio['id_envio']) ?></td>
                    </tr>
                    <tr>
                        <th>ID Factura</th>
                        <td><?= htmlspecialchars($envio['id_factura']) ?></td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td><?= htmlspecialchars($envio['direccion_envio']) ?></td>
                    </tr>
                    <tr>
                        <th>Ciudad</th>
                        <td><?= htmlspecialchars($envio['ciudad']) ?></td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td><?= htmlspecialchars($envio['telefono_contacto']) ?></td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                            <?php
                            switch ((int)$envio['estado_envio']) {
                                case 1:
                                    echo 'Pendiente';
                                    break;
                                case 2:
                                    echo 'Enviado';
                                    break;
                                case 3:
                                    echo 'Entregado';
                                    break;
                                default:
                                    echo 'Desconocido';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha Envío</th>
                        <td><?= htmlspecialchars($envio['fecha_envio']) ?></td>
                    </tr>
                    <tr>
                        <th>Fecha Entrega</th>
                        <td><?= htmlspecialchars($envio['fecha_entrega']) ?></td>
                    </tr>
                </table>

                <div class="text-center mt-3">
                    <a href="facturas.php" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
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