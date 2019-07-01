<div class="container">
    <h1 class="mt-5 mb-3">Listado de libros</h1>

    <?php

//mensaje que se hizo algo correctamente

        \Clases\Sesion::ok();
    //mensaje si ocurrio un error
            \Clases\Sesion::errores();

    ?>
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
                    
                            //foreach que recurre a la clase Galeria para buscar items en la base de datos

                    foreach (\Clases\Galeria::getAll() as $libro):

                    if ($libro->getHabilitado()==1):

                                $imagen = "../".$libro->getImagen();
                                
                                $autor = $libro->getAutor();
                                $editorial = $libro->getEditorial();
                    ?>

                   <!-- datos en la tabla -->
                   
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
                        <td><img src="<?= $imagen ?>" alt="<?= $libro->getNombre() ?>" width="50"></td>
                        <td>
                           
                           <!-- botones para borrar o editar -->

                            <form action="enviar_para_editar.php" method="post">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success btn-sm">Editar</button>
                                </div>
                                <input type="hidden" name="lugar">
                                <input type="hidden" value="<?= $libro->getNombre() ?>" name="id">

                            </form>
                            <form action="mover_papelera.php" method="post">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                </div>
                                <input type="hidden" name="lugar">
                                <input type="hidden" value="<?= $libro->getNombre() ?>" name="id">

                            </form>
                        </td>
                        
                        <!-- fin botones para borrar o editar -->

                    </tr>

                    <?php
                        endif;
                        endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
