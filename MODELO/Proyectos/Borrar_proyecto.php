<?php
class Borrar_proyecto
{
    function deleteUsuarioFromId($id_proyecto)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM proyectos WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            if ($stmt->execute()) {
                //se eliminan todos los archivos del proyecto
                include_once("../../MODELO/Archivos_proyecto/Borrar_archivo_proyecto.php");
                $obj = new Borrar_archivo_proyecto();
                $obj->deleteFileFromIdProyectoAJAX($id_proyecto);
                //se eliminan todas las calificaciones del proyecto
                include_once("../../MODELO/Calificacion_proyectos/Borrar_calificacion_proyectos.php");
                $obj = new Borrar_calificacion_proyectos();
                $obj->deleteCalificacionFromIdAJAX($id_proyecto);
                //se eliminan todas las etiquetas del proyecto
                include_once("../../MODELO/Etiquetas_proyectos/Borrar_etiqueta_proyecto.php");
                $obj = new Borrar_etiqueta_proyecto();
                $obj->deleteEtiquetaFromIdAJAX($id_proyecto);
                //se eliminan todas las imagenes del proyecto
                include_once("../../MODELO/Imagen_proyectos/Borrar_imagen_proyecto.php");
                $obj = new Borrar_imagen_proyecto();
                $obj->deleteImagenFromIdAJAX($id_proyecto);
                //se eliminan todos los participantes del proyecto
                include_once("../../MODELO/Participante_proyecto/Borrar_participante_proyecto.php");
                $obj = new Borrar_participante_proyecto();
                $obj->deleteParticipanteProjectFromId($id_proyecto);
                //se eliminan todos los comentarios del proyecto
                include_once("../../MODELO/Comentarios/Borrar_comentario.php");
                $obj = new Borrar_comentario();
                $obj->deleteComentarioFromIdAJAX($id_proyecto);
                //------------------------------------------
                echo json_encode(array('result' => 1));
            } else
                echo json_encode(array('result' => 0));
        } catch (PDOException $e) {
            echo json_encode(array('result' => 0));
        }
    }
}