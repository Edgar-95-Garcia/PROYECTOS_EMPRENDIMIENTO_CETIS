<?php
class Consultar_participante_proyecto
{
    function selectParticipanteProjectbyIdAJAX($id_proyecto, $tipo)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT COUNT(*) FROM participante_proyecto where ID_PROYECTO = '" . $id_proyecto . "' AND TIPO_USUARIO = '" . $tipo . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectDataParticipanteProjectbyIdAJAX($id_proyecto, $tipo)
    {
        try {
            $result = "";
            require_once("../../MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM participante_proyecto where ID_PROYECTO = '" . $id_proyecto . "' AND TIPO_USUARIO = '" . $tipo . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAllParticipanteProjectbyId($id_proyecto)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM participante_proyecto where ID_PROYECTO = '" . $id_proyecto . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectDataParticipanteProjectbyId($id_usuario)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM participante_proyecto where ID_USUARIO  = '" . $id_usuario . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

}