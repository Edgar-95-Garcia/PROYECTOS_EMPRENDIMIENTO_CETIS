<?php
class Consultar_etiqueta_proyecto
{
    function selectAllTags()
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM etiquetas");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
    function selectTagById($id_etiqueta)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM etiquetas where ID_ETIQUETA = '" . $id_etiqueta . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
    function selectTagByIdNoAjax($id_etiqueta)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM etiquetas where ID_ETIQUETA = '" . $id_etiqueta . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
    function selectAllTagsProject($id_proyecto)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM etiqueta_has_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAllTagsProjectNoAjax($id_proyecto)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM etiqueta_has_proyecto WHERE ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectNORTagsProjectAjax($id_proyecto)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * from etiquetas e WHERE NOT EXISTS (SELECT * FROM etiqueta_has_proyecto p WHERE p.ID_ETIQUETA = e.ID_ETIQUETA AND p.ID_PROYECTO = '" . $id_proyecto . "')");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}