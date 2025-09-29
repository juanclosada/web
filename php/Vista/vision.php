<!DOCTYPE html>
<html lang="en">
<?php
include_once dirname(__DIR__) . '/vista/layout/head.php';

?>

<body>
    <?php
    $body = '1';
    include dirname(__DIR__) . '/vista/layout/topBar.php';
    include dirname(__DIR__) . '/vista/layout/navBar.php';
    ?>
    
    <!-- Featured Start -->
     <div class="container">
 <section class="contenido">
    <h1>Nuestra Visión</h1>
    <p>
      En <strong>Industria Alcobas 2Jack</strong> aspiramos a ser reconocidos a nivel nacional e internacional como una empresa líder en diseño y fabricación de muebles para el hogar. 
      Nuestra visión es convertirnos en un referente de innovación, calidad y responsabilidad ambiental, ampliando nuestra presencia en el mercado y manteniendo el compromiso con nuestros clientes. 
      Queremos transformar cada hogar colombiano en un espacio único, funcional y lleno de estilo, elevando la experiencia del mobiliario personalizado.
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