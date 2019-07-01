<DOCTYPE html>
    <?php
    
        //pongo los arrays, configuraciones y el autoload de clases
            
        require_once("configuraciones.php");
        require_once("arrays.php");
        require_once("funciones.php");

        require_once "vendor/autoload.php";


        //inicio una sesion
    Clases\Sesion::start();

    ?>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>LibreriaEnigma</title>

        <!--CSS-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link href="https://fonts.googleapis.com/css?family=Patua+One|Permanent+Marker|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen">

        <!-- JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="css/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="css/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>



    </head>

    <body>

        <header>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-4 col-md-1 my-6 fondologo">
                        <a href="index.php"><img src="img/icono.png" alt="logo" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </header>

       <!-- Comienzo navbar -->

        <nav class="navbar colornavbar justify-content-between navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav mr-auto">

                <?php
                    foreach($navbar as $nav):
                ?>
                    <li class="nav-item <?= !empty($_GET["seccion"]) && ucfirst($_GET["seccion"])== $nav["nombre"] ? "active" : "" ; ?>">
                        <a class="nav-link" href="<?= $nav['ruta'] ?>">
                            <?= $nav['nombre'] ?></a>
                    </li>

                    <?php
                        endforeach;
                        //compruebo que haya usuario y sea admin
                        if((\Clases\Sesion::hayUser()) && ($_SESSION["usuario"]["admin"] == 1 )):
                    ?>
                            <li><a href="panel/index.php" class="btn btn-dark btn-block">Panel</a></li>
                    <?php
                        endif;

                    ?>
                </ul>
                <?php

                //compruebo que haya un usuario en la SESSION
                    if(\Clases\Sesion::hayUser()):

                    ?>
                        <div class="menu-btn">
                            <p class="text-white justify-content-end"><?= \Clases\Sesion::user() ?></p>
                            <!-- Boton de darse de baja, solo disponible para no-admins -->
                            <?php if($_SESSION["usuario"]["admin"]==0):
                            ?>
                            <a href="index.php?seccion=baja" class="btn btn-danger btn-block">Darse de Baja</a>
                            <?php
                                    endif;0
                            ?>
                            <a href="index.php?seccion=logout" class="btn btn-danger btn-block">Cerrar Sesion</a>
                        </div>

                    <?php
                        endif;
                    ?>

                <?php
                if(!\Clases\Sesion::hayUser()):
                ?>
                <!-- Button -->
                <div class="menu-btn">
                    <a href="index.php?seccion=login" class="btn btn-info btn-block">Ingresar</a>
                </div>
                <?php
                                endif;

                                    ?>
            </div>
        </nav>

        <!-- Finaliza navbar -->
        
        <!-- incluye las secciones -->
        
        <?php

        if(!empty($_GET["seccion"])):
            $seccion = $_GET["seccion"];

            if($seccion == "home")
                    require_once("secciones/home.php");

                else if($seccion == "galeria")
                    require_once("secciones/galeria.php");
                
                else if($seccion == "formulario")
                    require("secciones/formulario.php");

                else if($seccion == "login")
                    require("secciones/login.php");

                else if($seccion == "logout")
                    require("logout.php");

                else if($seccion == "baja")
                    require("baja.php");
            
                else
                    require_once("secciones/404.php");
            else:
                require_once("secciones/home.php");
        endif;

        ?>

        <!-- Footer -->
        <div class="container-fluid px-0">
            <footer class="footer">
                <div class="row mx-0">
                    <div class="col-12 px-0">
                        <h4 class="text-center">Todos los derechos reservados.</h4>
                    </div>
                </div>
            </footer>
        </div>
    </body>

    </html>
