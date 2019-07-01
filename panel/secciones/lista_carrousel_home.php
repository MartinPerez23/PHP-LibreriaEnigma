<div class="container">
    <h1 class="mt-5 mb-3">Listado del carrousel en home</h1>

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
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                            //files para llenar la tabla
                    
                        $carpeta = "../img/carrousel";
                        foreach (\Clases\Filesystem::getAll($carpeta) as $img):
                                $imagen = glob("$carpeta/$img/$img.*") > 0 ? glob("$carpeta/$img/$img.*")[0] : "../img/icono.png";

                                
                    ?>

                   <!-- datos en la tabla -->
                   
                    <tr>
                        <td>
                            <?= sacar_jpg_png_gif($img) ?>
                        </td>
                        <td><img src="<?= $imagen ?>" alt="<?= $img ?>" width="250"></td>
                        <td>
                           
                           <!-- botones para borrar o editar -->
                           
                            <form action="mover_papelera.php" method="post">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                </div>
                                <input type="hidden" value="<?= $img ?>" name="id">
                                
                            </form>
                        </td>
                        
                        <!-- fin botones para borrar o editar -->

                    </tr>
                            <!-- fin datos en la tabla -->
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
