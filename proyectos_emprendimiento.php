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
include_once("./MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
$obj_etiquetas = new Consultar_etiqueta_proyecto();
?>
<center>
    <h3>PROYECTOS DE EMPRENDIMIENTO REGISTRADOS EN EL SISTEMA</h3>
    <br><br>

    <div class="form-row" style="width: 80%">
        <div class="form-group col-md-6">
            <label for="nombre_proyecto">Búsqueda de proyectos por nombre</label>
            <input type="text" class="form-control" id="nombre_proyecto" style="height:33px"
                onkeyup="modificar_informacion()">
        </div>
        <div class="form-group col-md-6">
            <label>Búsqueda de proyectos por etiqueta</label>
            <br>
            <select class="js-example-basic-multiple" id="etiqueta_seleccionada" name="states[]" multiple="multiple"
                style="width:90%" id="etiquetas" name="etiquetas">
                <?php $todas_etiquetas = $obj_etiquetas->selectAllTags();
                if (!empty($todas_etiquetas)) {
                    foreach ($todas_etiquetas as $etiquetas_individuales) {
                        $nombre_etiqueta = $k->dec($etiquetas_individuales['NOMBRE']);
                        ?>
                        <option value="<?php echo $etiquetas_individuales['ID_ETIQUETA'] ?>"><?php echo $nombre_etiqueta ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
</center>
<br><br>
<hr>
<br><br>
<div class="container" id="datos_busqueda" name="datos_busqueda"></div>
<br><br>
<?php
include_once("./pie.php");
?>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function () {
        jQuery.ajax({
            url: "AJAX/proyectos/busqueda_proyecto_ajax.php",
            type: "POST",
            success: function (result) {
                $("#datos_busqueda").html(result);
            },
            error: function (respone) {
                console.log(respone);
            }
        })
    });
    //----------------------------------------------------
    $("#etiqueta_seleccionada").on("change", function () {        
        modificar_informacion();
    });

    function modificar_informacion() {
        var selectedValues = $("#etiqueta_seleccionada").val();

        nombre = $("#nombre_proyecto").val()
        var data = {
            nombre: nombre,
            selectedValues:selectedValues,
        };
        jQuery.ajax({
            url: "AJAX/proyectos/busqueda_proyecto_ajax.php",
            type: "POST",
            data: data,
            success: function (result) {
                $("#datos_busqueda").html(result);
            },
            error: function (respone) {
                console.log(respone);
            }
        })
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
</style>