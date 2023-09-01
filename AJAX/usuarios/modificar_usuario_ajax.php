<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    $a_m = $_POST['a_m'];
    $a_p = $_POST['a_p'];
    $correo = isset($_POST['correo']) ? $_POST['correo'] : $_POST['matricula'];
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $pass = $_POST['pass'];
    $status = $_POST['status'];
    $tipo = $_POST['tipo'];

    include_once("../../MODELO/conect.php");
    $mysql_object = new conect();
    include_once("../../MODELO/Usuarios/Modificar_usuario.php");
    $modificar = new Modificar_usuario();
    if($tipo == 2){
        echo $a = $modificar->updateProfesor($nombres, $a_p, $a_m, $correo, $pass, $status, $tipo, $id);
    }else if($tipo == 1){
        echo $a = $modificar->updateAlumno($nombres,$a_p,$a_m,$correo,$pass,$status,$tipo,$id);
    }else if($tipo == 0){
        echo $a = $modificar->updateSuperUser($nombres,$a_p,$a_m,$correo,$pass,$status,$tipo,$id);
    }

}