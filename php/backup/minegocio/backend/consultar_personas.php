<?php
header('access-control-allow-origin: *');
header("access-control-allow-Methods: HEAD, GET, POST, PUP, PATCH, DELETE, OPTIONS ");
header("access-control-allow-Headers: X-API-KEY, Origin,X-Requested-Content-Type, Accept, Accesscontrol-Request-Method, Access-control-Request-Headers, Authorization");
header('Content-Type: application/json');

require "../conexion.php"; // llamar conexion

mysqli_set_charset($con, "utf8");
$consulta = "SELECT * FROM personas order by nombre"; // Consulta

$respuesta = mysqli_query($con, $consulta); // Ejecuto Query

if (!$respuesta) {
    die();
}
// Arreglo vacio para llenar con el resultado de la consulta
$json = array();
while ($r = $respuesta->fetch_assoc()) {
    array_push($json, $r);
}
//parsear a JSON y muestra por pantalla
echo json_encode($json);
//Cierre de la conexion a la BD
mysqli_close($con);
