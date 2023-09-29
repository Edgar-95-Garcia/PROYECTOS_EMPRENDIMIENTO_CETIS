<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once("../../CONTROLADOR/key.php");
        $k = new key();
        $id_etiqueta = $_POST['id_etiqueta'];
        $id = $_POST['id'];
        $result = "";
        require_once("../../MODELO/conect.php");
        $c = new conect();
        $stmt = $c->connect()->prepare("INSERT INTO etiqueta_has_proyecto (ID, ID_ETIQUETA, ID_PROYECTO) values (?,?,?)");
        $stmt->execute(array(null, $id_etiqueta, $id));
        echo 1;
    } catch (PDOException $e) {
        echo 0;
    }
}