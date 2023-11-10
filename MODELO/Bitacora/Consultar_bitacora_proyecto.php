<?php
class Consultar_bitacora_proyecto
{
    function selectBitacoraProjectByIDAndBloque($id_proyecto, $bloque)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT BITACORA FROM calificaciones_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "' AND BLOQUE = '$bloque'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}