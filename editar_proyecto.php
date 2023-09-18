<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id']) && isset($_GET['u'])) {
    $id_proyecto = $_GET['id'];
    $u = $_GET['u'];
    include_once("./cabecera.php");
    //-------------------------------------
    include_once("./Controlador/key.php");
    $k = new key();
    //-------------------------------------
    include_once("./MODELO/Archivos_proyecto/Consultar_archivo_proyecto.php");
    $obj_archivo_proyectos = new Consultar_archivo_proyecto();
    //-------------------------------------
    include_once("./MODELO/Imagen_proyectos/Consultar_imagen_proyecto.php");
    $obj_imagen_proyectos = new Consultar_imagen_proyecto();
    //-------------------------------------
    include_once("./MODELO/Proyectos/Consultar_proyecto.php");
    $obj_proyectos = new Consultar_proyecto();
    //-------------------------------------
    include_once("./MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
    $obj_etiqueta_proyectos = new Consultar_etiqueta_proyecto();
    //-------------------------------------
    $datos_proyecto = $obj_proyectos->selectProjectbyId($id_proyecto);
    foreach ($datos_proyecto as $proyecto) {
        $id_usuario = $proyecto['ID_USUARIO'];
        $nombre_proyecto = $proyecto['NOMBRE_PROYECTO'];
        $descripcion = $proyecto['DESCRIPCION'];
        $fecha_modificacion = $proyecto['FECHA_MODIFICACION'];
    }
    /*
    Las siguientes líneas sirven para que un usuario solamente pueda modificar
    los proyectos que son de su propiedad y no pueda modificar un proyecto
    que no es suyo
    */
    if ($u != $id_usuario) {
        ?>
        <script>
            window.location.replace("index.php");
        </script>
        <?php
    }

    ?>
    <center>
        <h3>MODIFICACIÓN DE PROYECTO DE EMPRENDIMIENTO
            <i>
                <?php echo ($nombre_proyecto) ?>
            </i>
        </h3>
    </center>
    <br><br>
    <div>
        <center>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                INFORMACIÓN GENERAL DEL PROYECTO
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $id_proyecto ?>">
                            <p>Nombre del proyecto</p>
                            <b>
                                <p>
                                    <?php echo ($nombre_proyecto) ?>
                                </p>
                            </b>
                            <p>Descripción del proyecto</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($descripcion) ?>
                                </p>
                            </b>
                            <p>Fecha de modificación</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($fecha_modificacion) ?>
                                </p>
                            </b>
                            <br><br>
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_modificacion_datos">Modificar estos datos</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                ARCHIVOS DEL PROYECTO (PDF, ZIP, RAR, ETC)
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <center>
                            <p>En este apartado puedes adjuntar todos los archivos que conformen tu proyecto, se recomienda
                                que sean archivos en formato PDF, rar o zip</p>
                        </center>
                        <div class="card-body">
                            <button class="btn btn-primary" onclick="subir_archivo()">Subir archivos</button>
                            <br>
                            <input class="invisible" type="file" name="upload_file" id="upload_file"
                                accept=".zip,.rar,.pdf">
                            <br>
                            <?php
                            $datos_archivos_proyecto = $obj_archivo_proyectos->selectFileProyectByID($id_proyecto);
                            ?>
                            <div class="" style="width: 50%">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NOMBRE</th>
                                            <th scope="col">FECHA MODIFICACIÓN</th>
                                            <th scope="col">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        if (!empty($datos_archivos_proyecto)) {
                                            foreach ($datos_archivos_proyecto as $archivo_proyecto) {
                                                $contador++;
                                                ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $contador; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $k->dec($archivo_proyecto['NOMBRE_ARCHIVO']) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $k->dec($archivo_proyecto['FECHA_SUBIDA']) ?>
                                                    </td>

                                                    <td>
                                                        <a href="#" style="width: 100%;" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modal">Visualizar archivo</a>
                                                        <br><br>
                                                        <a href="./AJAX/archivos/descargar_archivo_ajax.php?id=<?php echo $archivo_proyecto['ID_ARCHIVO'] ?>)"
                                                            style="width: 100%;" class="btn btn-secondary">Descargar
                                                            archivo</a>
                                                        <br><br>
                                                        <a href="#" style="width: 100%;" class="btn btn-danger">Eliminar
                                                            archivo</a>
                                                        <br><br>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4">No hay archivos registrados</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                ARCHIVOS ILUSTRATIVOS DEL PROYECTO
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <center>
                            <p>En este apartado puedes adjuntar todos los archivos ilustrativos de tu proyecto, se
                                recomienda que sean imagenes o fotos</p>
                        </center>
                        <div class="card-body">
                            <button class="btn btn-primary">Subir fotos e imagenes</button>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour">
                                ETIQUETAS
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <button class="btn btn-primary">Seleccionar nueva etiqueta</button>
                        </div>
                        <center>
                            <p>En este apartado puedes seleccionar todas las categorías o etiquetas para que tu proyecto
                                pueda ser facilmente localizado</p>
                        </center>
                        <div class="card" style="width: 18rem;">
                            <?php
                            $etiquetas_seleccionadas = $obj_etiqueta_proyectos->selectAllTagsProjectNoAjax($id_proyecto);
                            if (!empty($etiquetas_seleccionadas)) {
                                foreach ($etiquetas_seleccionadas as $etiqueta_seleccionada) {
                                    $etiqueta_individual = $etiqueta_seleccionada['ID_ETIQUETA'];
                                    $informacion_etiqueta = $obj_etiqueta_proyectos->selectTagByIdNoAjax($etiqueta_individual);
                                    foreach ($informacion_etiqueta as $etiqueta) {
                                        ?>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <?php echo $k->dec($etiqueta['NOMBRE']) ?>
                                                <br>
                                                <button class="btn btn-danger">Eliminar</button>
                                            </li>
                                        </ul>
                                        <?php
                                    }

                                }

                            } else {
                                ?>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">No hay etiquetas relacionadas</li>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <?php

            ?>
        </center>
    </div>
    <br><br>
    <?php
    include_once("./pie.php");
} else {
    ?>
    <script>
        location.replace("index.php");
    </script>
    <?php
}
?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_modificacion_datos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificación de datos generales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $id_proyecto ?>">
                    NOMBRE<br><input id="nombre" name="nombre" type="text" value="<?php echo ($nombre_proyecto) ?>">
                    <br><br>
                    <textarea name="descripcion" id="descripcion" cols="23"
                        rows="5"><?php echo $k->dec($descripcion) ?></textarea><br><br>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary"
                    onclick="modificar_proyecto('<?php echo $id_proyecto; ?>')">Modificar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function subir_archivo() {
        $("#upload_file").click();
    }
    $("#upload_file").on("change", function () {
        const selectedFile = this.files[0];
        if (selectedFile) {
            id = $("#id_proyecto").val();
            // Obtener el nombre del archivo
            const fileName = selectedFile.name;
            // Creamos un objeto FormData para enviar el archivo
            const formData = new FormData();
            formData.append('archivo', selectedFile);
            formData.append('id', id);
            formData.append('nombre', fileName);
            // Realizamos una llamada AJAX para enviar el archivo al servidor
            $.ajax({
                url: 'AJAX/archivos/registrar_archivo_ajax.php', // Ruta al archivo PHP que manejará la inserción en la base de datos
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,  // Evita que jQuery procese los datos
                contentType: false,  // Evita que jQuery configure el encabezado Content-Type
                success: function (response) {
                    console.log(response);
                    if (response.result == 1) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Archivo agregado',
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
                error: function (error) {
                    // Manejar errores si ocurren
                    console.error(error);
                }
            });
        }
    });
    function modificar_proyecto(id) {
        nombre = $("#nombre").val();
        descripcion = $("#descripcion").val();
        var data = {
            id: id,
            nombre: nombre,
            descripcion: descripcion,
        };
        jQuery.ajax({
            url: "AJAX/proyectos/modificar_proyecto_ajax.php",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.result == 1) {
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
    function descargar_archivo(id_archivo) {
        var data = {
            id_archivo: id_archivo,
        };
        jQuery.ajax({
            url: "AJAX/archivos/descargar_archivo_ajax.php",
            type: "POST",
            data: data,
            success: function (data) {
                //window.location.href = "AJAX/archivos/descargar_archivo_ajax.php";
                console.log(data);
            },
            error: function (response) {
                console.log(response);
            }
        })
    }
</script>