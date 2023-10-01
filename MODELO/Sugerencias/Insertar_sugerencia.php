<?php
class Insertar_sugerencia
{
    function add_sug($datos)
    {
        $temp = 0;
        try {                        
            include_once("./MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO sugerencias(ID, ID_USUARIO, TEXTO, FECHA) VALUES (?,?,?,?)");
            $statementHandle->execute($datos);
            $temp = 1; #todo ha sido correcto
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error generalmente error al envíar el mensaje de activación
        }
        return $temp;
    }
}
