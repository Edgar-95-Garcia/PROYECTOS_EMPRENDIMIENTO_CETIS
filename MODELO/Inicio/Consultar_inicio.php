<?php
class Consultar_inicio
{
    function selectInicio($titulo="+Q==", $texto="+Q==")
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM info_inicio WHERE TITULO != '" . $titulo . "' AND TEXTO != '" . $texto . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }

    function selectInicioPanel($titulo, $texto)
    {
        try {
            $result = "";
            require_once("./MODELO/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM info_inicio WHERE TITULO='" . $titulo . "' AND TEXTO= '" . $texto . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }
}
