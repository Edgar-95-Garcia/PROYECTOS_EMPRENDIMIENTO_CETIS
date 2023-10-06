<?php
class Borrar_calificacion_proyectos
{
    function deleteCalificacionFromIdAJAX($id_proyecto)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM calificaciones_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();            
        } catch (PDOException $e) {            
        }        
    }
}
