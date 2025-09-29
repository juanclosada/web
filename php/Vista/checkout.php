<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PRIMERO: Validar la sesión ANTES de incluir cualquier archivo HTML
if (empty($_SESSION['usuario']['id'])) {
    header("Location: login.php");
    exit();
}

// SEGUNDO: Incluir archivos de conexión
include_once '../controlador/conexion.php';

// TERCERO: Procesar toda la lógica de negocio
$db = new Conexion();
$db->eliminarRegistro('factura', ['usuario_id' => $_SESSION['usuario']['id'], 'estado' => 1]);
$sql = "SELECT c.*, p.nombre, p.precio 
FROM carrito c 
JOIN productos p ON c.producto_id = p.id_producto 
WHERE c.usuario_id = :id AND c.estado = 1";
$carrito = $db->consultarRegistros2($sql, ['id' => $_SESSION['usuario']['id']]);
$total = 0;
$productos = [];

if (!empty($carrito)) {
    foreach ($carrito as $key => $item) {
        $item['total'] = $item['precio'] * $item['cantidad'];
        $item['subtotal'] = $item['precio'];
        $total += $item['total'];
        $productos[] = $item;
    }
}

$datos = [
    'usuario_id' => $_SESSION['usuario']['id'],
    'fecha' => date('Y-m-d H:i:s'),
    'descuento' => 0,
    'IVA' => 0,
    'total' => $total,
    'estado' => 1
];
$db->insertarRegistro('factura', $datos);
$id = $db->lastInsertId();

foreach ($productos as $key => $value) {
    $db->actualizarRegistro('carrito', [
        'factura_id' => $id
    ], ['id' => $value['id']]);
}

// Guardar detalles de la factura
foreach ($productos as $key => $value) {
    $db->insertarRegistro('detalle_factura', [
        'usuario_id' => $_SESSION['usuario']['id'],
        'producto_id' => $value['producto_id'],
        'factura_id' => $id,
        'cantidad' => $value['cantidad'],
        'Precio' => $value['total'],
        'Subtotal' => $value['subtotal']
    ]);
}

// CUARTO: Incluir archivos HTML solo después de procesar todo
include_once dirname(__DIR__) . '/vista/layout/head.php';
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    $body = '3';
    include_once dirname(__DIR__) . '/vista/layout/topBar.php';
    include_once dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">🧾 Resumen de pago</h4>
            </div>
            <div class="card-body">
                <?php if (count($productos) > 0): ?>
                    <table class="table table-bordered table-striped text-dark">
                        <thead class="table-success">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $prod): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                                    <td>$<?= number_format($prod['precio'], 2) ?></td>
                                    <td><?= $prod['cantidad'] ?></td>
                                    <td>$<?= number_format($prod['total'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-secondary">
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>$<?= number_format($total, 2) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="container mt-5">
                        <div class="card mx-auto" style="max-width: 500px;">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">Proceso de pago y envio</h4>
                            </div>
                            <div class="card-body">
                                <form action="../modelo/procesar_pago.php" method="POST" autocomplete="on">
                                    <div class="mb-3">
                                        <label for="envio" class="form-label">Dirección de envío</label>
                                        <input type="text" class="form-control" id="envio" name="envio" required placeholder="Dirección de residencia">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ciudad" class="form-label">Ciudad</label>
                                        <select class="form-control" id="ciudad" name="ciudad" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="Bogotá">Bogotá</option>
                                            <option value="Tunja">Tunja</option>
                                            <option value="Medellín">Medellín</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celular" name="celular" required placeholder="Número de celular">
                                    </div>
                                    <div class="mb-3">
                                        <label for="metodo" class="form-label">Método de pago</label>
                                        <select class="form-control" id="metodo" name="metodo" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Tarjeta de Crédito</option>
                                            <option value="2">Tarjeta Débito</option>
                                            <option value="3">Nequi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre en la tarjeta</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="numero" class="form-label">Número de tarjeta / Nequi</label>
                                        <input type="text" class="form-control" id="numero" name="numero" placeholder="Número de tarjeta o Nequi" required>
                                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="expira" class="form-label">Fecha de expiración</label>
                                            <input type="text" class="form-control" id="expira" name="expira" placeholder="MM/AA">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Pagar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="shop.php" class="btn btn-primary">🛍️ Seguir comprando</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Tu carrito está vacío. <a href="cart.php" class="alert-link">Ver productos</a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    include dirname(__DIR__) . '/vista/layout/script.php';
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const metodo = document.getElementById('metodo');
            const nombreTarjeta = document.getElementById('nombre') ? document.getElementById('nombre').closest('.mb-3') : null;
            const inputNombre = document.getElementById('nombre');
            const numeroTarjeta = document.getElementById('numero') ? document.getElementById('numero').closest('.mb-3') : null;
            const inputNumero = document.getElementById('numero');
            const expira = document.getElementById('expira') ? document.getElementById('expira').closest('.mb-3') : null;
            const inputExpira = document.getElementById('expira');
            const cvv = document.getElementById('cvv') ? document.getElementById('cvv').closest('.mb-3') : null;
            const inputCvv = document.getElementById('cvv');
            const form = document.querySelector('form[action="../modelo/procesar_pago.php"]');

            function actualizarCampos() {
                if (!nombreTarjeta || !numeroTarjeta || !expira || !cvv) return;

                if (metodo.value === '3') { // Nequi
                    nombreTarjeta.style.display = 'none';
                    expira.style.display = 'none';
                    cvv.style.display = 'none';
                    numeroTarjeta.querySelector('label').textContent = 'Número de celular Nequi';
                    inputNumero.placeholder = 'Número de celular Nequi';

                    inputNombre.required = false;
                    inputExpira.required = false;
                    inputCvv.required = false;
                } else if (metodo.value === '1' || metodo.value === '2') { // Tarjetas
                    nombreTarjeta.style.display = '';
                    expira.style.display = '';
                    cvv.style.display = '';
                    numeroTarjeta.querySelector('label').textContent = 'Número de tarjeta';
                    inputNumero.placeholder = 'Número de tarjeta';

                    inputNombre.required = true;
                    inputExpira.required = true;
                    inputCvv.required = true;
                } else {
                    nombreTarjeta.style.display = '';
                    expira.style.display = '';
                    cvv.style.display = '';
                    numeroTarjeta.querySelector('label').textContent = 'Número de tarjeta / Nequi';
                    inputNumero.placeholder = 'Número de tarjeta o Nequi';

                    inputNombre.required = true;
                    inputExpira.required = true;
                    inputCvv.required = true;
                }
            }

            if (metodo) {
                metodo.addEventListener('change', actualizarCampos);
                actualizarCampos();
            }

            if (form) {
                form.addEventListener('submit', function(e) {
                    if (metodo && metodo.value === '3') {
                        const otp = prompt('Ingrese el código OTP enviado a su celular Nequi:');
                        if (!otp) {
                            alert('Debe ingresar el código OTP para continuar.');
                            e.preventDefault();
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>