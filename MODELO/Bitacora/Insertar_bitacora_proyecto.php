<?php
class Insertar_bitacora_proyecto
{
    function registro_bitacora($archivo, $id_proyecto, $bloque)
    {
        $temp = 0;
        try {
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            include_once("../../MODELO/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("UPDATE calificaciones_proyecto SET BITACORA = :archivo WHERE ID_PROYECTO = :id_proyecto AND BLOQUE = :bloque");
            
            $statementHandle->bindParam(':archivo', $archivo, PDO::PARAM_STR);
            $statementHandle->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
            $statementHandle->bindParam(':bloque', $bloque, PDO::PARAM_STR);
            
            $statementHandle->execute();
            if ($statementHandle->rowCount() > 0) {
                echo json_encode(array('result' => 1));
            } else {
                echo json_encode(array('result' => 0));
            }
        } catch (PDOException $e) {
        }
    }
}