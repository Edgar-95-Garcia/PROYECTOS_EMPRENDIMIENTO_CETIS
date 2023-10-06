<?php
class Borrar_imagen_proyecto
{
    function deleteImageAjax($id_imagen)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM imagen_proyectos WHERE ID_IMAGEN = '" . $id_imagen . "'");
            if ($stmt->execute())
                echo json_encode(array('result' => 1));
            else
            echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }        
    }

    function deleteImagenFromIdAJAX($id_proyecto)
    {
        try {            
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM imagen_proyectos WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();            
        } catch (PDOException $e) {            
        }        
    }
}
