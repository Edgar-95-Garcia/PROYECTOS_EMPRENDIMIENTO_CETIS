<?php
class Insertar_aud
{
    function add_aud($datos)
    {
        $temp = 0;
        try {                        
            include_once("./MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO aud(ID, ID_USUARIO, OPERACION, FECHA) VALUES (?,?,?,?)");
            $statementHandle->execute($datos);
            $temp = 1; #todo ha sido correcto
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error generalmente error al envíar el mensaje de activación
        }
        return $temp;
    }
}
