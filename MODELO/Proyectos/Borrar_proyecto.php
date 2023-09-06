<?php
class Borrar_proyecto
{
    function deleteUsuarioFromId($id_proyecto)
    {
        try {            
            include_once("../../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM proyectos WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            if ($stmt->execute())
                echo json_encode(array('result' => 1));
            else
            echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }        
    }
}
