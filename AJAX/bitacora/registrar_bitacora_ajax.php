<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
    $id_proyecto = $_POST['id'];
    $bloque = $_POST['bloque'];
    $nombre_archivo = $_POST['nombre'];
    //---------------------------------
    $file_size = $_FILES['archivo']['size'];
    $file_type = $_FILES['archivo']['type'];

    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Bitacora/Insertar_bitacora_proyecto.php");
    $obj_proyectos = new Insertar_bitacora_proyecto();
    if (!isset($_SESSION['id'])) {
        session_start();
    }
    return $obj_proyectos->registro_bitacora($archivo, $id_proyecto, $bloque);
}