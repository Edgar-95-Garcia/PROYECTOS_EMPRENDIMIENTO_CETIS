<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Proyectos/Insertar_proyecto.php");
    $obj_proyectos = new Insertar_proyecto();
    if(!isset($_SESSION['id'])){
        session_start();
    }
    return $obj_proyectos->registro_usuario(array(null, $_SESSION['id'], $k->enc($nombre), $k->enc($descripcion), $k->enc(date("Y-m-d H:i:s"))));

}