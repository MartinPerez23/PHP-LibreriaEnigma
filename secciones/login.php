<?php

if(!defined("ACCESO")){
    header("Location:../index.php?seccion=login");
}
?>

<section class="contact-information-area mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <section class="contact-form-area mb-100">
                    <div class="container">

                        <div class="row">

                            <?php

                            //compruebo errores
                               \Clases\Sesion::errores();

                            ?>

                            <div class="col-12">


                                <form class="p-4 bg-warning" action="procesar-login.php" method="post">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="usuario@email.com">
                                    </div>
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="**********">
                                    </div>
                                    <button type="submit" class="btn btn-block btn-primary">Ingresar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</section>

