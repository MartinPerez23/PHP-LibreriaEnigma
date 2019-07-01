
<div class="container">
    <h1 class="mt-5 mb-3">Listado de usuarios</h1>

<div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Comentario</th>
                        <th>Genero Favorito</th>
                        <th>Habilitado</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                            //files para llenar la tabla

                        foreach (\Clases\Usuario::getAll() as $user):



                    ?>

                   <!-- datos en la tabla -->

                    <tr>
                        <td>
                            <?= $user->getNombre() ?>
                        </td>
                        <td>
                            <?= $user->getApellido() ?>
                        </td>
                        <td>
                            <?= $user->getEmail() ?>
                        </td>
                        <td>
                            <?= $user->getComentario() ?>
                        </td>
                        <td>
                            <?php

                                $gene = unserialize ($user->getGeneroFavorito());

                            echo "<ul>";

                            foreach ($gene as $genero):
                                echo "<li>".$genero."</li>";
                            endforeach;

                            echo "</ul>" ;

                            ?>
                        </td>
                        <td>
                            <?php if($user->getHabilitado() == 1) echo "<p class='text-success'>Si</p>"; else echo "<p class='text-danger'>No</p>"; ?>
                        </td>
                        <td>
                            <?php if($user->getAdmin() == 1) echo "<p class='text-success'>Si</p>"; else echo "<p class='text-danger'>No</p>";?>
                        </td>
                    </tr>

                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
