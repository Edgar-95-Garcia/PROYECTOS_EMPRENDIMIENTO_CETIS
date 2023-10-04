<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Proyectos/Borrar_proyecto.php");
    $obj_proyectos = new Borrar_proyecto();
    echo $obj_proyectos->deleteUsuarioFromId($id);

}