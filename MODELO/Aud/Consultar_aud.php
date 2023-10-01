<?php
class Consultar_aud
{
    function selectAud()
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM aud");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }
}
