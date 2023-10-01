<?php

class Insertar_usuario
{

    function addUser($nombres, $a_p, $a_m, $campo_dinamico, $pass, $tipo_usuario)
    {
        include_once("./CONTROLADOR/key.php");
        $k = new key();
        $fecha = date("Y-m-d H:i:s");
        $temp = 0;
        $data = array(null, $k->enc($nombres), $k->enc($a_p), $k->enc($a_m), $k->enc($campo_dinamico), $k->enc($campo_dinamico), $k->enc($pass), $k->enc($tipo_usuario), $k->enc("1"), $k->enc($fecha));
        $temp = $this->registro_usuario($data);
        return $temp;
    }


    function registro_usuario($data)
    {
        $temp = 0;
        try {
            include_once("./CONTROLADOR/key.php");
            $k = new key();
            include_once("./MODELO/conect.php");
            $mysql_object = new conect();
            #checar que no existan correos o matriculas duplicadas
            if ($data[7] == $k->enc("1")) {#Correo
                $statementHandle = $mysql_object->connect()->prepare("SELECT * FROM usuarios WHERE MATRICULA = '" . $data[4] . "'");
                $statementHandle->execute();
                $recovery_data = $statementHandle->rowCount();
                if ($recovery_data>0) {
                    $temp = 6; #Ya existe un matricula registrado parecido al ingresado
                }
            } else if ($data[7] == $k->enc("2")) {#Matricula
                $statementHandle = $mysql_object->connect()->prepare("SELECT * FROM usuarios WHERE CORREO = '" . $data[4] . "'");
                $statementHandle->execute();
                $recovery_data = $statementHandle->rowCount();
                if ($recovery_data>0) {
                    $temp = 5; #Ya existe una correo registrada parecida a la ingresada
                }
            }
            //----------------------------------------------
            if ($temp != 5 && $temp != 6) {
                if ($data[7] == $k->enc("1")) { //Registro de tipo estudiante. Tiene acceso inmediato al sistema
                    $data[7] = 1;
                    $data[8] = 1;
                    $data[4] = NULL;
                    $statementHandle = $mysql_object->connect()->prepare("INSERT INTO usuarios(ID_USUARIO, NOMBRE, APELLIDO_P, APELLIDO_M, CORREO, MATRICULA, PASS, TIPO, STATUS, FECHA_ALTA) VALUES (?,?,?,?,?,?,?,?,?,?)");
                } else { //Registro de tipo profesor. No tiene acceso inmediato al sistema, debe ser validado por administrador
                    $data[7] = 2;
                    $data[8] = 1;
                    $data[5] = NULL;
                    $statementHandle = $mysql_object->connect()->prepare("INSERT INTO usuarios(ID_USUARIO, NOMBRE, APELLIDO_P, APELLIDO_M, CORREO, MATRICULA, PASS, TIPO, STATUS, FECHA_ALTA) VALUES (?,?,?,?,?,?,?,?,?,?)");
                }
                $statementHandle->execute($data);
                $temp = 1; #todo ha sido correcto
            }
        } catch (PDOException $e) {
            $temp = 3; #otro tipo de error
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $temp;
    }
}