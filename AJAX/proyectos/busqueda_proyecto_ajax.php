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
    if (!isset($_SESSION['id'])) {
        session_start();
    }
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $etiquetas = isset($_POST['selectedValues']) ? $_POST['selectedValues'] : null;

    if($nombre == null && $etiquetas == null){
        $datos = $obj_proyectos->selectAllProjects();
    }else if($nombre != null && $etiquetas == null){
        $datos = $obj_proyectos->selectProjectbyName($nombre);
    }else if($nombre == null && $etiquetas != null){
        $datos = $obj_proyectos->selectProjectbyTags($etiquetas);
    }else if($nombre != null && $etiquetas != null){
        $datos = $obj_proyectos->selectProjectbyNameAndTag($nombre, $etiquetas);
    }

    
    
    if (!empty($datos)) {
        foreach ($datos as $proyecto) {
            $id_proyect = $proyecto['ID_PROYECTO'];
            $imagenes_proyecto = $obj_imagen_proyectos->selectImageProyectByID($id_proyect);
            if (empty($imagenes_proyecto)) {
                $imagenes_proyecto_default = $obj_imagen_proyectos->selectDefaultImage();
                foreach ($imagenes_proyecto_default as $imagen) {
                    $imagen_default = $imagen['IMAGEN'];
                }
            }
            ?>
            <div class="card" style="width: 80%;">
                <img src="data:image/png;base64,<?php ?>">
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
                    if (isset($_SESSION['user'])) {
                        ?>
                        <a class="btn btn-primary" href="#" class="card-link" style="width:100%">Saber más de este proyecto</a>
                        <?php
                    } else {
                        ?>
                        <a href="login.php" class="card-link">Iniciar sesión para obtener más información</a>
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
?>