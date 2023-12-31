<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id']) && isset($_SESSION['admin_cetis'])) {
    $id_proyecto = $_GET['id'];
    include_once("./cabecera.php");
    //-------------------------------------
    include_once("./CONTROLADOR/key.php");
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

    ?>
    <center>
        <br><br>
        <h2>MODIFICACIÓN DE PROYECTO DE EMPRENDIMIENTO
            <i>
                <?php echo ($nombre_proyecto) ?>
            </i>
        </h2>
        <hr class="red">
        <br><br>

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
                            <button style="width: 30%;" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_modificacion_datos">Modificar estos datos</button>
                            <br><br>
                            <button style="width: 30%;" class="btn btn-danger"
                                onclick="eliminar_proyecto('<?php echo $id_proyecto ?>')">Eliminar proyecto</button>
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
                            <p>En este apartado se pueden adjuntar archivos ilustrativos para que el proyecto sea más
                                llamativo</p>
                            <p>Se recomienda adjuntar de 3 a 5 imágenes</p>
                            <p>Se recomienda que cada imágen pese menos de 1 MB</p>
                        </center>
                        <div class="card-body">
                            <input class="invisible" type="file" name="upload_image" id="upload_image" accept="image/*">
                            <br>
                            <button class="btn btn-primary" onclick="presionar_input()">Subir fotos e imagenes</button>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <?php
                            $datos_imagenes = $obj_imagen_proyectos->selectImageProyectByID($id_proyecto);
                            if (!empty($datos_imagenes)) {
                                foreach ($datos_imagenes as $imagen_datos) {
                                    $id_imagen = $imagen_datos['ID_IMAGEN'];
                                    $imagen = $imagen_datos['IMAGEN'];
                                    $fecha_modificacion = $imagen_datos['FECHA_MODIFICACION'];
                                    ?>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <img src="data:image/png;base64,<?php echo base64_encode($imagen) ?>" width="100%">
                                            <br>
                                            <button class="btn btn-danger"
                                                onclick="confirmar_eliminar(<?php echo $id_imagen ?>)">Eliminar</button>
                                        </li>
                                    </ul>
                                    <?php
                                }
                            }
                            ?>
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
                            <button class="btn btn-primary"
                                onclick="seleccionar_nueva_etiqueta('<?php echo $id_proyecto ?>')">Seleccionar nueva
                                etiqueta</button>
                        </div>
                        <center>
                            <p>En este apartado puedes seleccionar todas las categorías o etiquetas para que el proyecto
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
                                                <button class="btn btn-danger"
                                                    onclick="eliminar_etiqueta('<?php echo $etiqueta['ID_ETIQUETA'] ?>', '<?php echo $id_proyecto ?>')">Eliminar</button>
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
<script>
    function eliminar_proyecto(id_proyecto) {
        Swal.fire({
            title: 'Confirmar eliminaciòn de proyecto y toda su información (cuando aplique) como alumnos inscritos en él, calificaciones, archivos, imagenes, entre otros',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = {
                    id_proyecto: id_proyecto,
                };
                $.ajax({
                    url: 'AJAX/proyectos/eliminar_proyecto_ajax.php',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.result == 1) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'El proyecto y toda su información ha sido eliminada',
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.replace("proyectos_emprendimiento.php");
                                }
                            });
                        } else {
                            Swal.fire({
                                title: '¡Error!',
                                text: 'Reintente en unos minutos',
                                icon: 'error',
                            })
                        }
                    },
                    error: function (error) {

                    }
                });
            }
        });
    }
    function eliminar_etiqueta(id_etiqueta, id) {
        Swal.fire({
            title: 'Confirmar eliminaciòn de etiquea',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = {
                    id_etiqueta: id_etiqueta,
                    id: id,
                };
                $.ajax({
                    url: 'AJAX/etiquetas/Eliminar_etiqueta_proyecto_ajax.php',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        console.log(response);
                        if (response == 1) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'Etiqueta eliminada correctamente',
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: '¡Error!',
                                text: 'Reintente en unos minutos',
                                icon: 'error',
                            })
                        }
                    },
                    error: function (error) {

                    }
                });
            }
        });
    }
    function seleccionar_etiqueta(id_etiqueta, id) {
        var data = {
            id_etiqueta: id_etiqueta,
            id: id,
        };
        $.ajax({
            url: 'AJAX/etiquetas/Seleccionar_etiqueta_ajax.php',
            type: 'POST',
            data: data,
            success: function (response) {
                console.log(response);
                if (response == 1) {
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Etiqueta asignada correctamente',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Reintente en unos minutos',
                        icon: 'error',
                    })
                }
            },
            error: function (error) {

            }
        });
    }
    function seleccionar_nueva_etiqueta(id) {
        $("#modal_modificacion_etiquetas").modal('show');
        var data = {
            id: id,
        };
        $.ajax({
            url: 'AJAX/etiquetas/Obtener_etiquetas_ajax.php',
            type: 'POST',
            data: data,
            success: function (response) {
                $("#modal_body_etiqueta").html(response);
            },
            error: function (error) {
                // Manejar errores si ocurren
                //console.error(error);
            }
        });
    }
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
                    //console.log(response);
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
            success: function (resultado) {
                console.log(data);
                if (resultado.result == 1) {
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
    function presionar_input() {
        $("#upload_image").click();
    }

    $("#upload_image").on("change", function () {
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
                url: 'AJAX/archivos/registrar_imagen_ajax.php', // Ruta al archivo PHP que manejará la inserción en la base de datos
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,  // Evita que jQuery procese los datos
                contentType: false,  // Evita que jQuery configure el encabezado Content-Type
                success: function (response) {
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
                    console.error("Error!");
                    console.log(JSON.stringify(error));
                }
            });
        }
    });

    function confirmar_eliminar(id) {
        Swal.fire({
            title: 'Confirmar eliminaciòn de imagen',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = { id: id };
                jQuery.ajax({
                    url: "AJAX/imagenes/eliminar_imagen_ajax.php",
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if (data.result == 1) {
                            Swal.fire('Imagen eliminada', '', 'success').then((result) => {
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
        });
    }
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_modificacion_datos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Modificación de datos generales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center" id="modal_body">
                <p class="card-text">
                    <input type="hidden" name="id_proyecto" id="id_proyecto"
                        value="<?php echo isset($id_proyecto) ? $id_proyecto : '' ?>">
                    NOMBRE<br><input id="nombre" name="nombre" type="text"
                        value="<?php echo isset($nombre_proyecto) ? $nombre_proyecto : '' ?>">
                    <br><br>
                    <textarea name="descripcion" id="descripcion" cols="23"
                        rows="5"><?php echo isset($descripcion) ? $k->dec($descripcion) : '' ?></textarea><br><br>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary"
                    onclick="modificar_proyecto('<?php echo $id_proyecto; ?>')">Modificar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_modificacion_etiquetas">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Modificación de etiquetas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center" id="modal_body_etiqueta">

            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
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