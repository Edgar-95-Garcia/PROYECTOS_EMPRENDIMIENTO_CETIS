<?php

class Insertar_participante_proyecto
{
    function insertParticipanteProyectoAJAX($data)
    {
        try {
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO participante_proyecto (ID, ID_PROYECTO, TIPO_USUARIO, ID_USUARIO, FECHA_MODIFICACION) VALUES (?,?,?,?,?)");
            if ($statementHandle->execute($data))
                echo json_encode(array('result' => 1));
            else
                echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }        
    }
}