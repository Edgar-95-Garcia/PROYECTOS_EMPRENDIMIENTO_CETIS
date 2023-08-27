<?php
class Modificar_usuario
{
    function updateProfesor($nombre, $a_paterno, $a_materno, $telefono, $correo, $pass, $estatus, $level, $id_usuario)
    {
        try {
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE usuarios SET NOMBRES = '" . $k->enc($nombre) . "' ,APELLIDO_PATERNO = '" . $k->enc($a_paterno) . "' ,APELLIDO_MATERNO = '" . $k->enc($a_materno) . "' ,TEL_CONTACTO = '" . $k->enc($telefono) . "' ,CORREO ='" . $k->enc($correo) . "' ,PASS = '" . $k->enc($pass) . "' ,STATUS = '" . $estatus . "',LEVEL = '" . $level . "' WHERE ID_USUARIO = '" . $id_usuario . "' AND LEVEL = 0");
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

    function updateAlumno($nombre, $a_paterno, $a_materno, $matricula, $telefono, $correo, $pass, $estatus, $level, $id_usuario)
    {
        try {
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE usuarios SET NOMBRES = '" . $k->enc($nombre) . "' ,APELLIDO_PATERNO = '" . $k->enc($a_paterno) . "' ,APELLIDO_MATERNO = '" . $k->enc($a_materno) . "' ,MATRICULA = '" . $k->enc($matricula) . "' ,TEL_CONTACTO = '" . $k->enc($telefono) . "' ,CORREO ='" . $k->enc($correo) . "' ,PASS = '" . $k->enc($pass) . "' ,STATUS = '" . $estatus . "',LEVEL = '" . $level . "' WHERE ID_USUARIO = '" . $id_usuario . "' AND LEVEL = 1");
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

    function updateSuperUser($correo, $pass, $id_usuario)
    {
        try {
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE usuarios SET MATRICULA ='" . $k->enc($correo) . "' ,PASS = '" . $k->enc($pass) . "' WHERE ID_USUARIO = '" . $id_usuario . "' AND LEVEL = 3");
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
