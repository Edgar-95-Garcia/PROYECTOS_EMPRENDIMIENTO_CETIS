<?php

class Insertar_archivo_proyecto
{
    function registro_archivo($data)
    {
        $temp = 0;
        try {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();

            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO archivos_proyectos(ID_ARCHIVO, ID_PROYECTO, NOMBRE_ARCHIVO,TIPO_ARCHIVO,SIZE_ARCHIVO,ARCHIVO, FECHA_SUBIDA) VALUES (?,?,?,?,?,?,?)");
            $statementHandle->execute($data);
            echo json_encode(array('result' => 1));

        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
    }
}