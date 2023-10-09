<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_proyecto = $_POST['id_proyecto'];
    $id_profesor = $_POST['id_profesor'];
    $com = $_POST['com'];
    $bloque = $_POST['bloque'];
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Comentarios/Insertar_comentario.php");
    $obj = new Insertar_comentario();
    return $obj->registro_comentario(array(null, $id_proyecto, $k->enc($bloque), $id_proyecto, $k->enc($com), $k->enc(date("Y-m-d H:i:s"))));
}