<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once("../../CONTROLADOR/key.php");
        $k = new key();
        $id = $_POST['id'];
        $result = "";
        require_once("../../MODELO/conect.php");
        $c = new conect();
        $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE ID_USUARIO = '" . $id . "'");
        $stmt->execute();
        $datos = $stmt->fetch();
        $arreglo = array();
        array_push($arreglo, ($datos[0]));
        array_push($arreglo, $k->dec($datos[1]));
        array_push($arreglo, $k->dec($datos[2]));
        array_push($arreglo, $k->dec($datos[3]));
        if(isset($datos[4])){
            array_push($arreglo, $k->dec($datos[4]));
        }
        array_push($arreglo, $k->dec($datos[6]));
        array_push($arreglo, ($datos[7]));        
        array_push($arreglo, ($datos[8]));
        array_push($arreglo, $k->dec($datos[9]));
        echo json_encode($arreglo);
    } catch (PDOException $e) {
    }
}