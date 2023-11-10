<?php
class Borrar_evento
{
    function deleteEventoFromId($id)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM eventos WHERE ID = '" . $id. "'");
            if ($stmt->execute()) {                
                echo json_encode(array('result' => 1));
            } else
                echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
    }
}