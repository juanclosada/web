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
      <h1>Sobre Nosotros</h1>
      <p>
        En <strong>Industria Alcobas 2Jack</strong>, nos especializamos en la creación y comercialización de muebles funcionales y elegantes para el hogar.
        Somos una empresa colombiana comprometida con ofrecer productos duraderos y estéticamente atractivos que se adaptan a las necesidades de nuestros clientes.
        Desde nuestros inicios, hemos trabajado con pasión, responsabilidad y creatividad para brindar soluciones innovadoras en diseño de interiores,
        enfocándonos en la comodidad y satisfacción del usuario final.
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