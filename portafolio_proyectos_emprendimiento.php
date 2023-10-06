<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}

include_once("./cabecera.php");
include_once("./CONTROLADOR/key.php");
$k = new key();
include_once("./MODELO/Participante_proyecto/Consultar_participante_proyecto.php");
$obj_participante_proyectos = new Consultar_participante_proyecto();
$datos_participante = $obj_participante_proyectos->selectDataParticipanteProjectbyId($_SESSION["id"]);
//Se obtienen todos los proyectos en el que participa el estudiante actual
include_once("./MODELO/Imagen_proyectos/Consultar_imagen_proyecto.php");
$obj_imagen_proyectos = new Consultar_imagen_proyecto();
include_once("./MODELO/Proyectos/Consultar_proyecto.php");
$obj_proyectos = new Consultar_proyecto();
?>
<br><br>
<center>
    <h2>PROYECTOS DE EMPRENDIMIENTO EN LOS QUE ME REGISTRÉ</h2>
</center>
<hr class="red">
<br><br>
<div>
    <center>
        <div style="text-align: center;">
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOMBRE DEL PROYECTO</th>
                        <th scope="col">DESCRIPCIÓN DEL PROYECTO</th>
                        <th scope="col">FECHA DE MODIFICACIÓN</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("./CONTROLADOR/key.php");
                    $k = new key();
                    $contador = 0;
                    if (!empty($datos_participante)) {
                        foreach ($datos_participante as $participante) {
                            $datos_proyecto = $obj_proyectos->selectProjectbyId($participante['ID_PROYECTO']);
                            foreach ($datos_proyecto as $proyecto) {
                                $id = $proyecto['ID_PROYECTO'];
                                $nombre = $proyecto['NOMBRE_PROYECTO'];
                                $descripcion = $proyecto['DESCRIPCION'];
                                $fecha_modificacion = $proyecto['FECHA_MODIFICACION'];
                                $contador++;
                            }

                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $contador; ?>
                                </th>
                                <td>
                                    <?php echo ($nombre); ?>
                                </td>
                                <td>
                                    <?php echo $k->dec($descripcion) ?>
                                </td>
                                <td>
                                    <?php echo $k->dec($fecha_modificacion) ?>
                                </td>
                                <td>
                                    <button class="btn btn-info" style="width: 200px;"
                                        onclick="cambiar_datos('<?php echo $id; ?>','<?php echo $_SESSION['id']; ?>')">Verificar
                                        Avance</button>
                                    <br><br>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">No hay proyectos registrados</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
    </center>
</div>
<br><br>
<?php
include_once("./pie.php");

?>
<script>
    function cambiar_datos(id, u) {
        window.location.replace("avance_proyecto_emprendimiento.php?id=" + id + "&u=" + u);
    }
</script>
<style>
    .container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 1fr;
        gap: 60px 0px;
        grid-auto-flow: row;
        grid-template-areas:
            ". . .";
    }

    .red {
        margin: 10px 0 70px;
        border-top-color: #7e9d9d;
        display: block;
        unicode-bidi: isolate;
        margin-block-start: 0.5em;
        margin-block-end: 0.5em;
        margin-inline-start: auto;
        margin-inline-end: auto;
        overflow: hidden;
        width: 70%;
    }

    hr.red::before {
        content: " ";
        width: 35px;
        height: 5px;
        background-color: #b38e5d;
        display: block;
        position: absolute;
    }
</style>