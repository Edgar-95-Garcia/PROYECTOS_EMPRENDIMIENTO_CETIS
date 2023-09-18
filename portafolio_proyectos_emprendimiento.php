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
$datos_proyectos = $obj_proyectos->selectAllProjectsbyIdUser($_SESSION["id"]);
?>
<center>
    <h3>PROYECTOS DE EMPRENDIMIENTO REGISTRADOS EN EL SISTEMA</h3>
</center>
<br><br>
<center><button class="btn btn-primary" data-toggle="modal" data-target="#modal">Crear nuevo proyecto</button></center>
<br><br>
<div>
    <center>
        <?php

        ?>
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
                    if (!empty($datos_proyectos)) {
                        foreach ($datos_proyectos as $proyecto) {
                            $id = $proyecto['ID_PROYECTO'];
                            $nombre = $proyecto['NOMBRE_PROYECTO'];
                            $descripcion = $proyecto['DESCRIPCION'];
                            $fecha_modificacion = $proyecto['FECHA_MODIFICACION'];

                            $contador++;
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
                                    <button class="btn btn-info" style="width: 100px;"
                                        onclick="cambiar_datos('<?php echo $id; ?>','<?php echo $_SESSION['id']; ?>')">Modificar</button>
                                    <br><br>
                                    <button class="btn btn-danger" style="width: 100px;"
                                        onclick="conf_delete('<?php echo $id ?>')">Eliminar</button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8">No hay proyectos registrados</td>
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
        window.location.replace("editar_proyecto.php?id=" + id + "&u=" + u);
    }

    function registrar_proyecto() {
        nombre = $("#nombre").val();
        descripcion = $("#descripcion").val();
        var data = {
            nombre: nombre,
            descripcion: descripcion,
        };
        jQuery.ajax({
            url: "AJAX/proyectos/registrar_proyecto_ajax.php",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.result == 1) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Registro exitoso',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'No realizado, reintentar en unos minutos',
                        icon: 'error',
                    })
                }
            },
            error: function (response) {
                console.log(response);
            }
        })
    }
    function conf_delete(id) {
        Swal.fire({
            title: 'Confirmar eliminaciòn de proyecto y toda su información relacionada',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = { id: id };
                jQuery.ajax({
                    url: "./AJAX/proyectos/eliminar_proyecto_ajax.php",
                    type: "POST",
                    dataType: 'JSON',
                    data: data,
                    success: function (reponse) {
                        if (reponse.result == 1) {
                            Swal.fire('Proyecto eliminado', '', 'success').then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire('Reintente más tarde', '', 'warning')
                        }
                    }
                })
            }
        })
    }
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    <input type="hidden" name="id_profesor" id="id_profesor">
                    NOMBRE DEL PROYECTO<br><input id="nombre" name="nombre" type="text"> <br><br>
                    DESCRIPCIÓN DEL PROYECTO<br><textarea id="descripcion" name="descripcion" cols="23" rows="5"></textarea><br><br>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary" onclick="registrar_proyecto()">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>