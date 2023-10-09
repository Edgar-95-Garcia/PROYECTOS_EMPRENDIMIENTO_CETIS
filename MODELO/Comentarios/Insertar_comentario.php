<?php

class Insertar_comentario
{
    function registro_comentario($data)
    {
        $temp = 0;
        try {
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO retroalimentacion_bloque_proyecto(ID, ID_PROYECTO, BLOQUE, ID_PROFESOR, COMENTARIO, FECHA) VALUES (?,?,?,?,?,?)");
            if ($statementHandle->execute($data)) {
                $temp = 1;
            } else {
                $temp = 0;
            }
        } catch (PDOException $e) {
        }
        echo $temp;
    }
}