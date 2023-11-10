<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Eventos/Borrar_evento.php");
    $obj_eventos = new Borrar_evento();
    echo $obj_eventos->deleteEventoFromId($id);
}