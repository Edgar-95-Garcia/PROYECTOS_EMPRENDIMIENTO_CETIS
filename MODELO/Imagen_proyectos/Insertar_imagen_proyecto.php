<?php

class Insertar_imagen_proyecto
{
    function registro_imagen($data)
    {
        try {
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO imagen_proyectos(ID_IMAGEN, ID_PROYECTO, IMAGEN, FECHA_MODIFICACION) VALUES (?,?,?,?)");
            $statementHandle->execute($data);
            echo json_encode(array('result' => 1));

        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
    }
    
}