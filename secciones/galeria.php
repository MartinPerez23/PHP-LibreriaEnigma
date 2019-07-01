<?php
  //por si editan la url

if(!defined("ACCESO")){
                            header("Location:../index.php?seccion=galeria");
                        }

?>

<div class="container my-5">
   <div class="row">
    <?php

        if ($boolean==true) mascomprados($galeria);

    ?>
    </div>
    <div class="row">
        <div class="col-12">
            <h1 class="center-block" id="libros">Libros disponibles</h1>
        </div>
    </div>



    <div class="row">
        <?php 
        
//foreach para la galeria y sus libros

foreach (\Clases\Galeria::getAll() as $libro):

    if ($libro->getHabilitado()==1):
        ?>

        <div class="col-12 col-md-3 my-3">
            <div class="card-deck">
                <div class="card border-default colortarjetas">
                    <div class="card-body">
                        <a  class="fancy_box" rel="grupo" href="<?= $libro->getImagen(); ?>"><img src="<?php echo $libro->getImagen(); ?>" alt="<?=$libro->getNombre();?>" class="img-fluid"></a>
                        <h4 class="card-title">
                            <?= $libro->getNombre(); ?>
                        </h4>
                        <p class=" text-muted autores">De:
                            <?= $libro->getAutor(); ?>
                        </p>
                        <p class="parrafos">Editorial:
                            <?= $libro->getEditorial(); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?php

        endif;
            endforeach;

        ?>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancy_box").fancybox();
    });
</script>