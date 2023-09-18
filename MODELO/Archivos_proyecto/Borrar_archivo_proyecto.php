<?php
class Borrar_archivo_proyecto
{
    function deleteUsuarioFromIdUsuario($id_usuario)
    {
        try {            
            include_once("../../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM usuarios WHERE ID_USUARIO = '" . $id_usuario . "'");
            if ($stmt->execute())
                echo json_encode(array('result' => 1));
            else
            echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }        
    }
}
