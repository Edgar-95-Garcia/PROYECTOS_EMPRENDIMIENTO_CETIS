<?php
$GLOBALS['menu'] = 'reportes';

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
    include_once("./CONTROLADOR/key.php");
    $k = new key();
    include_once("./MODELO/Usuarios/Consultar_usuario.php");
    $obj_usuarios = new Consultar_usuario();
    include_once("./MODELO/Sugerencias/Consultar_sugerencia.php");
    $obj_sugerencias = new Consultar_sugerencia();
    $datos_sugerencias = $obj_sugerencias->selectSug();
    ?>
    <center>
        <br><br>
        <h2>SUGERENCIAS ENVIADAS AL SISTEMA</h2>
        <hr class="red">
        <br><br>
    </center>
    <div style="text-align: center;">
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">SUGERENCIA</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("./CONTROLADOR/key.php");
                $k = new key();
                $contador = 0;
                if (!empty($datos_sugerencias)) {
                    foreach ($datos_sugerencias as $sugerencia) {
                        $id = $sugerencia['ID'];
                        $id_usuario = $sugerencia['ID_USUARIO'];
                        $fecha = $k->dec($sugerencia['FECHA']);
                        $text = $k->dec($sugerencia['TEXTO']);
                        $contador++;
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $contador; ?>
                            </th>
                            <td>
                                <?php echo $text ?>
                            </td>
                            <td>
                                <?php
                                if ($id_usuario == 0) {
                                    echo "Anónimo";
                                } else {
                                    $datos_usuario = $obj_usuarios->selectUserById($id_usuario);
                                    echo $k->dec($datos_usuario[0]['NOMBRE']) . " " . $k->dec($datos_usuario[0]['APELLIDO_P']) . " " . $k->dec($datos_usuario[0]['APELLIDO_M']);
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $fecha; ?>
                            </td>

                            <td>
                                <button class="btn btn-danger" style="width: 100px;"
                                    onclick="conf_delete('<?php echo $id ?>')">Eliminar</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8">No hay sugerencias registrados</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <?php
    include_once("./pie.php");
}
?>
<script>
    function conf_delete(id) {
        Swal.fire({
            title: 'Confirmar eliminaciòn de sugerencia',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = { id: id };
                jQuery.ajax({
                    url: "./CONTROLADOR/sugerencias/eliminar_sugerencias.php",
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function (reponse) {
                        if (reponse.result == 1) {
                            Swal.fire('Sugerencia eliminada', '', 'success').then((result) => {
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