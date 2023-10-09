<?php
class Modificar_calificacion_proyectos
{
    function updateProjectByIDAJAX($id_proyecto, $bloque, $opcion)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE calificaciones_proyecto SET FINALIZADO = '" . ($opcion) . "' WHERE ID_PROYECTO = '" . $id_proyecto . "' AND BLOQUE = '$bloque'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
        }
        echo $coincidencia;
    }

    function updateCalificacionProjectByIDAJAX($id_proyecto, $bloque, $calificacion, $fecha)
    {
        try {
            if ($calificacion == 100)
                $finalizado = 2;
            else
                $finalizado = 0;

            include_once("../../MODELO/conect.php");
            $c = new conect();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE calificaciones_proyecto SET FINALIZADO = '$finalizado', FECHA = '$fecha', CALIFICACION = '" . ($calificacion) . "' WHERE ID_PROYECTO = '" . $id_proyecto . "' AND BLOQUE = '$bloque' AND FINALIZADO = 1");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
        }
        echo $coincidencia;
    }

}