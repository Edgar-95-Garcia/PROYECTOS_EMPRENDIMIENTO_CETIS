<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id']) && isset($_GET['u'])) {
    $id_proyecto = $_GET['id'];
    $u = $_GET['u'];
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./MODELO/Imagen_proyectos/Consultar_imagen_proyecto.php");
    $obj_imagen_proyectos = new Consultar_imagen_proyecto();

    include_once("./MODELO/Proyectos/Consultar_proyecto.php");
    $obj_proyectos = new Consultar_proyecto();
    //-------------------------------------
    $datos_proyecto = $obj_proyectos->selectProjectbyId($id_proyecto);
    foreach ($datos_proyecto as $proyecto) {
        $id_usuario = $proyecto['ID_USUARIO'];
        $nombre_proyecto = $proyecto['NOMBRE_PROYECTO'];
        $descripcion = $proyecto['DESCRIPCION'];
        $fecha_modificacion = $proyecto['FECHA_MODIFICACION'];
    }
    /*
    Las siguientes líneas sirven para que un usuario solamente pueda modificar
    los proyectos que son de su propiedad y no pueda modificar un proyecto
    que no es suyo
    */
    if ($u != $id_usuario) {
        ?>
        <script>
            window.location.replace("index.php");
        </script>
        <?php
    }

    ?>
    <center>
        <h3>MODIFICACIÓN DE PROYECTO DE EMPRENDIMIENTO
            <i>
                <?php echo $k->dec($nombre_proyecto) ?>
            </i>
        </h3>
    </center>
    <br><br>
    <div>
        <center>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                INFORMACIÓN GENERAL DEL PROYECTO
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <p>Nombre del proyecto</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($nombre_proyecto) ?>
                                </p>
                            </b>
                            <p>Descripción del proyecto</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($descripcion) ?>
                                </p>
                            </b>
                            <p>Fecha de modificación</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($fecha_modificacion) ?>
                                </p>
                            </b>
                            <br><br>
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_modificacion_datos">Modificar estos datos</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                ARCHIVOS DEL PROYECTO (PDF, ZIP, RAR, ETC)
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-primary">Subir archivos</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                ARCHIVOS ILUSTRATIVOS DEL PROYECTO
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-primary">Subir fotos e imagenes</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour">
                                ETIQUETAS
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-primary">Subir fotos e imagenes</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php

            ?>
        </center>
    </div>
    <br><br>
    <?php
    include_once("./pie.php");
} else {
    ?>
    <script>
        location.replace("index.php");
    </script>
    <?php
}
?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_modificacion_datos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificación de datos generales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    <input type="hidden" name="id_profesor" id="id_profesor">
                    NOMBRE<br><input id="nombres" name="nombres" type="text" value="<?php echo $k->dec($nombre_proyecto)?>"> <br><br>
                    <textarea name="descripcion" id="descripcion" cols="23" rows="5"><?php echo $k->dec($descripcion)?></textarea><br><br>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary" onclick="modificar_profesor()">Modificar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>