<?php

    if(!defined("ACCESO")){
        header("Location:../index.php?seccion=nuevo_libro");
    }

    $titulo = "Subir un nuevo";
    $action = "crear_libro.php";
    
//verificar si esta para editar o crear

    if(file_exists("tmp.txt")):
        $titulo = "Editar un ";
        $action = "editar_libro.php";

        $libro = file_get_contents("tmp.txt");
        unlink("tmp.txt");

        //verifico que solo haya un libro en la base de datos con ese nombre
        if (gettype(\Clases\Galeria::libroPorNombre($libro)) == "String"):
            \Clases\Sesion::start();
            \Clases\Sesion::set("error","muchos_libros");
            header("location:index?secciones=lista_libros");
            die();
        endif;

        $galeria = \Clases\Galeria::libroPorNombre($libro);

        //tomo los datos para ingresarlos en el editar

        $libro = $galeria->getNombre();
        $imagen = "../".$galeria->getImagen();
        $autor = $galeria->getAutor();
        $editorial = $galeria->getEditorial();

    endif;

?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="center-block">
                <?= $titulo ?> libro</h1>
        </div>
    </div>
</div>
<div class="container">

    <?php
    //mensaje si ocurre un error
    \Clases\Sesion::errores();
    ?>
    
    <div class="row">

        <div class="col-6 offset-3">
            <form action="<?= $action ?>" method="POST" enctype="multipart/form-data" class="bg-light p-3">
                <?php
                    if(isset($libro)):
                ?>

                <input type="hidden" name="id" value="<?= $libro; ?>">

                <?php
                    endif;
                ?>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" max="3" id="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?= isset($libro) ? nombre_original($libro) : null ?>">
                </div>

                <div class="form-group">
                    <label for="autor">Autor</label>
                    <select name="autor" id="autor" class="form-control">

                        <?php
                        foreach (\Clases\Autor::getAll()as $autor):
                        ?>
                        <option value="<?= $autor->getNombre() ?>"> <?= $autor->getNombre() ?> </option>
                        <?php
                        endforeach;
                        ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="autor">Editorial</label>
                    <select name="editorial" id="editorial" class="form-control">

                        <?php
                        foreach (\Clases\Editorial::getAll()as $editorial):
                            ?>
                            <option value="<?= $editorial->getNombre() ?>"> <?= $editorial->getNombre() ?> </option>
                        <?php
                        endforeach;
                        ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>    
                    <input type="file" accept="image/png,image/jpeg,image/gif" class="form-control-file" name="imagen" id="imagen" aria-describedby="help_imagen">
                    <small id="help_imagen" class="form-text text-muted">La imágen del libro debe ser en formato .png, .jpg o .gif</small>  
                     <!-- Si entra por editar y habia img, la muestra -->
                   
                    <?php
                        if(isset ($imagen)):
                    ?>
                    <br>
                    <p >Imagen actual:(al no ingresar imagen, se pone otra):</p>
                    <img src="<?= $imagen ?>" alt="foto_libro" width="150">
                    <?php
                        endif;
                    ?>                   
                </div>

                <button type="submit" class="btn btn-primary">Aceptar</button>
                
            </form>
        </div>
    </div>
    
</div>
