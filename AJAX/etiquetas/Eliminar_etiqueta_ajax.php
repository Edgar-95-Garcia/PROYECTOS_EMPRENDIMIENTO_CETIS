<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $id = $_POST['id'];
        $result = "";
        require_once("../../MODELO/conect.php");
        $c = new conect();
        $stmt = $c->connect()->prepare("DELETE FROM etiquetas WHERE ID_ETIQUETA = '" . $id . "'");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $stmt = $c->connect()->prepare("DELETE FROM etiqueta_has_proyecto WHERE ID_ETIQUETA = '" . $id . "'");
            $stmt->execute();
            echo 1;
        } else {
            echo 0;
        }
    } catch (PDOException $e) {
        echo 0;
    }
}