<?php
class Consultar_evento
{
    function selectAllEventos()
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM eventos");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}