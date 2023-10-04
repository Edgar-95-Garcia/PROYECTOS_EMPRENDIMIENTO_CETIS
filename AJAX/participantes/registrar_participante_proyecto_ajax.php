<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_proyecto = $_POST['id_proyecto'];
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Participante_proyecto/Insertar_participante_proyecto.php");
    $obj_participante_proyectos = new Insertar_participante_proyecto();
    return $obj_participante_proyectos->insertParticipanteProyectoAJAX(array(null, $id_proyecto, $tipo_usuario , $id_usuario, $k->enc(date("Y-m-d H:i:s"))));
}