<?php
class Borrar_participante_proyecto
{
    function deleteParticipanteProjectFromId($id_proyecto)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM participante_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();
        } catch (PDOException $e) {
        }
    }
}