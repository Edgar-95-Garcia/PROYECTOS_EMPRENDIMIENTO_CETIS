<?php

class Insertar_proyecto
{
    function registro_usuario($data)
    {
        $temp = 0;
        try {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../Modelo/conect.php");
            $mysql_object = new conect();

            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO proyectos(ID_PROYECTO,ID_USUARIO,NOMBRE_PROYECTO, DESCRIPCION, FECHA_MODIFICACION) VALUES (?,?,?,?,?)");
            if ($statementHandle->execute($data))
                echo json_encode(array('result' => 1));
            else
            echo json_encode(array('result' => 0));

        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
        return $temp;
    }
}