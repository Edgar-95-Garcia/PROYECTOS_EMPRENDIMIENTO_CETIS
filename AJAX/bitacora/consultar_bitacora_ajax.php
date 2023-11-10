<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bloque = $_POST['bloque'];
    $id_proyecto = $_POST['id_proyecto'];
    //---------------------------------    
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    include_once("../../MODELO/Bitacora/Consultar_bitacora_proyecto.php");
    $obj_proyectos = new Consultar_bitacora_proyecto();
    $bitacora = $obj_proyectos->selectBitacoraProjectByIDAndBloque($id_proyecto, $bloque);
    if (!empty($bitacora[0][0]) && ($bitacora[0][0] != null))
        echo 1;
    else
        echo 0;
}