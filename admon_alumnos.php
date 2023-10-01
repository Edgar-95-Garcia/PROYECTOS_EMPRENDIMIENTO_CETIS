<?php
$GLOBALS['menu'] = 'admon';

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
    $obj_alumnos = new Consultar_usuario();
    $datos_profesores = $obj_alumnos->selectUsersAlumno();
    ?>
    <center>
        <br><br>
        <h2>ALUMNOS REGISTRADOS EN EL SISTEMA</h2>
        <hr class="red">
        <br><br>
    </center>
    <div style="text-align: center;">
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NOMBRES</th>
                    <th scope="col">APELLIDO PATERNO</th>
                    <th scope="col">APELLIDO MATERNO</th>
                    <th scope="col">MATRICULA</th>
                    <th scope="col">CONTRASEÑA</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">FECHA DE REGISTRO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("./CONTROLADOR/key.php");
                $k = new key();
                $contador = 0;
                if (!empty($datos_profesores)) {
                    foreach ($datos_profesores as $profesor) {
                        $id = $profesor['ID_USUARIO'];
                        $nombres = $k->dec($profesor['NOMBRE']);
                        $a_p = $k->dec($profesor['APELLIDO_P']);
                        $a_m = $k->dec($profesor['APELLIDO_M']);
                        $matricula = $k->dec(isset($profesor['MATRICULA']) ? $profesor['MATRICULA'] : '');
                        $pass = $k->dec($profesor['PASS']);
                        $fecha_registro = $k->dec($profesor['FECHA_ALTA']);
                        $status = $profesor['STATUS'] == '0' ? 'NO PUEDE INGRESAR' : 'PUEDE INGRESAR';
                        $contador++;
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $contador; ?>
                            </th>
                            <td>
                                <?php echo $nombres; ?>
                            </td>
                            <td>
                                <?php echo $a_p ?>
                            </td>
                            <td>
                                <?php echo $a_m ?>
                            </td>
                            <td>
                                <?php echo $matricula ?>
                            </td>
                            <td>
                                <?php echo $pass ?>
                            </td>
                            <td>
                                <?php echo $status ?>
                            </td>
                            <td>
                                <?php echo $fecha_registro ?>
                            </td>
                            <td>
                                <button class="btn btn-info" style="width: 100px;" data-toggle="modal" data-target="#modal_modificar_alumno"
                                    onclick="cambiar_datos('<?php echo $id; ?>')">Modificar</button>
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
                        <td colspan="8">No hay alumnos registrados</td>
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
            title: 'Confirmar eliminaciòn de usuario',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = { id: id };
                jQuery.ajax({
                    url: "./CONTROLADOR/usuarios/eliminar_usuario.php",
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if (data.result == 1) {
                            Swal.fire('Alumno eliminado', '', 'success').then((result) => {
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
    function cambiar_datos(id) {
        var data = { id: id };
        jQuery.ajax({
            url: "./AJAX/usuarios/Consultar_usuario_ajax.php",
            type: "POST",
            dataType: "json",
            data: data,
            error: function (response) {
                console.log("Error" + (JSON.stringify(response)));
            },
            success: function (data) {
                //console.log(data);
                $("#id_profesor").val(data[0]);
                $("#id_usuario").text("Modificación de alumno con ID: " + data[0]);
                $("#nombres").val(data[1]);
                $("#paterno").val(data[2]);
                $("#materno").val(data[3]);
                $("#matricula").val(data[4]);
                $("#contraseña").val(data[5]);
                var selectElement = document.getElementById("selection");
                switch (parseInt(data[6])) {
                    case 0:
                        selectElement.selectedIndex = 0;
                        break;
                    case 1:
                        selectElement.selectedIndex = 1;
                        break;
                    case 2:
                        selectElement.selectedIndex = 2;
                        break;
                }
                $("#registro").val(data[8]);
                console.log(JSON.stringify(data));
                var selectElement = document.getElementById("estatus");
                switch (parseInt(data[7])) {
                    case 0:
                        selectElement.selectedIndex = 0;
                        break;
                    case 1:
                        selectElement.selectedIndex = 1;
                        break;
                }
            }
        })
    }
    function modificar_alumno() {
        id = $("#id_profesor").val();
        nombres = $("#nombres").val();
        a_p = $("#paterno").val();
        a_m = $("#materno").val();
        matricula = $("#matricula").val();
        pass = $("#contraseña").val();
        tipo = $("#selection").val();
        status = $("#estatus").val();
        var data = {
            id: id,
            nombres: nombres,
            a_p: a_p,
            a_m: a_m,
            matricula: matricula,
            pass: pass,
            tipo: tipo,
            status: status
        };
        jQuery.ajax({
            url: "./AJAX/usuarios/modificar_usuario_ajax.php",
            type: "POST",
            data: data,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Modificación exitosa',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Modificación no realizada, reintentar en unos minutos',
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal_modificar_alumno">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="id_usuario"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    <input type="hidden" name="id_profesor" id="id_profesor">
                    NOMBRE (S)<br><input id="nombres" name="nombres" type="text"> <br><br>
                    APELLIDO PATERNO <br><input id="paterno" name="paterno" type="text"> <br><br>
                    APELLIDO MATERNO<br><input id="materno" name="materno" type="text"> <br><br>
                    MATRICULA<br><input id="matricula" name="matricula" type="text"> <br><br>
                    CONTRASEÑA<br><input id="contraseña" name="password" type="text"> <br><br><br>
                    TIPO DE USUARIO <br>
                    <select name="select" id="selection">
                        <option value="0">Administrador</option>
                        <option value="1">Estudiante</option>
                        <option value="2">Profesor</option>
                    </select>
                    <br><br>
                    FECHA DE ALTA<br><input id="registro" name="registro" type="text" disabled> <br><br>
                    ESTATUS DE USUARIO <br>
                    <select name="select" id="estatus">
                        <option value="0">NO ACTIVO</option>
                        <option value="1">ACTIVO</option>
                    </select>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary" onclick="modificar_alumno()">Modificar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
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