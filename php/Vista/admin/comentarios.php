<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('America/Bogota');
include dirname(__DIR__) . '/admin/layout/head.php';
include_once('../../controlador/conexion.php');

$com = 'active';
$home = $user = $fac = $produc = '';
if (empty($_SESSION['usuario']['id_rol']) || $_SESSION['usuario']['id_rol'] != 1) {
    header("location: ../../vista/login.php");
}
$db = new Conexion('N');
$comentarios = $db->consultarRegistros2('SELECT * FROM contactos WHERE 1=1 ORDER BY id DESC');
// mostrar($comentarios);
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
        <h4>Productos</h4>
        <p><?php
            //echo $formatter->format(new DateTime()) 
            ?></p>
        <div class="table-responsive mt-3">
            <?php
            if (!empty($comentarios)) { ?>
                <table id="comentarios" class="table table-light table-borderless table-hover text-center mb-0 ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sec</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Asunto</th>
                            <th>Mensaje</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        foreach ($comentarios as $key => $value) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $key + 1; ?></td>
                                <td class="align-middle"><?php echo $value['nombre']; ?></td>
                                <td class="align-middle"><?php echo $value['correo']; ?></td>
                                <td class="align-middle"><?php echo $value['asunto']; ?></td>
                                <td class="align-middle"><?php echo $value['mensaje']; ?></td>
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
    <!-- end section -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="../../modelo/agregarProducto.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre del producto</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3" placeholder="Describe el producto" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Ej: 199.99" step="0.01" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock disponible</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Ej: 10" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="imagen">URL de la imagen</label>
                            <input type="file" name="imagen" class="form-control-file" accept="image/*" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="../../modelo/actualizarProducto.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="edit-nombre" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-control" name="descripcion" id="edit-descripcion" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" class="form-control" name="precio" id="edit-precio" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" name="stock" id="edit-stock" required>
                        </div>

                        <div class="form-group">
                            <label>Imagen (opcional)</label>
                            <input type="file" class="form-control-file" name="imagen" accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
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
    function cargarDatosEditar(btn) {
        document.getElementById("edit-id").value = btn.dataset.id;
        document.getElementById("edit-nombre").value = btn.dataset.nombre;
        document.getElementById("edit-descripcion").value = btn.dataset.descripcion;
        document.getElementById("edit-precio").value = btn.dataset.precio;
        document.getElementById("edit-stock").value = btn.dataset.stock;
    }
    $('#comentarios').DataTable({
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