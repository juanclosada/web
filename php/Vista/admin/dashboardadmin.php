<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('America/Bogota');
include dirname(__DIR__) . '/admin/layout/head.php';
include_once('../../controlador/conexion.php');
// if (!class_exists('IntlDateFormatter')) {
// $formatter = new IntlDateFormatter(
//     'es_CO', // idioma local
//     IntlDateFormatter::FULL, // fecha completa (ej: miércoles, 30 de julio de 2025)
//     IntlDateFormatter::SHORT, // hora corta (ej: 9:38 p. m.)
//     'America/Bogota',
//     IntlDateFormatter::GREGORIAN
// );
$home = 'active';
$produc = $user = $fac = $com = '';
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
$db = new Conexion('N');
$usuarios = $db->contarRegistros('usuarios');
$productos = $db->contarRegistros('productos');
$facturas = $db->contarRegistros('factura');
$comentarios = $db->contarRegistros('contactos');

$maxV = $db->consultarRegistros2('SELECT p.id_producto, p.nombre, SUM(df.cantidad) AS total_vendido FROM detalle_factura df JOIN productos p ON df.producto_id = p.id_producto GROUP BY p.id_producto, p.nombre ORDER BY total_vendido DESC LIMIT 10');
$maxU = $db->consultarRegistros2('SELECT u.id_usuario, u.nombre, SUM(df.cantidad) AS total_comprado FROM detalle_factura df JOIN factura f ON df.factura_id = f.id JOIN usuarios u ON f.usuario_id = u.id_usuario GROUP BY u.id_usuario ORDER BY total_comprado DESC LIMIT 10');
foreach ($maxV as $key) {
    $labels[] = $key['nombre'];
    $data[] = $key['total_vendido'];
}
foreach ($maxU as $key) {
    $labels_json[] = $key['nombre'];
    $data_json[] = $key['total_comprado'];
}
$labels_json = json_encode($labels_json);
$data_json = json_encode($data_json);
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
        <h4>Bienvenido <?php echo $_SESSION['usuario']['nombre']; ?></h4>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Resumen
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Usuarios registrados</th>
                                        <td><?php echo $usuarios; ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Productos en inventario</th>
                                        <td><?php echo $productos; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Facturación del mes</th>
                                        <td><?php echo $facturas; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Comentarios de clientes</th>
                                        <td><?php echo $comentarios; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Mejores productos
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0 btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Usuarios favoritos
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div width="80%">
                            <canvas id="usuariosChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end section -->

</body>


<?php
include dirname(__DIR__) . '/admin/layout/footer.php';
?>

<?php
include dirname(__DIR__) . '/admin/layout/script.php';
?>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: '# de Compras',
                data: <?php echo json_encode($data); ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ct = document.getElementById('usuariosChart').getContext('2d');
    const usuariosPieChart = new Chart(ct, {
        type: 'pie',
        data: {
            labels: <?php echo $labels_json; ?>,
            datasets: [{
                label: 'Productos Comprados',
                data: <?php echo $data_json; ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(199, 199, 199, 0.6)',
                    'rgba(83, 102, 255, 0.6)',
                    'rgba(255, 99, 255, 0.6)',
                    'rgba(99, 255, 132, 0.6)'
                ],
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Top 10 Usuarios que Más Compran'
                },
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

</html>