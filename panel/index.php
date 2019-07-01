<DOCTYPE html>
    <?php
    require_once("../configuraciones.php");
    require_once("../funciones.php");

    require_once "../vendor/autoload.php";
    Clases\Sesion::start();
?>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Libreria-PANEL</title>

        <!--CSS-->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Patua+One|Permanent+Marker|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="../css/estilos.css">

        <!-- JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <header>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-4 col-md-1 my-6 fondologo">
                        <a href="index.php"><img src="../img/icono.png" alt="logo" class="img-fluid resolucion_logo"></a>
                    </div>
                </div>
            </div>
        </header>

        <nav class="navbar colornavbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav mr-auto">

    <!-- comienza navbar -->               
                   
            <?php
                foreach(arrays_para_navbar_panel() as $navbar2):
            ?>
                    <li class="nav-item <?= !empty($_GET["seccion"]) && nombre_original($_GET["seccion"]) == $navbar2["nombre"] ? "active" : "" ; ?>">
                        <a class="nav-link" href="<?= $navbar2['ruta'] ?>">
                            <?= $navbar2['nombre'] ?></a>
                    </li>

            <?php
                endforeach;
            ?>
                    <li><a href="../index.php" class="btn btn-dark btn-block">Volver a la pagina</a></li>
                </ul>
            </div>
        </nav>

    <!-- finaliza navbar -->
    <!-- incluir los modulos -->
    <?php

        if(!empty($_GET["seccion"])):
            $seccion = $_GET["seccion"];

            if(file_exists("secciones/$seccion.php"))
                require_once("secciones/$seccion.php");
            else
                require_once("../secciones/404.php");
        else:
            require_once("secciones/lista_carrousel_home.php");
        endif;
       


    ?>


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
