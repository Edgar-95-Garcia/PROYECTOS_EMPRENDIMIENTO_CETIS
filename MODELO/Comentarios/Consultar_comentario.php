<?php
class Consultar_comentario
{
    function selectAllComentsByIDProyectoAndBloque($id_proyecto, $bloque)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM retroalimentacion_bloque_proyecto WHERE ID_PROYECTO = '$id_proyecto' AND BLOQUE = '$bloque'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

}