<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Proyectos/Modificar_proyecto.php");
    $obj_proyectos = new Modificar_proyecto();
    if (!isset($_SESSION['id'])) {
        session_start();
    }
    echo json_encode(array('result' => $obj_proyectos->updateProjectByID($nombre, $descripcion, $id)));
}