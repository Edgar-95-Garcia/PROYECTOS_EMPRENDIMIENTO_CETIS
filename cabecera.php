<?php
date_default_timezone_set("America/Mexico_City");
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($GLOBALS['menu'])) {
    $GLOBALS['menu'] = 'index';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CETIS UNO - Gestiòn proyectos</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="./Static/CSS/style.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- /-->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.js"> </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.min.js"> </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.css" />
    <!-- /-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- /-->
    <!-- Calendario -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.css' />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>

</head>

<body>
    <?php
    include_once("./CONTROLADOR/key.php");
    $k = new key();
    include_once("./MODELO/Apariencia/Consultar_apariencia.php");
    $obj_apariencia = new Consultar_apariencia();
    $datos_apariencia = $obj_apariencia->selectApariencia();
    if (isset($datos_apariencia) && $datos_apariencia != false) {
        foreach ($datos_apariencia as $datos) {
            if ($datos['TIPO'] == "Q30FAqd/xMnj") {
                $color_menu = $datos['VALOR'];
            }
            if ($datos['TIPO'] == "Q30FAqdmxN/iR01oTwI=") {
                $color_menu_texto = $datos['VALOR'];
            }
            if ($datos['TIPO'] == "Q30FAqd0zsnyR1N4URJBajOO") {
                $color_menu_fondo_superior = $datos['VALOR'];
            }
        }
    } else {
        $color_menu = $k->enc("#0f195d");
        $color_menu_texto = $k->enc("#0f195d");
        $color_menu_fondo_superior = $k->enc("#0f195d");
    }

    ?>
    <div style="background-color: <?php echo $k->dec($color_menu_fondo_superior) ?>">
        <br>
        <center>
            <img class="img_media_1" src="./Static/images/logo_dgeti.png">

            <img class="img_media_2" src="./Static/images/LOGO-SEP.png">
        </center>
        <br>
    </div>
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark" aling="center"
        style="background-color:<?php echo $k->dec($color_menu) ?>; font-size:large;font-family:Montserrat Black; font-size:19px;">
        <a class="navbar-brand" href="./index.php"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#colNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="colNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" aling="center" href="./index.php">Inicio</a>
                </li>
                <!--  LOS SIGUIENTES ELEMENTOS SE ENCUENTRAN OCULTOS PARA SU FUTURA IMPLEMENTACION -->
                <!-- <li class="nav-item <?php // echo ($GLOBALS['menu'] == 'CURSOS') ? 'active' : ''; ?>">
                    <a class="nav-link" aling="center" href="./#">Cursos</a>
                </li>
                <li class="nav-item <?php // echo ($GLOBALS['menu'] == 'PROTOTIPO') ? 'active' : ''; ?>">
                    <a class="nav-link" aling="center" href="./#">Prototipos</a>
                </li> -->
                <!--  FIN DE ELEMENTOS OCULTOS-->
                <li class="nav-item dropdown <?php echo ($GLOBALS['menu'] == 'EVENTOS') ? 'active' : ''; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Eventos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" aling="center" href="eventos.php">
                            Explorar eventos</a>
                        <a class="dropdown-item" aling="center" href="#">
                            Convocatorias</a>

                        <?php
                        if (isset($_SESSION['admin_cetis'])) { //Esta opción se habilita siempre y cuando el usuario sea de tipo administrador
                            ?>
                            <a class="dropdown-item" aling="center" href="./admon_eventos.php">
                                Administrar eventos</a>
                            <?php
                        }
                        if (isset($_SESSION['admin_cetis']) || isset($_SESSION['id_profesor'])) {
                            ?>
                            <a class="dropdown-item" aling="center" href="" data-toggle="modal"
                                data-target="#modal_eventos">
                                Crear nuevo evento</a>
                            <?php
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown <?php echo ($GLOBALS['menu'] == 'PROYECTOS') ? 'active' : ''; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Proyectos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" aling="center" href="./proyectos_emprendimiento.php">
                            Emprendimiento
                        </a>
                        <a class="dropdown-item" aling="center" href="./proyectos_prototipos.php">
                            Prototipos
                        </a>
                        <?php if (isset($_SESSION['id_alumno']) || isset($_SESSION['id_profesor'])) { //Esta opción se habilita siempre y cuando el usuario ingrese correctamente
                                ?>
                            <a class="dropdown-item" aling="center" href="./portafolio_proyectos_emprendimiento.php"> Mis
                                proyectos</a>
                            <?php
                            } ?>
                        <?php if (isset($_SESSION['admin_cetis'])) { //Esta opción se habilita siempre y cuando el usuario sea de tipo administrador
                                ?>
                            <a class="dropdown-item" aling="center" href="./proyectos_emprendimiento_etiquetas.php">
                                Administrar etiquetas</a>
                            <a class="dropdown-item" aling="center" href="" data-toggle="modal" data-target="#modal"> Crear
                                nuevo proyecto</a>
                            <?php
                            } ?>
                    </div>
                </li>
                <li class="nav-item <?php echo ($GLOBALS['menu'] == 'ENTRAR') ? 'active' : ''; ?>">
                    <?php
                    if (!isset($_SESSION["user"])) {
                        echo '<a class="nav-link" href="./login.php">Entrar</a>';
                    }
                    ?>
                </li>
                <li class="nav-item <?php echo ($GLOBALS['menu'] == 'registro') ? 'active' : ''; ?>">
                    <?php
                    if (isset($_SESSION['admin_cetis'])) {

                    }
                    ?>
                </li>
                <?php
                if (isset($_SESSION["admin_cetis"])) {
                    ?>
                    <li class="nav-item dropdown <?php echo ($GLOBALS['menu'] == 'admon') ? 'active' : ''; ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Administrar usuarios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" aling="center" href="./register.php">Registrar usuario</a>
                            <a class="dropdown-item" aling="center" href="./admon_super_user.php">Administrar
                                usuarios administrador</a>
                            <a class="dropdown-item" aling="center" href="./admon_profesores.php">Administrar
                                profesores</a>
                            <a class="dropdown-item" aling="center" href="./admon_alumnos.php">Administrar
                                alumnos</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
                <?php
                if (isset($_SESSION["admin_cetis"])) {
                    ?>
                    <li class="nav-item dropdown <?php echo ($GLOBALS['menu'] == 'reportes') ? 'active' : ''; ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Reportes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" aling="center" href="./admon_sugerencias.php">Sugerencias</a>
                            <a class="dropdown-item" aling="center" href="./reporte_ingresos.php">Reporte inicios de
                                sesión</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <?php
                    if (isset($_SESSION["user"]) || isset($_SESSION["admin_cetis"])) {
                        echo '<a class="nav-link" href="index.php?t=0">Cerrar sesión</a>';
                    }
                    ?>
                </li>

                <li>
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<a class="nav-link">BIENVENIDO ' . $_SESSION['nombre'] . '</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
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
                        NOMBRE DEL PROYECTO<br><input id="nombre_registro" name="nombre_registro" type="text"> <br><br>
                        DESCRIPCIÓN DEL PROYECTO<br><textarea id="descripcion_registro" name="descripcion_registro"
                            cols="23" rows="5"></textarea><br><br>
                </div>
                <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                    <button type="button" class="btn btn-primary" onclick="registrar_proyecto()">Aceptar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_eventos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center">
                    <p class="card-text">
                        NOMBRE DEL EVENTO<br><input id="nombre_evento" name="nombre_evento" type="text"> <br><br>
                        DESCRIPCIÓN DEL EVENTO<br><textarea id="descripcion_evento" name="descripcion_evento" cols="23"
                            rows="5"></textarea><br><br>
                        FECHA DE INICIO DEL EVENTO<br><input type="date" name="inicio_evento"
                            id="inicio_evento"><br><br>
                        FECHA DE FIN DEL EVENTO<br><input type="date" name="fin_evento" id="fin_evento"><br><br>
                </div>
                <div class="modal-footer" style="display: flex; align-items: center; justify-content: center;">
                    <button type="button" class="btn btn-primary"
                        onclick="registrar_evento('<?php echo obtener_id() ?>')">Aceptar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    function obtener_id()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['admin_cetis'])) {
            return $_SESSION['admin_cetis'];
        } else if (isset($_SESSION['id_profesor'])) {
            return $_SESSION['id_profesor'];
        } else {
            return $_SESSION['id_alumno'];
        }
    }
    ?>
    <script>
        function registrar_evento(id_usuario) {
            nombre = $("#nombre_evento").val();
            inicio = $("#inicio_evento").val();
            fin = $("#fin_evento").val();
            descripcion = $("#descripcion_evento").val();

            var data = {
                id_usuario: id_usuario,
                nombre: nombre,
                inicio: inicio,
                fin: fin,
                descripcion: descripcion,
            };

            jQuery.ajax({
                url: "AJAX/eventos/registrar_evento_ajax.php",
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
                    } else if (data.result == 2) {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'No realizado, rellenar los campos solicitados',
                            icon: 'error',
                        })
                    } else if (data.result == 3) {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'No realizado, revisar las fechas ingresadas',
                            icon: 'error',
                        })
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'No realizado, reintente en unos minutos',
                            icon: 'error',
                        })
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        function registrar_proyecto() {
            nombre = $("#nombre_registro").val();
            descripcion = $("#descripcion_registro").val();
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

    </script>
    <style>
        .dropdown-menu {
            background-color: #64042C;
        }

        .dropdown-item {
            color: white;
        }

        @media (orientation: landscape) {
            .img_media_1 {
                background-color: white;
                position: relative;
                left: 30%;
                width: 300px;
                height: 100px;
            }

            .img_media_2 {
                background-color: white;
                position: relative;
                right: 30%;
                width: 300px;
                height: 100px;
            }
        }

        @media (orientation: portrait) {
            .img_media_1 {
                background-color: white;
                width: 150px;
                height: 60px;
            }

            .img_media_2 {
                background-color: white;
                width: 150px;
                height: 60px;
            }

        }
    </style>