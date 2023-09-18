<?php
class Consultar_proyecto
{
    function selectAllProjects()
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM proyectos");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAllProjectsbyIdUser($id_usuario)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM proyectos where ID_USUARIO = '" . $id_usuario . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectProjectbyId($id_proyecto)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM proyectos where ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectProjectbyName($nombre_proyecto)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM proyectos WHERE `NOMBRE_PROYECTO` like '%$nombre_proyecto%'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectProjectbyTags($etiquetas)
    {
        try {
            $where = "";
            $sql = "SELECT DISTINCT proyectos.* FROM proyectos LEFT JOIN etiqueta_has_proyecto ON proyectos.ID_PROYECTO = etiqueta_has_proyecto.ID_PROYECTO";
            $contador = 0;
            foreach ($etiquetas as $etiqueta_individual) {
                $contador++;
                if (isset($etiquetas[$contador])) {
                    $or = " OR";
                } else {
                    $or = "";
                }
                $where .= " etiqueta_has_proyecto.ID_ETIQUETA = $etiqueta_individual" . $or;
            }            

            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("$sql WHERE $where");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectProjectbyNameAndTag($nombre_proyecto, $etiquetas_proyecto)
    {
        try {
            $and = "";
            $sql = "SELECT DISTINCT proyectos.* FROM proyectos LEFT JOIN etiqueta_has_proyecto ON proyectos.ID_PROYECTO = etiqueta_has_proyecto.ID_PROYECTO WHERE `NOMBRE_PROYECTO` like";
            $contador = 0;
            foreach ($etiquetas_proyecto as $etiqueta_individual) {
                $contador++;
                if (isset($etiquetas_proyecto[$contador])) {
                    $or = " OR ";
                } else {
                    $or = "";
                }
                $and .= " etiqueta_has_proyecto.ID_ETIQUETA = $etiqueta_individual" . " ".$or;
            }
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("$sql '%$nombre_proyecto%' AND (" . $and.")");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}