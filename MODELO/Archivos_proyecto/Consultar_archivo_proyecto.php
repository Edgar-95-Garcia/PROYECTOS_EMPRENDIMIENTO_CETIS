<?php
class Consultar_archivo_proyecto
{
    function selectFileProyectByIDAndBloque($id_proyecto, $bloque)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM archivos_proyectos WHERE ID_PROYECTO = '" . $id_proyecto . "' AND BLOQUE = '$bloque'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectFileByID($id_archivo)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM archivos_proyectos WHERE ID_ARCHIVO = '" . $id_archivo . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}