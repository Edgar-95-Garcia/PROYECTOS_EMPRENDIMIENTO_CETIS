<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $id_etiqueta = $_POST['id_etiqueta'];
        $id_proyecto = $_POST['id'];
        $result = "";
        require_once("../../MODELO/conect.php");
        $c = new conect();
        $stmt = $c->connect()->prepare("DELETE FROM etiqueta_has_proyecto WHERE ID_ETIQUETA = '" . $id_etiqueta . "' AND ID_PROYECTO = '" . $id_proyecto . "'");
        $stmt->execute();
        echo 1;
    } catch (PDOException $e) {
        echo 0;
    }
}