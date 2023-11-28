<?php
$GLOBALS['menu'] = 'PROYECTOS';

if (!isset($_SESSION)) {
    session_start();
}

include_once("./cabecera.php");
include_once("./CONTROLADOR/key.php");
$k = new key();
include_once("./MODELO/Imagen_proyectos/Consultar_imagen_proyecto.php");
$obj_imagen_proyectos = new Consultar_imagen_proyecto();
include_once("./MODELO/Etiquetas_proyectos/Consultar_etiqueta_proyecto.php");
$obj_etiquetas = new Consultar_etiqueta_proyecto();
?>
<center>
    <br><br>
    <h2>PROTOTIPOS</h2>
    <hr class="red">
    <br><br>
</center>

<div>
    <center>
        <img class="img_prototipos" src="./Static/images/prototipos.jpeg" alt="">
    </center>
</div>
<br>
<?php
include_once("./pie.php");
?>

<style>
    @media (orientation: landscape) {
        .img_prototipos {
            width: 70%;
        }
    }

    @media (orientation: portrait) {
        .img_prototipos {
            width: 95%;
        }
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