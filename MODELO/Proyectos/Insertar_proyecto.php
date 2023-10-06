<?php

class Insertar_proyecto
{
    function registro_proyecto($id_uusario, $nombre, $descripcion, $fecha)
    {
        $temp = 0;
        try {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();

            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO proyectos(ID_PROYECTO,ID_USUARIO,NOMBRE_PROYECTO, DESCRIPCION, FECHA_MODIFICACION) VALUES (?,?,?,?,?)");
            if ($statementHandle->execute(array(null, $id_uusario, $nombre, $descripcion, $fecha))) {
                include_once("../../MODELO/Proyectos/Consultar_proyecto.php");
                $obj_proyectos = new Consultar_proyecto();
                $datos_proyecto = $obj_proyectos->selectProjectbyNameAndDesc($nombre, $descripcion);
                $id_proyecto = $datos_proyecto[0][0];
                include_once("../../MODELO/Calificacion_proyectos/Insertar_calificacion_proyectos.php");
                $obj_calificacion = new Insertar_calificacion_proyectos();
                $obj_calificacion->registro_precalificacion_proyecto(array(null, $id_proyecto, $k->enc("Bloque I"), $k->enc('Introducción, planteamiento del problema y Justificación'), null, 0, 0));
                $obj_calificacion->registro_precalificacion_proyecto(array(null, $id_proyecto, $k->enc("Bloque II"), $k->enc('Objetivo general, Objetivos específicos, Misión y Visión'), null, 0, 0));
                $obj_calificacion->registro_precalificacion_proyecto(array(null, $id_proyecto, $k->enc("Bloque III"), $k->enc('Marco teórico'), null, 0, 0));
                $obj_calificacion->registro_precalificacion_proyecto(array(null, $id_proyecto, $k->enc("Bloque IV"), $k->enc('Desarrollo del proyecto'), null, 0, 0));
                $obj_calificacion->registro_precalificacion_proyecto(array(null, $id_proyecto, $k->enc("Bloque V"), $k->enc('Conclusiónes, Bibliografía y Anexos'), null, 0, 0));

                echo json_encode(array('result' => 1));
            } else
                echo json_encode(array('result' => 0));

        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
        return $temp;
    }
}