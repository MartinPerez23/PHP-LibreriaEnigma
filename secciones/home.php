
<?php
  //por si editan la url
    if(!defined("ACCESO")){
        header("Location:../index.php?seccion=home");
    }

?>
<?php

//comprobar ...

if(isset($_SESSION["alta"])):

    ?>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <?= $_SESSION["alta"]?>
    </div>

<?php
    unset($_SESSION["alta"]);
endif;
if(isset($_SESSION["baja"])):

    ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <?= $_SESSION["baja"]?>
    </div>

<?php
    unset($_SESSION["baja"]);
endif;

?>
<!-- Inicio carousel -->

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

 <ol class="carousel-indicators">
 
<!-- foreach para que recorra el array de fotos--> 
   
    <?php
    $carpeta = "img/carrousel";
    foreach(\Clases\Filesystem::getAll($carpeta) as $numcarousel):
    ?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $numcarousel ?>" class="bordeamarillo<?php if($numcarousel == 1) echo " active"; ?>"></li>
     <?php
        endforeach;
     ?>

  </ol>
  <div class="carousel-inner">
  
<!-- otro foreach para que recorra el array de fotos--> 
  
   <?php
        foreach(\Clases\Filesystem::getAll($carpeta) as $carrousel):
    ?>
    
        <div class="carousel-item<?php if($carrousel == 1) echo " active"; ?>">
          <img class="d-block w-100" src="<?= count(glob("$carpeta/$carrousel/$carrousel.*")) > 0 ? glob("$carpeta/$carrousel/$carrousel.*")[0] : "img/icono.png" ?>" alt="<?= $carrousel ?>">
        </div>
    
    <?php
        endforeach;
    ?>
    
  </div>
  <a class="carousel-control-prev bg-warning" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only bg-warning">Previous</span>
  </a>
  <a class="carousel-control-next bg-warning" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Fin de carousel -->

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="center-block">Libreria enigma</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h3>Bienvenido</h3>

<!-- pone la funcion visitantes -->
               
                <p class="parrafos">Hola, queriamos agradecer tu visita con un descuento del 10% solo por comprar por la pagina oficial de la mejor librería de Argentina.</p> 
        </div>   
        <div class="col-12 col-md-4">
            <a href="img/1.jpg"><img src="img/1.jpg" alt="libros" class="img-fluid"></a>
        </div>
    </div>
          <div class="row">
            <div class="col-12 col-md-4">
                <a href="img/2.jpg"><img src="img/2.jpg" alt="libros" class="img-fluid"></a>
            </div>             
            <div class="col-12 col-md-8">
                <h3>Nuestros servicios</h3>
                <p class="parrafos">La librería Enigma se caracterizó - y se caracteriza - por ofrecer un especial surtido de libros importados, gracias a las buenas relaciones mantenidas con proveedores del exterior. Al igual que el apoyo recibido por parte de las empresas editoriales argentinas que permitió satisfacer las demandas de una clientela con diversos intereses. Con el correr del tiempo y la tenacidad en procura de dar a los lectores un servicio de excelencia.</p> 
            </div>
          </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>¿Le interesaría saber acerca de sus libros favoritos?</h3>
                <p class="parrafos">La librería tiene <a href="index.php?seccion=formulario">este formulario</a>, si lo llena, le mandaremos todo tipo de noticias acerca de su genero literario favorito!!</p> 
            </div>
            <div class="col-12 col-md-4">
                <a href="img/3.jpg"><img src="img/3.jpg" alt="libros" class="img-fluid"></a>
            </div>
        </div>
    
</div>