<?php
require_once 'config/config.php';
include  ENCABEZADO;
?>
<body>



    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome">
        <link rel="stylesheet" href="register.css">
        <title>Formulario Registro</title>
    </head>

    <body>
        <!DOCTYPE html>
        <html lang="en">

        <div class="container">;
          

                <head>

                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome">
                    <link rel="stylesheet" href="register.css">
                    <title>Formulario Registro</title>
                </head>

                <body>
                    <form action="./Controlador/controlador_registro_usuario.php" method="POST">
                        <section class="form-register" >
                            <H4>Formulario Registro</H4>
                            <select class="custom-select" name="rol" id="rol">
                                
                                <option class="controls" value="3">Cliente</option>
                                
                            </select>
                            <input class="controls" type="text" name="nombre" id="nombre" placeholder=" Ingrese sus Nombres">
                            <input class="controls" type="text" name="apellido" id="apellido" placeholder=" Ingrese sus Apellidos">
                            <input class="controls" type="email" name="correo" id="correo" placeholder=" Ingrese su Correo">
                            <input class="controls" type="password" name="contrasena" id="contrasena" placeholder=" Ingrese su contraseña">
                            <input class="controls" type="password" name="contrasena1" id="contrasena1" placeholder=" confirme su contraseña">
                            <p> Estoy de acuerdo con <a href="">Terminos y Condiciones</a> </p>
                            <input class="button" type="submit" value="Registrar">
                            <p><a href="#">Ya tengo Cuenta</a></p>
                        </section>
                    </form>
                </body>
         
        </div>

        </html>

    </body>

    </html>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">Contactanos</h5>
            <p class="mb-4"> Somos una empresa a la vanduardia en diseños futurista de Muebles. Es tu sueño que podemos hacer realidad</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>calle 138# 54c-40, Bogota, Colombia</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@industria2jack.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+057 603520236</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4"> TIENDA EXPRES</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Nuestra Tienda</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Detalle de nuestra Tienda</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Carrito de Compras</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Forma de Pagos</a>
                        <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contactanos</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Mi Cuenta</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Nuestra Tienda</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Detalle de nuestra Tienda</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Carrito de Compras</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Forma de Pagos</a>
                        <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contactanos</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Hoja informativa</h5>
                    <p>Aqui puede encontrar diferente Información de nuestra tienda </p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder=" Su Correo electrónico">
                            <div class="input-group-append">
                                <button class="btn btn-primary"> Contactanos</button>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Siguenos</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="#">2JACK</a>. Todos los Derechos reservados. Diseñado por:
                <a class="text-primary" href="https://htmlcodex.com">Industria de Muebles 2JACK</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>