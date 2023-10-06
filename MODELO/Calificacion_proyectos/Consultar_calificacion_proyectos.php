<?php
class Consultar_calificacion_proyectos
{
    function selectAllCalificacionByIDProyectoAndBloque($id_proyecto, $bloque)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT FINALIZADO FROM calificaciones_proyecto WHERE ID_PROYECTO = '$id_proyecto' AND BLOQUE = '$bloque'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAllByIdProyecto($id_proyecto)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM calificaciones_proyecto WHERE ID_PROYECTO = '$id_proyecto' ORDER BY BLOQUE ASC");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}