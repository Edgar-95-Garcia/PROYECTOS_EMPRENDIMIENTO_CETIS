<?php

class Insertar_evento
{
    function registro_evento($id_uusario, $nombre, $inicio, $fin, $descripcion, $fecha)
    {
        $temp = 0;
        try {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();

            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO eventos(ID, NOMBRE, FECHA_INICIO, FECHA_FIN, DESCRIPCION, ID_USUARIO, FECHA_MODIFICACION) VALUES (?,?,?,?,?,?,?)");
            if ($statementHandle->execute(array(null, $nombre, $inicio, $fin, $descripcion, $id_uusario, $fecha))) {
                echo json_encode(array('result' => 1));
            } else
                echo json_encode(array('result' => 0));

        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
        return $temp;
    }
}