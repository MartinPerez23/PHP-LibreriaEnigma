<?php
    //por si editan la url
    if(!defined("ACCESO")){
        header("Location:../index.php?seccion=formulario");
    }

    ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Registro</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 ">

            <?php
            
            //comprobar que nombre, generos y email en la url...
                if(!isset($_SESSION["error"]) && isset($_SESSION["formulario"]["nombre"]) && isset($_SESSION["formulario"]["generos"]) && isset($_SESSION["formulario"]["email"]) && !empty($_SESSION["formulario"]["email"]) && !empty($_SESSION["formulario"]["generos"]) && !empty($_SESSION["formulario"]["nombre"])):

            ?>

                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Gracias crearte un usuario <?= $_SESSION["formulario"]["nombre"] ?> <?php if(isset($_SESSION["formulario"]["apellido"]) && !empty($_SESSION["formulario"]["apellido"])) echo $_SESSION["formulario"]["apellido"]; ?>!</strong>
                      
                    <?php
                        
                    $gene = unserialize ($_SESSION["formulario"]["generos"]);
                        echo "En breve recibirá un mail con <ul>";
                            foreach ($gene as $genero): 
                                echo "<li>".$genero."</li>";
                            endforeach;
                        echo "</ul>" ;
                    
                    
                        echo "<p class='text-muted'>Recibido de: " . $_SESSION["formulario"]["email"] . " </p>";
                        if(isset($_SESSION["formulario"]["comentario"]) && !empty($_SESSION["formulario"]["comentario"]))
                            echo "<p class='text-muted'>Comentando: " . $_SESSION["formulario"]["comentario"] . "</p>";
                        unset($_SESSION["formulario"]);
                    ?>
                    
                </div>
            <?php
                endif;
            //comprobar errores...
            \Clases\Sesion::errores();
            ?>

            <!-- Formulario -->

            <form action="proceso-formulario.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre">
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="**********">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese su apellido">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="usuario@gmail.com">
                </div>

                <div class="form-group">
                    <label for="comentario">Comentarios</label>
                    <textarea class="form-control" name="comentario" rows="5" placeholder="Ingrese un comentario si lo desea"></textarea>
                </div>
                                                            
            <!-- Checkbox -->
                                                            
                <div class="form-group">
                    <label>Genero favorito</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Comedia">
                            Comedia
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Romance">
                            Romance
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Accion">
                            Acción
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Terror">
                            Terror
                        </label>
                    </div>


                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Adultos">
                            Adultos(+18)
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Suspenso">
                            Suspenso
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="generos[]" value="Policial">
                            Policial
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-block">Registrarse</button>

            </form>
        </div>

    </div>
</div>

