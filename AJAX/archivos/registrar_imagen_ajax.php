<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
    $id_proyecto = $_POST['id'];
    $nombre_archivo = $_POST['nombre'];
    //---------------------------------
    $file_size = $_FILES['archivo']['size'];
    $file_type = $_FILES['archivo']['type'];
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/Imagen_proyectos/Insertar_imagen_proyecto.php");
    $obj_proyectos = new Insertar_imagen_proyecto();
    if (!isset($_SESSION['id'])) {
        session_start();
    }
    return $obj_proyectos->registro_imagen(array(null, $id_proyecto, $archivo, $k->enc(date("Y-m-d H:i:s"))));
}