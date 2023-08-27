<?php
class Borrar_usuario
{
    function deleteUsuarioFromIdUsuario($id_usuario)
    {
        try {
            $result = "";
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM usuarios WHERE ID_USUARIO = '" . $id_usuario . "'");
            if ($stmt->execute())
                $result = 1;
            else
                $result = 0;
        } catch (PDOException $e) {
        }
        return $result;
    }
}
