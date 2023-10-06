<?php

class Insertar_calificacion_proyectos
{
    function registro_precalificacion_proyecto($data)
    {
        $temp = 0;
        try {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO calificaciones_proyecto(ID, ID_PROYECTO, BLOQUE, TITULO, TEXTO, FINALIZADO, CALIFICACION) VALUES (?,?,?,?,?,?,?)");
            $statementHandle->execute($data);
        } catch (PDOException $e) {
        }
        return $temp;
    }
}