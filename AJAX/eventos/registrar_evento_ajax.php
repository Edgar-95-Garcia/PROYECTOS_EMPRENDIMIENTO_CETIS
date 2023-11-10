<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    $descripcion = $_POST['descripcion'];

    if (!empty($id_usuario) && !empty($nombre) && !empty($inicio) && !empty($fin) && !empty($descripcion)) {
        if (strtotime($inicio) > strtotime($fin)) {
            return json_encode(array('result' => 3)); //Las fechas no son coherentes
        } else {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();
            include_once("../../MODELO/Eventos/Insertar_evento.php");
            $obj_proyectos = new Insertar_evento();
            return $obj_proyectos->registro_evento($id_usuario, $k->enc($nombre), $k->enc($inicio), $k->enc($fin), $k->enc($descripcion), $k->enc(date("Y-m-d H:i:s")));
        }
    } else {
        return json_encode(array('result' => 2)); //El formulario no está completamente relleno
    }
}