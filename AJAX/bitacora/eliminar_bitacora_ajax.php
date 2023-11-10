<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_archivo = $_POST['id_archivo'];
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Archivos_proyecto/Borrar_archivo_proyecto.php");
    $obj_archivo_proyectos = new Borrar_archivo_proyecto();
    echo $obj_archivo_proyectos->deleteFileFromIdFileAJAX($id_archivo);
}