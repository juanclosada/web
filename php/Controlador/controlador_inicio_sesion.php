<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT u.*, r.cargo AS rol_nombre 
            FROM usuarios u 
            LEFT JOIN roles r ON u.id_rol = r.id_rol 
            WHERE u.correo = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();


    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if ($contrasena == $usuario['contrasena']) {

            $_SESSION['usuario'] = [
                'id' => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'rol' => $usuario['rol_nombre']
            ];


            echo "✅ Bienvenido " . $usuario['nombre'] . " (Rol: " . $usuario['rol_nombre'] . ")";
            // Redireccionar a una página protegida
            header("Location:../cart.php");
            // exit;
        } else {
            echo "❌ Contraseña incorrecta. <a href='../vista/login.php'>Ingresar Nuevamente</a>";
        }
    } else {
        echo "❌ Usuario no encontrado. <a href='../vista/login.php'>Ingresar Nuevamente</a>";
    }

    $stmt->close();
    $conn->close();
}
