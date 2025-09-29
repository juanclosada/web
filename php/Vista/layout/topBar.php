<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<div class="container-fluid">
  <div class="row bg-secondary py-1 px-xl-5">
    <div class="col-lg-6 d-none d-lg-block">
      <div class="d-inline-flex align-items-center h-100">
      </div>
    </div>
    <div class="col-lg-6 text-center text-lg-right">
      <div class="d-inline-flex align-items-center">
        <div class="btn-group">
          <?php
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
          }
          if (!empty($_SESSION['usuario']['id_rol']) && $_SESSION['usuario']['id_rol'] == 1) {
            header("location: ../vista/admin/dashboardadmin.php");
          }
          if (empty($_SESSION['usuario']['id'])) {
            echo '<a href="login.php" class="btn btn-warning">Inicio de Sesión</a>';
            echo '<a href="registro.php" class="btn btn-light">Registrete Aquí</a>';
          } else {
            echo "<h5 class='mt-1 mr-2'>" . $_SESSION['usuario']['nombre'] . '</h5>';
            echo '<a href="logout.php" class="btn btn-light">Salir</a>';
          }
          ?>

          <div class="dropdown-menu dropdown-menu-right">
          </div>
        </div>
      </div>
      <div class="d-inline-flex align-items-center d-block d-lg-none">
        <a href="" class="btn px-0 ml-2">
          <i class="fas fa-heart text-dark"></i>
          <span
            class="badge text-dark border border-dark rounded-circle"
            style="padding-bottom: 2px">0</span>
        </a>
        <a href="" class="btn px-0 ml-2">
          <i class="fas fa-shopping-cart text-dark"></i>
          <span
            class="badge text-dark border border-dark rounded-circle"
            style="padding-bottom: 2px">0</span>
        </a>
      </div>
    </div>
  </div>
  <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
    <div class="col-lg-4">
      <a href="index.php" class="text-decoration-none">
        <span class="h1 text-uppercase text-primary bg-dark px-2">INDUSTRIA</span>
        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">ALCOBAS</span>
        <span class="h1 text-uppercase text-primary bg-dark px-2">2JACK</span>
      </a>
    </div>
    <div class="col-lg-4 col-6 text-left">
    </div>
    <div class="col-lg-4 col-6 text-right">
      <p class="m-0">Servicio al Cliente</p>
      <h5 class="m-0">+57 603520236</h5>
    </div>
  </div>
</div>