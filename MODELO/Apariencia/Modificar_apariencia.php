<?php
class Modificar_apariencia
{
    function updateColorMenu($value, $tipo)
    {
        try {
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE config SET VALOR = '" . $k->enc($value) . "' WHERE TIPO = '" . $k->enc($tipo) . "'");
            //`o8V9FikNS/0amrwqdQ==` WHERE `sOtAIxclbMs=` = "kuqVH4OdQTd+f3zhUXqEIsZN"
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
            echo $e;
        }
        return $coincidencia;
    }
}
