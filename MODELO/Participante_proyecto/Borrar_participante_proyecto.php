<?php
class Borrar_participante_proyecto
{
    function deleteParticipanteProjectFromId($id_proyecto)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM participante_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            if ($stmt->execute())
                echo json_encode(array('result' => 1));
            else
            echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }        
    }
}
