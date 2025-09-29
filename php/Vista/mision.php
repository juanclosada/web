
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once dirname(__DIR__) . '/vista/layout/head.php';

?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
    $body = '1';
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>
    
    <!-- Featured Start -->
     <div class="container">
 <section class="contenido">
    <h1>Nuestra Misión</h1>
    <p>
      En <strong>Industria Alcobas 2Jack</strong>, nuestra misión es transformar los espacios del hogar ofreciendo muebles innovadores, funcionales y con altos estándares de calidad. 
      Buscamos satisfacer las necesidades de nuestros clientes a través de diseños únicos, materiales resistentes y procesos sostenibles. 
      Nos esforzamos por brindar confort, estilo y durabilidad, haciendo que cada mueble sea una expresión de creatividad y compromiso con el bienestar del hogar colombiano.
    </p>
  </section>
     </div>
   
    <?php
    include dirname(__DIR__) . '/vista/layout/footer.php';
    ?>
</body>
<?php
include dirname(__DIR__) . '/vista/layout/script.php';
?>

</html>