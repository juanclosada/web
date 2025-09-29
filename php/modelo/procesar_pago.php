<?php
session_start();
include '../config/config.php';
include '../controlador/conexion.php';

if (!isset($_SESSION['usuario']['id'])) {
    header("Location: ../vista/login.php");
    exit();
}
$db = new Conexion();
$factura = $db->consultarRegistro("SELECT * FROM factura WHERE id = :id", ['id' => $_POST['id']]);
$iva = $factura['total'] * 0.19;
$query = $db->actualizarRegistro('factura', [
    'forma_pago' => $_POST['metodo'],
    'numero_tarjeta' => $_POST['numero'],
    'fecha_expedicion' => $_POST['expira'],
    'cvv' => $_POST['cvv'],
    'fecha_pago' => date('Y-m-d H:i:s'),
    'estado' => 2,
    'IVA' => $iva,
], ['id' => $factura['id']]);
$db->actualizarRegistro('carrito', ['estado' => 2], ['factura_id' => $factura['id']]);
//
$data['id_factura'] = $_POST['id'];
$data['direccion_envio'] = $_POST['envio'];
$data['ciudad'] = $_POST['ciudad'];
$data['telefono_contacto'] = $_POST['numero'];
$data['estado_envio'] = 1;
$data['fecha_envio'] = date('Y-m-d H:i:s');
$data['fecha_entrega'] = "";
// $data['fecha_entrega'] = date('Y-m-d H:i:s', strtotime('+10 hours'));
$db->insertarRegistro('envios', $data);
if ($query) {
    $_SESSION['car'] = 0;
    header("location: ../vista/ReporteFactura.php?factura_id=" . base64_encode($factura['id']));
} else {
    echo "Error al crear la factura.";
    die();
}
