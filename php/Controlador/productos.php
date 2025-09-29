<?php

session_start();
require 'conexion.php';

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['nombre'] . "</h3>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
       if ($row['cantidad'] > 0) {
        echo "<p>Disponible: " . $row['cantidad'] . "</p>";
        echo "<form method='POST' action='vender.php'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' value='1'>
                <button type='submit'>Vender</button>
              </form>";
    } else {
        echo "<p style='color:red;'>Producto agotado</p>";
    }

    echo "</div><hr>";
}
$conn->close();
?>

<div class="container mt-4">
    <div class="card mb-4">Gracias por su compra</div>   
    <div class="row">
        
        <?php while($row = $resultado->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= $row['imagen'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nombre'] ?></h5>
                        <p><?= $row['descripcion'] ?></p>
                        <p><strong>$<?= $row['precio'] ?></strong></p>
                        <form action="agregar_carrito.php" method="post">
                            <input type="hidden" name="producto_id" value="<?= $row['id_producto'] ?>">
                            <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
   
</div>
