<?php
class Modificar_proyecto
{
    function updateProjectByID($nombre, $descripcion, $id_proyecto)
    {        
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            $coincidencia = 0;
            $fecha = date("Y-m-d H:i:s");
            $stmt = $c->connect()->prepare("UPDATE proyectos SET NOMBRE_PROYECTO = '" . $k->enc($nombre) . "' , FECHA_MODIFICACION = '" . $k->enc($fecha) . "', DESCRIPCION = '" . $k->enc($descripcion) . "'  WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
        }
        return $coincidencia;
    }

}