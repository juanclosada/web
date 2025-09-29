<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../controlador/conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: vista/login.php");
    die();
}
$db = new Conexion();
$producto = $db->consultarRegistro('SELECT * FROM productos WHERE id_producto = :producto', ['producto' => $_POST['producto_id']]);
if ($producto) {
    if ($producto['stock'] < $_POST['cantidad']) {
        echo "Cantidad solicitada no disponible.";
        die();
    }

    $datos['usuario_id'] = $_SESSION['usuario']['id'];
    $datos['producto_id'] = $_POST['producto_id'];
    $datos['estado'] = 1;
    $datos['cantidad'] = $_POST['cantidad'];
    $datos['Precio'] = $producto['precio'];
    $datos['Subtotal'] = $producto['precio'];
    $sql = "SELECT c.*, c.id AS carritoid, p.nombre, p.precio 
    FROM carrito c 
    JOIN productos p ON c.producto_id   = p.id_producto 
    WHERE c.usuario_id =:id AND c.estado = 1 AND c.producto_id = :producto";
    $existe = $db->consultarRegistro($sql, ['producto' => $_POST['producto_id'], 'id' =>  $_SESSION['usuario']['id']]);
    if (!empty($existe)) {
        if ($_POST['cantidad'] <= 0) {
            $db->eliminarRegistro('carrito', ['id' => $existe['carritoid']]);
            redirecion();
        }
        $datos['cantidad'] = $_POST['cantidad'];
        $datos['Precio'] = $datos['cantidad'] * $producto['precio'];
        $db->actualizarRegistro('carrito', $datos, ['id' => $existe['id']]);
    } else {
        $db->insertarRegistro('carrito', $datos);
    }
    redirecion();
} else {
    echo "Producto no encontrado.";
    die();
}
