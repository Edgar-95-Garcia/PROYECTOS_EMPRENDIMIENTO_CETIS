<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}

include_once("./cabecera.php");
include_once("./Controlador/key.php");
$k = new key();
include_once("./MODELO/Imagen_proyectos/Consultar_imagen_proyecto.php");
$obj_imagen_proyectos = new Consultar_imagen_proyecto();
include_once("./MODELO/Proyectos/Consultar_proyecto.php");
$obj_proyectos = new Consultar_proyecto();
$datos_proyectos = $obj_proyectos->selectAllProjects();
include_once("./MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
$obj_etiquetas = new Consultar_etiqueta_proyecto();
?>
<center>
    <h3>PROYECTOS DE EMPRENDIMIENTO REGISTRADOS EN EL SISTEMA</h3>
    <br><br>

    <div class="form-row" style="width: 80%">
        <div class="form-group col-md-6">
            <label for="nombre_proyecto">Búsqueda de proyectos por nombre</label>
            <input type="email" class="form-control" id="nombre_proyecto">
        </div>
        <div class="form-group col-md-6">
            <label>Búsqueda de proyectos por etiqueta</label>
            <br>
            <select class="js-example-basic-multiple" name="states[]" multiple="multiple" style="width:90%">
                <?php $todas_etiquetas = $obj_etiquetas->selectAllTags();
                if (!empty($todas_etiquetas)) {
                    foreach ($todas_etiquetas as $etiquetas_individuales) {
                        $nombre_etiqueta = $k->dec($etiquetas_individuales['NOMBRE']);
                        ?>
                        <option value="<?php echo $nombre_etiqueta ?>"><?php echo $nombre_etiqueta ?></option>
                        <?php
                    }
                } else {

                }
                ?>
            </select>
        </div>
    </div>
</center>
<br><br>
<hr>
<br><br>
<div>
    <center>
        <?php
        if (!empty($datos_proyectos)) {
        } else {
            ?>
            <p>No hay proyectos registrados</p>
            <?php

        }
        foreach ($datos_proyectos as $proyecto) {
            $id_proyect = $proyecto['ID_PROYECTO'];
            $imagenes_proyecto = $obj_imagen_proyectos->selectImageProyectByID($id_proyect);
            if (empty($imagenes_proyecto)) {
                $imagenes_proyecto_default = $obj_imagen_proyectos->selectDefaultImage();
                foreach ($imagenes_proyecto_default as $imagen) {
                    $imagen_default = $imagen['IMAGEN'];
                }
            }
            ?>
            <div class="card" style="width: 18rem;">
                <img src="data:image/png;base64,<?php ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <b>Titulo del proyecto</b><br>
                        <?php echo $k->dec($proyecto['NOMBRE_PROYECTO']); ?>
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
                        <a href="#" class="card-link">Saber más de este proyecto</a>
                        <?php
                    } else {
                        ?>
                        <a href="login.php" class="card-link">Iniciar sesión para obtener más información</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <br>
            <?php
        }
        ?>



    </center>
</div>
<br><br>
<?php
include_once("./pie.php");

?>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>