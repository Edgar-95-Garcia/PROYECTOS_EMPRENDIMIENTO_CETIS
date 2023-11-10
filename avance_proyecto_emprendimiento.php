<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["id_alumno"]) && !isset($_SESSION["admin_cetis"]) && !isset($_SESSION["id_profesor"])) {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
}
if (isset($_GET['id'])) {
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
    include_once("./MODELO/Calificacion_proyectos/Consultar_calificacion_proyectos.php");
    $obj_calificaciones = new Consultar_calificacion_proyectos();
    $obj_bloques_proyecto = new Consultar_calificacion_proyectos();
    //-------------------------------------
    include_once("./MODELO/Participante_proyecto/Consultar_participante_proyecto.php");
    $obj_participante = new Consultar_participante_proyecto();
    $datos_participantes = $obj_participante->selectAllParticipanteProjectbyId($id_proyecto);
    //-------------------------------------
    include_once("./MODELO/Comentarios/Consultar_comentario.php");
    $obj_retroalimentacion = new Consultar_comentario();
    //-------------------------------------
    include_once("./MODELO/Usuarios/Consultar_usuario.php");
    $obj_usuarios = new Consultar_usuario();

    $datos_proyecto = $obj_proyectos->selectProjectbyId($id_proyecto);
    if (empty($datos_proyecto)) {
        ?>
        <script>
            window.location.replace("proyectos_emprendimiento.php");
        </script>
        <?php
    }
    foreach ($datos_proyecto as $proyecto) {
        $id_usuario = $proyecto['ID_USUARIO'];
        $nombre_proyecto = $proyecto['NOMBRE_PROYECTO'];
        $descripcion = $proyecto['DESCRIPCION'];
        $fecha_modificacion = $proyecto['FECHA_MODIFICACION'];
    }

    ?>
    <br><br>
    <center>
        <h2>AVANCE DE PROYECTO: <i>
                <?php echo ($nombre_proyecto) ?>
            </i></h2>
    </center>
    <hr class="red">
    <br><br>

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
                            <hr>
                            <p>Descripción del proyecto</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($descripcion) ?>
                                </p>
                            </b>
                            <hr>
                            <p>Fecha de modificación</p>
                            <b>
                                <p>
                                    <?php echo $k->dec($fecha_modificacion) ?>
                                </p>
                            </b>
                            <hr>
                            <p>Alumnos inscritos en el proyecto</p>
                            <?php
                            foreach ($datos_participantes as $participante) {
                                if ($participante['TIPO_USUARIO'] == 1) {
                                    $datos_usuarios = $obj_usuarios->selectNombreUserById($participante['ID_USUARIO']);
                                    foreach ($datos_usuarios as $nombres) {
                                        ?>
                                        <div class="" style="width: 50%;">
                                            <table class="table table-bordered table-hover table-responsive"
                                                style="display: contents !important">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Matricula</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($datos_usuarios)) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <b>
                                                                    <?php echo $k->dec($nombres['NOMBRE']) . " " . $k->dec($nombres['APELLIDO_P']) . " " . $k->dec($nombres['APELLIDO_M']) . "<br>"; ?>
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <b>
                                                                    <?php echo $k->dec($nombres['MATRICULA']); ?>
                                                                </b>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                        <td>Aún no hay alumnos inscritos</td>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <hr>
                            <p>Profesor a cargo de revisar el proyecto</p>
                            <?php
                            foreach ($datos_participantes as $participante) {
                                if ($participante['TIPO_USUARIO'] == 0) {
                                    $datos_usuarios = $obj_usuarios->selectNombreUserById($participante['ID_USUARIO']);
                                    foreach ($datos_usuarios as $nombres) {
                                        ?>
                                        <div class="" style="width: 50%;">
                                            <table class="table table-bordered table-hover table-responsive"
                                                style="display: contents !important">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nombres</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($datos_usuarios)) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <b>
                                                                    <?php echo $k->dec($nombres['NOMBRE']) . " " . $k->dec($nombres['APELLIDO_P']) . " " . $k->dec($nombres['APELLIDO_M']) . "<br>"; ?>
                                                                </b>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                        <td>Aún no hay profesor a cargo del proyecto</td>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $datos_bloques = $obj_bloques_proyecto->selectAllByIdProyecto($id_proyecto);
                //Se obtienen todos los bloques del proyecto y se crean las estructuras para el avance de cada uno de los bloques
                foreach ($datos_bloques as $bloque) {
                    $calificacion_bloque_actual = $bloque['CALIFICACION'];
                    $bloque_finalizado = $bloque['FINALIZADO'];
                    $titulo_bloque = $k->dec($bloque['TITULO']);
                    $bloque_comentario_actual = ($bloque['BLOQUE']);
                    $fecha_calificacion_bloque = ($bloque['FECHA']);
                    /* Archivos del bloque y proyecto seleccionado */
                    $datos_archivos_proyecto = $obj_archivo_proyectos->selectFileProyectByIDAndBloque($id_proyecto, $bloque['BLOQUE']);
                    ?>
                    <div class="card">
                        <div class="card-header" id="<?php echo "heading" . $bloque['BLOQUE'] ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#<?php echo "collapse" . $bloque['BLOQUE'] ?>" aria-expanded="false"
                                    aria-controls="<?php echo $bloque['BLOQUE'] ?>">
                                    <?php echo $k->dec($bloque['BLOQUE']) ?>
                                    <br>
                                    <?php echo $titulo_bloque ?>
                                </button>
                            </h5>
                        </div>
                        <div id="<?php echo "collapse" . $bloque['BLOQUE'] ?>" class="collapse"
                            aria-labelledby="<?php echo "heading" . $bloque['BLOQUE'] ?>" data-parent="#accordion">
                            <div class="card-body">
                                <hr>
                                <p>
                                    <i>
                                        <?php echo $k->dec($bloque['TEXTO']) ?>
                                    </i>
                                </p>
                                <hr>
                                <?php
                                //--------------------------------------------------------------------------
                                //La siguiente opción sólo está disponible si el bloque no está seleccionado como finalizado
                                if ($bloque_finalizado == 0) {
                                    //Las siguientes opciones sólo están disponibles para los alumnos
                                    if (isset($_SESSION['id_alumno'])) {
                                        ?>
                                        <button class="btn btn-primary" style="width:30%"
                                            onclick="subir_archivo('<?php echo $k->dec($bloque['BLOQUE']) ?>')">
                                            <?php echo "Subir archivo a " . $k->dec($bloque['BLOQUE']); ?>
                                        </button>
                                        <br>
                                        <br>
                                        <button class="btn btn-primary" style="width:30%; color:white; background-color: #64042C"
                                            onclick="bloque_finalizado('<?php echo $bloque['BLOQUE'] ?>', '<?php echo $id_proyecto ?>', 1)">Marcar
                                            como
                                            finalizado</button>
                                        <?php
                                    }
                                    if (isset($_SESSION['id_profesor'])) {
                                        ?>
                                        <p>Este bloque no ha sido marcado como finalizado. Aún no puede ser evaluado</p>
                                        <?php
                                    }
                                } else if ($bloque_finalizado == 1) {
                                    //La siguiente opción sólo está disponible si el bloque está seleccionado como finalizado
                                    if (isset($_SESSION['id_profesor'])) {
                                        //la siguiente opción se habilita solamente cuando el bloque ha sido seleccionado como terminado
                                        //la siguiente opción es para que el profesor agregue una calificación y retroalimentación al
                                        //bloque seleccionado del proyecto seleccionado                                        
                                        ?>
                                            <input type="hidden" name="id_profesor_calificador" id="id_profesor_calificador"
                                                value="<?php echo $_SESSION['id_profesor'] ?>">
                                            <h3>Profesor: Este bloque ha sido marcado como finalizado, esperando calificación</h3>
                                            <br><br>
                                            <button class="btn btn-primary" style="width:30%"
                                                onclick="evaluar_bloque('<?php echo $k->dec($bloque['BLOQUE']) ?>')">
                                                Agregar evaluación
                                            </button>
                                        <?php
                                    }
                                } else if ($bloque_finalizado == 2) {
                                    //La siguiente opción sólo está disponible si el bloque ya está calificado con 100
                                    ?>
                                            <h3>Este bloque tiene calificación de 100</h3>
                                    <?php

                                }

                                //--------------------------------------------------------------------------                                
                                ?>
                                <br>
                                <input class="invisible" type="file" name="upload_file" id="upload_file"
                                    accept=".zip,.rar,.pdf">
                                <input class="invisible" type="file" name="upload_file_2" id="upload_file_2" accept=".pdf">
                                <br>
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
                                            //para los archivos del proyecto del bloque seleccionado
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
                                                                data-target="#modal_visualizacion">Visualizar archivo</a>
                                                            <br><br>
                                                            <a href="./AJAX/archivos/descargar_archivo_ajax.php?id=<?php echo $archivo_proyecto['ID_ARCHIVO'] ?>)"
                                                                style="width: 100%;" class="btn btn-secondary">Descargar
                                                                archivo</a>
                                                            <br><br>
                                                            <?php
                                                            //Las acciones sólo están disponibles para los alumnos
                                                            if (isset($_SESSION['id_alumno']) && $bloque_finalizado != 2) {
                                                                if ($bloque_finalizado != 1) {
                                                                    ?>
                                                                    <a href="#" style="width: 100%;" class="btn btn-danger"
                                                                        onclick="eliminar_archivo('<?php echo $archivo_proyecto['ID_ARCHIVO'] ?>')">Eliminar
                                                                        archivo</a>
                                                                    <br><br>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

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
                                    <hr>
                                    <table class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th scope="col">Calificación profesor</th>
                                                <th scope="col">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                if (isset($calificacion_bloque_actual)) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $calificacion_bloque_actual ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (isset($fecha_calificacion_bloque)) ? $k->dec($fecha_calificacion_bloque) : '' ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                } else {
                                                    ?>
                                                <td>Aún no se ha calificado este bloque</td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th scope="col">Retroalimentación/Comentarios de profesor</th>
                                                <th>Fecha de comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $retroalimentacion = $obj_retroalimentacion->selectAllComentsByIDProyectoAndBloque($id_proyecto, $bloque_comentario_actual);
                                            if (!empty($retroalimentacion)) {
                                                foreach ($retroalimentacion as $comentario) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $k->dec($comentario['COMENTARIO']) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $k->dec($comentario['FECHA']) ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="2">Sin comentarios</td>
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
                    <?php
                    if ($calificacion_bloque_actual < 100) {
                        /*si se detecta que el bloque actual no tiene una calificación de 100
                        entonces se rompe el ciclo y ya no se muestran los siguientes bloques
                        */
                        break;
                    }
                }
                ?>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal_visualizacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visualización de archivo PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    En construcción...
                    </pp>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function evaluar_bloque(bloque) {
        $("#bloque").val(bloque)
        $("#modal_calificar_bloque").modal('show')
        $("#bloque").html("Evaluación para el bloque " + bloque)
    }
    function eliminar_archivo(id_archivo) {
        Swal.fire({
            title: 'Confirmar eliminación de archivo',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var data = {
                    id_archivo: id_archivo,
                };
                $.ajax({
                    url: 'AJAX/archivos/eliminar_archivo_ajax.php',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.result == 1) {
                            Swal.fire({
                                title: '¡Exito!',
                                text: 'El archivo ha sido eliminado',
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
    function bloque_finalizado(bloque, id_proyecto, opcion) {
        var data = {
            bloque: bloque,
            id_proyecto: id_proyecto,
        };
        $.ajax({
            url: 'AJAX/bitacora/consultar_bitacora_ajax.php',
            type: 'POST',
            data: data,
            success: function (response) {
                console.log(response);
                if (response != 1) {
                    Swal.fire({
                        title: '¡Aviso!, Primero se debe agregar el archivo de bitacora para el bloque',
                        confirmButtonText: 'Cargar archivo',
                        denyButtonText: 'Cancelar',
                        showDenyButton: true,
                        didOpen: () => {
                            const btnPdf1 = Swal.getPopup().querySelector('#btnPdf1');
                            const btnPdf2 = Swal.getPopup().querySelector('#btnPdf2');
                            btnPdf1.addEventListener('click', function () {
                                // Código para el botón PDF 1
                                window.open('Static/PDF/Bitacora_ejemplo_1.pdf', '_blank');
                            });
                            btnPdf2.addEventListener('click', function () {
                                // Código para el botón PDF 2
                                window.open('Static/PDF/Bitacora_ejemplo_2.pdf', '_blank');
                            });
                        },
                        html:
                            '<button id="btnPdf1" class="btn btn-secondary">Bitacora de muestra 1</button>' +
                            '<br><br>' +
                            '<button id="btnPdf2" class="btn btn-secondary">Bitacora de muestra 2</button>',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            subir_archivo_2(bloque);
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Si seleccionas el bloque como finalizado no podrás eliminar ni subir nuevos archivos. ¿Continuar? ',
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var data = {
                                bloque: bloque,
                                id_proyecto: id_proyecto,
                                opcion: opcion,
                            };
                            $.ajax({
                                url: 'AJAX/calificaciones/confirmar_calificacion.php',
                                type: 'POST',
                                data: data,
                                success: function (response) {
                                    console.log(response);
                                    if (response == 1) {
                                        Swal.fire({
                                            title: '¡Exito!',
                                            text: 'El bloque ha sido seleccionado como finalizado',
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
            },
            error: function (error) {

            }
        });


    }

    function subir_archivo(bloque) {
        bloqueVal = bloque;
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
            formData.append('bloque', bloqueVal);//Necesito que se pase la información del bloque aquí
            // Realizamos una llamada AJAX para enviar el archivo al servidor
            $.ajax({
                url: 'AJAX/archivos/registrar_archivo_ajax.php', // Ruta al archivo PHP que manejará la inserción en la base de datos
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
                    console.error(error);
                }
            });
        }
    });

    function subir_archivo_2(bloque) {
        bloqueVal = bloque;
        $("#upload_file_2").click();
    }

    $("#upload_file_2").on("change", function () {
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
            formData.append('bloque', bloqueVal);//Necesito que se pase la información del bloque aquí
            // Realizamos una llamada AJAX para enviar el archivo al servidor
            $.ajax({
                url: 'AJAX/bitacora/registrar_bitacora_ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,  // Evita que jQuery procese los datos
                contentType: false,  // Evita que jQuery configure el encabezado Content-Type
                success: function (response) {
                    if (response.result == 1) {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Bitacora agregada',
                            icon: 'success',
                        })
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

    function agregar_calificacion() {
        cal = $("#calificacion").val();
        com = $("#comentario");
        id_proyecto = $("#id_proyecto").val();
        bloque = $("#bloque").val();
        id_profesor = $("#id_profesor_calificador").val();
        var data = {
            cal: cal,
            id_proyecto: id_proyecto,
            bloque: bloque,
        };
        jQuery.ajax({
            url: "AJAX/calificaciones/agregar_calificacion_ajax.php",
            type: "POST",
            data: data,
            success: function (returned_data) {
                if (returned_data != 1) {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'No realizado, reintentar en unos minutos',
                        icon: 'error',
                    })
                } else {
                    if (!($.trim(com.val()) === '')) {
                        com = $("#comentario").val();
                        var data = {
                            id_proyecto: id_proyecto,
                            id_profesor: id_profesor,
                            com: com,
                            bloque: bloque,
                        };
                        jQuery.ajax({
                            url: "AJAX/comentarios/agregar_comentario_ajax.php",
                            type: "POST",
                            data: data,
                            success: function (response) {
                                if (response == 1) {
                                    Swal.fire({
                                        title: '¡Exito!',
                                        text: 'Calificación agregada',
                                        icon: 'success',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    console.log("Se ha encontrado un error al insertar el comentario: \n" + JSON.stringify(response) + "\n" + response);
                                }
                            },
                            error: function (response) {
                                console.log(JSON.stringify(response));
                            }
                        })
                    } else {
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Calificación agregada',
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }

                }
            },
            error: function (response) {
                console.log("Error encontrado en calificacion: " + response);
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal_calificar_bloque">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bloque"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align:center">
                <p class="card-text">
                    <input type="hidden" name="bloque" id="bloque">
                    CALIFICACIÓN<br><input style="width: 100%;" id="calificacion" name="calificacion" type="text"
                        placeholder="Agregar un número entero entre 0 y 100"><br><br>
                    RETROALIMENTACIÓN<br><textarea style="width: 100%;" name="comentario" id="comentario" cols="30"
                        rows="10"
                        placeholder="Agregar un comentario sobre el contenido del bloque. Este comentario es opcional"></textarea>
            </div>
            <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                <button type="button" class="btn btn-primary" onclick="agregar_calificacion()">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>