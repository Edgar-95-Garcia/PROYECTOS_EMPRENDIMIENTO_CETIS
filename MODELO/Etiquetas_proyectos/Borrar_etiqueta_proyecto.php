<?php
class Borrar_etiqueta_proyecto
{
    function deleteEtiquetaFromIdAJAX($id_proyecto)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM etiqueta_has_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();            
        } catch (PDOException $e) {            
        }        
    }
}
