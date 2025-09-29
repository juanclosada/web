<?php
include "../conexion.php";
$pdo = new conexion();
header("content-type: application/json");

$pdo = new conexion();
header("content-type: application/json");

$metodo  = $_SERVER['REQUEST_METHOD'];

print_r($metodo);

switch ($metodo) {
    case 'GET':
        echo "Consulta de personas";
        break;
    case 'POST':
        echo "Insersion de personas";
        break;
    case 'PUT':
        echo "Atualizacion de personas";
        break;
    case 'DELETE':
        echo "Eliminacion de personas";
        break;

    default:
        echo "Metodo no soportado";
        break;
}
