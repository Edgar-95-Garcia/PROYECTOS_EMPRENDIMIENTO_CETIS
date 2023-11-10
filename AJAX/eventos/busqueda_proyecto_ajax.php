<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Proyectos/Consultar_proyecto.php");
    $obj_proyectos = new Consultar_proyecto();
    include_once("../../MODELO/Imagen_proyectos/Consultar_imagen_proyecto.php");
    $obj_imagen_proyectos = new Consultar_imagen_proyecto();
    include_once("../../MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
    $obj_etiquetas = new Consultar_etiqueta_proyecto();
    include_once("../../MODELO/Participante_proyecto/Consultar_participante_proyecto.php");
    $obj_participante = new Consultar_participante_proyecto();
    if (!isset($_SESSION['id'])) {
        session_start();
    }
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $etiquetas = isset($_POST['selectedValues']) ? $_POST['selectedValues'] : null;

    if ($nombre == null && $etiquetas == null) {
        $datos = $obj_proyectos->selectAllProjects();
    } else if ($nombre != null && $etiquetas == null) {
        $datos = $obj_proyectos->selectProjectbyName($nombre);
    } else if ($nombre == null && $etiquetas != null) {
        $datos = $obj_proyectos->selectProjectbyTags($etiquetas);
    } else if ($nombre != null && $etiquetas != null) {
        $datos = $obj_proyectos->selectProjectbyNameAndTag($nombre, $etiquetas);
    }



    if (!empty($datos)) {
        foreach ($datos as $proyecto) {
            $id_proyect = $proyecto['ID_PROYECTO'];
            $imagenes_proyecto = $obj_imagen_proyectos->selectImageProyectByIDAjax($id_proyect);
            if (empty($imagenes_proyecto)) {
                $imagenes_proyecto_default = $obj_imagen_proyectos->selectDefaultImage();
                foreach ($imagenes_proyecto_default as $imagen) {
                    $imagen_default = $imagen['IMAGEN'];
                }
            }
            ?>
            <div class="card" style="width: 80%;">
                <?php
                $datos_imagenes_proyectos = $obj_imagen_proyectos->selectImageProyectByIDAjax($id_proyect);
                if (!empty($datos_imagenes_proyectos)) {
                    $id_carousel = rand(0, 999); //Se genera un identificador único para cada carrusel 
                    ?>
                    <!--  -->
                    <div class="carousel-container" style="max-width:300px; max-height:300px">
                        <div id="carouselControls_<?php echo $id_carousel; ?>" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $auxiliar = 0;
                                foreach ($datos_imagenes_proyectos as $datos) {
                                    ?>
                                    <div class="carousel-item <?php echo ($auxiliar == 0) ? 'active' : '' ?>"
                                        id="<?php echo 'id_' . $auxiliar ?>">
                                        <!-- Identificador único para cada item del carrusel -->
                                        <img src="data:image/png;base64,<?php echo base64_encode($datos['IMAGEN']) ?>"
                                            style="max-width:100%; max-height:100%">
                                    </div>
                                    <?php
                                    $auxiliar++;
                                }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselControls_<?php echo $id_carousel; ?>" role="button"
                                data-slide="prev" id="click_<?php echo $auxiliar ?>">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselControls_<?php echo $id_carousel; ?>" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <script>
                        $('#carouselControls_<?php echo $id_carousel; ?>').carousel();
                    </script>
                    <!--  -->
                    <?php
                } else {
                    ?>
                    <img src="Static/images/project-icon-29152.jpg">
                    <?php
                }
                ?>
                <div class="card-body">
                    <h5 class="card-title">
                        <b>Titulo del proyecto</b><br>
                        <?php echo ($proyecto['NOMBRE_PROYECTO']); ?>
                    </h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Descripción:</b> <br>
                        <?php echo $k->dec($proyecto['DESCRIPCION']); ?>
                    </li>
                    <li class="list-group-item"><b>Fecha de modificación:</b> <br>
                        <?php echo $k->dec($proyecto['FECHA_MODIFICACION']) ?>
                    </li>
                    <li class="list-group-item"><b>Etiquetas:</b> <br>
                        <?php
                        $datos_etiquetas = $obj_etiquetas->selectAllTagsProject($proyecto['ID_PROYECTO']);
                        if (!empty($datos_etiquetas)) {
                            foreach ($datos_etiquetas as $etiqueta) {
                                $datos_etiqueta = $obj_etiquetas->selectTagById($etiqueta['ID_ETIQUETA']);
                                foreach ($datos_etiqueta as $etiqueta_individual) {
                                    echo $k->dec($etiqueta_individual['NOMBRE']) . "<br>";
                                }
                            }
                        } else {
                            echo "No hay etiquetas asignadas";
                        }
                        ?>
                    </li>
                </ul>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['id_alumno'])) {
                        $datos_participante = $obj_participante->selectParticipanteProjectbyIdAJAX($proyecto['ID_PROYECTO'], 1);
                        if ($datos_participante[0][0] >= 0 && $datos_participante[0][0] < 3) { //El proyecto tiene lugares disponibles
                            //verificar que el usuario actual no se haya inscrito en el proyecto
                            $datos_participante = $obj_participante->selectDataParticipanteProjectbyIdAJAX($proyecto['ID_PROYECTO'], 1);
                            $auxiliar = false;
                            foreach ($datos_participante as $participante) {
                                if ($participante['ID_USUARIO'] == $_SESSION['id_alumno']) {
                                    $auxiliar = true; //Ya está inscrito
                                }
                            }
                            if (!$auxiliar) {
                                ?><a class="btn btn-primary" class="card-link" style="width:100%; color:white"
                                    onclick="seleccionar_proyecto('<?php echo $proyecto['ID_PROYECTO'] ?>', '<?php echo $_SESSION['id_alumno'] ?>', '1', 'Alumno')">Inscríbete</a>
                                <?php
                            } else {
                                ?>
                                <p><b>Ya estás inscrito en este proyecto</b></p>
                                <?php
                            }
                        } else if ($datos_participante[0][0] >= 3) { //El proyecto ya tiene los 3 lugares disponibles para los alumnos
                            ?>
                                <p><b>El proyecto ya no cuenta con lugares disponibles</b></p>
                            <?php
                        }
                    } else if (isset($_SESSION['id_profesor'])) {
                        $datos_participante = $obj_participante->selectParticipanteProjectbyIdAJAX($proyecto['ID_PROYECTO'], 0);
                        if ($datos_participante[0][0] >= 0 && $datos_participante[0][0] < 1) { //El proyecto tiene lugares disponibles para un profesor
                            //verificar que el usuario actual no se haya inscrito en el proyecto
                            $datos_participante = $obj_participante->selectDataParticipanteProjectbyIdAJAX($proyecto['ID_PROYECTO'], 0);
                            $auxiliar = false;
                            foreach ($datos_participante as $participante) {
                                if ($participante['ID_USUARIO'] == $_SESSION['id_profesor']) {
                                    $auxiliar = true; //Ya está inscrito
                                }
                            }
                            if (!$auxiliar) {
                                ?><a class="btn btn-primary" class="card-link" style="width:100%; color:white"
                                        onclick="seleccionar_proyecto('<?php echo $proyecto['ID_PROYECTO'] ?>', '<?php echo $_SESSION['id_profesor'] ?>', '0', 'Profesor')">Inscríbete</a>
                                <?php
                            }
                        } else if ($datos_participante[0][0] >= 1) { //El proyecto ya no tiene lugar para el profesor
                            $datos_participante = $obj_participante->selectDataParticipanteProjectbyIdAJAX($proyecto['ID_PROYECTO'], 0);
                            $auxiliar = false;
                            foreach ($datos_participante as $participante) {
                                if ($participante['ID_USUARIO'] == $_SESSION['id_profesor']) {
                                    $auxiliar = true; //Ya está inscrito
                                }
                            }
                            if ($auxiliar) {
                                ?>
                                        <p><b>Profesor: ya se encuentra inscrito en este proyecto</b></p>
                                <?php
                            } else {
                                ?>
                                        <p><b>Profesor: el proyecto ya no cuenta con lugares disponibles</b></p>
                                <?php
                            }
                        }
                    } else if (isset($_SESSION['admin_cetis'])) {
                        ?>
                                <a class="btn btn-secondary" href="editar_proyecto.php?id=<?php echo ($proyecto['ID_PROYECTO']); ?>"
                                    class="card-link" style="width:100%">Modificar</a>
                        <?php
                    }else{
                        ?>
                        <a href="login.php">Iniciar sesión</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <p>No se encontraron proyectos que contengan <b>
                <?php echo $nombre; ?>
            </b> </p>
        <?php
    }

}