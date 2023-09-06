<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_cetis"]) == null) {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else {
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
    $obj_etiquetas = new Consultar_etiqueta_proyecto();
    $datos_etiquetas = $obj_etiquetas->selectAllTags();
    ?>
    <center>
        <h3>ETIQUETAS PARA PROYECTOS DE EMPRENDIMIENTO REGISTRADAS EN EL SISTEMA</h3>
    </center>
    <br><br>
    <center><button data-toggle="modal" data-target="#modal" class="btn btn-primary">Agregar nueva etiqueta</button>
    </center>
    <br><br>
    <div>
        <div style="text-align: center;">
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ETIQUETA</th>
                        <th scope="col">DESCRIPCIÓN DE ETIQUETA</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("./CONTROLADOR/key.php");
                    $k = new key();
                    $contador = 0;
                    if (!empty($datos_etiquetas)) {
                        foreach ($datos_etiquetas as $etiqueta) {
                            $id_etiqueta = $etiqueta['ID_ETIQUETA'];
                            $nombre_etiqueta = $etiqueta['NOMBRE'];
                            $descripcion_etiqueta = $etiqueta['DESCRIPCION'];
                            $contador++;
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $contador; ?>
                                </th>
                                <td>
                                    <?php echo $k->dec($nombre_etiqueta); ?>
                                </td>
                                <td>
                                    <?php echo $k->dec($descripcion_etiqueta) ?>
                                </td>
                                <td>
                                    <button class="btn btn-danger" style="width: 200px;"
                                        onclick="conf_delete('<?php echo $id_etiqueta ?>')">Eliminar etiqueta</button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No hay etiquetas registradas</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <?php
}
?>
</div>
<br><br>
<?php
include_once("./pie.php");
?>
<script>
    function conf_delete(id) {
        Swal.fire({
            title: 'Confirmar eliminaciòn de etiqueta',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = { id: id };
                jQuery.ajax({
                    url: "AJAX/etiquetas/Eliminar_etiqueta_ajax.php",
                    type: "POST",
                    data: data,
                    success: function (reponse) {
                        if (reponse == 1) {
                            Swal.fire('Etiqueta eliminada', '', 'success').then((result) => {
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

    function agregar_etiqueta() {
        nombre = $("#nombre").val();
        descripcion = $("#descripcion").val();
        var data = {
            nombre: nombre,
            descripcion: descripcion,
        };
        jQuery.ajax({
            url: "AJAX/etiquetas/Insertar_etiqueta_ajax.php",
            type: "POST",
            data: data,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Nueva etiqueta creada',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'No se ha podido crear la etiqueta, reintente en unos minutos',
                        icon: 'error',
                    })
                }
            },
            error: function (respone) {
                console.log(respone);
            }
        })
    }
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="id_usuario">Nueva etiqueta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    NOMBRE ETIQUETA<br><input placeholder="Tecnología, Arte, Literatura, etc." id="nombre" name="nombre"
                        type="text"> <br><br>
                    DESCRIPCIÓN ETIQUETA <br><textarea placeholder="Agrega una descripción" name="descripcion"
                        id="descripcion" cols="23" rows="5"></textarea><br><br>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary" onclick="agregar_etiqueta()">Agregar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>