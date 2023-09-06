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
            echo 1;
        } else {
            echo 0;
        }
    } catch (PDOException $e) {
        echo 0;
    }
}