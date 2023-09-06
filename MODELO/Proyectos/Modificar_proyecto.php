<?php
class Modificar_proyecto
{
    function updateProfesor($nombre, $a_paterno, $a_materno, $correo, $pass, $estatus, $level, $id_usuario)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE usuarios SET NOMBRE = '" . $k->enc($nombre) . "' , APELLIDO_P = '" . $k->enc($a_paterno) . "' ,APELLIDO_M = '" . $k->enc($a_materno) . "' ,CORREO ='" . $k->enc($correo) . "' ,PASS = '" . $k->enc($pass) . "' ,STATUS = '" . $estatus . "',TIPO = '" . $level . "' WHERE ID_USUARIO = '" . $id_usuario . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {            
            $coincidencia = 0;
        }
        return $coincidencia;
    }

    function updateAlumno($nombre, $a_paterno, $a_materno, $matricula, $pass, $estatus, $level, $id_usuario)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE usuarios SET NOMBRE = '" . $k->enc($nombre) . "' , APELLIDO_P = '" . $k->enc($a_paterno) . "' ,APELLIDO_M = '" . $k->enc($a_materno) . "' ,MATRICULA ='" . $k->enc($matricula) . "' ,PASS = '" . $k->enc($pass) . "' ,STATUS = '" . $estatus . "',TIPO = '" . $level . "' WHERE ID_USUARIO = '" . $id_usuario . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
            echo "" . $e;
        }
        return $coincidencia;
    }

    function updateSuperUser($nombre, $a_paterno, $a_materno, $correo, $pass, $estatus, $level, $id_usuario)
    {
        try {
            include_once("../../MODELO/conect.php");
            $c = new conect();
            include_once("../../CONTROLADOR/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE usuarios SET NOMBRE = '" . $k->enc($nombre) . "' , APELLIDO_P = '" . $k->enc($a_paterno) . "' ,APELLIDO_M = '" . $k->enc($a_materno) . "' ,CORREO ='" . $k->enc($correo) . "' ,MATRICULA ='" . $k->enc($correo) . "' ,PASS = '" . $k->enc($pass) . "' ,STATUS = '" . $estatus . "',TIPO = '" . $level . "' WHERE ID_USUARIO = '" . $id_usuario . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
            echo "" . $e;
        }
        return $coincidencia;
    }
}
