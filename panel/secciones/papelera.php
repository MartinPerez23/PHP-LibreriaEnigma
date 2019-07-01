<div class="container">
    <?php

    //mensaje que hizo correctamente un accion
    \Clases\Sesion::ok();

    // mensaje si ocurrio un error
       \Clases\Sesion::errores();

    //si no existe la carpeta en panel/papelera/.., se crea.
    
    if(!is_dir("papelera")): 
        mkdir("papelera");
        mkdir("papelera/libros");
        mkdir("papelera/carrousel");
    endif;
    
    //si hay algun archivo en papelera, muestra una o dos tabla/s, segun el contenido
if (\Clases\Galeria::papelera()):
    ?>

    <div class="row">
    <h3>Lista de libros</h3>
    </div>
       <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach(\Clases\Galeria::getAll() as $libro):

                                $imagen = "../".$libro->getImagen();
                                
                                $autor = $libro->getAutor();
                                $editorial = $libro->getEditorial();
                    if ($libro->getHabilitado() == 0):
                    ?>

                    <tr>
                        <td>
                            <?= nombre_original($libro->getNombre()) ?>
                        </td>
                        <td>
                            <?= $autor; ?>
                        </td>
                        <td>
                            <?= $editorial; ?>
                        </td>
                        <td><img src="<?= $imagen ?>" alt="<?= $libro->getNombre(); ?>" width="50"></td>
                        <td>
                           
                           <!-- botones --> 

                            <form action="devolver_libro.php" method="post">

                                <button type="submit" class="btn btn-success btn-sm">Devolver libro</button>
                                <input type="hidden" value="<?= $libro->getNombre() ?>" name="id">

                            </form>
                            <!--  fin botones --> 
                            
                        </td>

                    </tr>

                    <?php
                        endif;

                        endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <?php
    endif;
    if(count(glob("papelera/carrousel/*")) > 0):
    ?>
    <div class="row">
    <h3>Lista de imagenes del carrousel</h3>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $carpeta="papelera/carrousel";
                        foreach (\Clases\Filesystem::getAll($carpeta)as $img):

                                $imagen = count(glob("$carpeta/$img/$img.*")) > 0 ? glob("$carpeta/$img/$img.*")[0] : "../img/icono.png";
                                
                    ?>

                    <tr>
                        <td>
                            <?= nombre_original($img) ?>
                        </td>
                        <td><img src="<?= $imagen ?>" alt="<?= $img ?>" width="250"></td>
                        <td>
                           
                           <!-- botones --> 
                           
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="borrar_permanente.php" method="post">
                                    <button type="submit" class="btn btn-danger btn-sm">Borrar Permanentemente</button>
                                    <input type="hidden" value="<?= $img ?>" name="id">
                                    <input type="hidden" name="carrousel">
                                </form>
                                <form action="devolver_carrousel.php" method="post">
                                    <button type="submit" class="btn btn-success btn-sm">Devolver imagen</button>
                                    <input type="hidden" value="<?= $img ?>" name="id">

                                </form>
                            </div>
                            
                            <!--  fin botones --> 
                            
                        </td>

                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php
    
    //si la carpeta esta vacia muestra el siguiente mensaje
    
    endif;
        if((!\Clases\Galeria::papelera()) && count(glob("papelera/carrousel/*")) == 0):
    ?>
            
            <div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1>La papelera esta vacia!</h1>
        </div>
    </div>
    <div class="row">
        <div class="offset-2 col-8">
            <img src="../img/papelera_vacia.png" alt="papelera-vacia" class=" img-fluid">
        </div>
    </div>
</div>
            
        
    <?php
        endif;
    ?>

</div>
