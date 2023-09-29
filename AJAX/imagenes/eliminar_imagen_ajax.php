<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Imagen_proyectos/Borrar_imagen_proyecto.php");
    $obj_proyectos = new Borrar_imagen_proyecto();
    echo $obj_proyectos->deleteImageAjax($id);

}