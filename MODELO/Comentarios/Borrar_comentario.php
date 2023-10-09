<?php
class Borrar_comentario
{
    function deleteComentarioFromIdAJAX($id_proyecto)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM retroalimentacion_bloque_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();            
        } catch (PDOException $e) {            
        }        
    }
}
