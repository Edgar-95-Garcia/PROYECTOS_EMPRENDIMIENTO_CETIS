<?php
class Borrar_sugerencia
{
    function deleteUSugerenciaFromId($id)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM sugerencias WHERE ID = '" . $id . "'");
            if ($stmt->execute())
                echo json_encode(array('result' => 1));
            else
            echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }        
    }
}
