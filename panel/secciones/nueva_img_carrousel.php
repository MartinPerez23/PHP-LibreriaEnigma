<?php
  
    if(!defined("ACCESO")){
        header("Location:../index.php?seccion=nuevo_libro");
    }

?>
<!-- subis imagenes en el carrousel del main -->
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="center-block">Subir una nueva imagen al carrousel</h1>
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
            <form action="crear_img.php" method="POST" enctype="multipart/form-data" class="bg-light p-3">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" max="3" id="nombre" class="form-control" placeholder="Ingrese el nombre de la imagen">
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>    
                    <input type="file" accept="image/png,image/jpeg,image/gif" class="form-control-file" name="imagen" id="imagen" aria-describedby="help_imagen">
                    <small id="help_imagen" class="form-text text-muted">La imágen del libro debe ser en formato .png, .jpg o .gif</small> 
                </div>

                <button type="submit" class="btn btn-primary">Crear una nueva imagen</button>
                
            </form>
        </div>
    </div>
    
</div>
