<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bloque = $_POST['bloque'];
    $id_proyecto = $_POST['id_proyecto'];
    $opcion = $_POST['opcion'];
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Calificacion_proyectos/Modificar_calificacion_proyectos.php");
    $obj = new Modificar_calificacion_proyectos();
    return $obj->updateProjectByIDAJAX($id_proyecto, $bloque, $opcion);
}