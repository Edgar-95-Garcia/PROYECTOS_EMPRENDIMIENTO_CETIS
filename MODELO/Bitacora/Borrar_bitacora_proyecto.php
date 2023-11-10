<?php
class Borrar_bitacora_proyecto
{
    function deleteFileFromIdProyectoAJAX($id)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM archivos_proyectos WHERE ID_PROYECTO = '" . $id . "'");
            $stmt->execute();
        } catch (PDOException $e) {
        }
    }

    function deleteFileFromIdFileAJAX($id)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM archivos_proyectos WHERE ID_ARCHIVO = '" . $id . "'");
            if ($stmt->execute())
                echo json_encode(array('result' => 1));
            else
                echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
    }
}