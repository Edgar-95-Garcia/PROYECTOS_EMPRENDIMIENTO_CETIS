<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $id = $_POST['id'];
        include_once("../../CONTROLADOR/key.php");
        $k = new key();
        include_once("../../MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
        $obj_etiquetas = new Consultar_etiqueta_proyecto();
        $datos_etiquetas = $obj_etiquetas->selectNORTagsProjectAjax($id);
        if (!empty($datos_etiquetas)) {
            ?>
            <div style="align-content: right;">
                <table class="table table-bordered table-hover table-responsive">
                    <tbody>
                        <?php
                        foreach ($datos_etiquetas as $dato_etiqueta) {
                            ?>
                            <tr>
                                <td style="width: 300px;">
                                    <?php echo $k->dec($dato_etiqueta['NOMBRE']) ?>
                                </td>
                                <td><button class="btn btn-primary" onclick="seleccionar_etiqueta('<?php echo $dato_etiqueta['ID_ETIQUETA'] ?>' ,'<?php echo $id?>')">Seleccionar </button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        } else {
            ?>
            <p>No se encontraron etiquetas</p>
            <?php
        }
    } catch (PDOException $e) {
        echo 0;
    }
}