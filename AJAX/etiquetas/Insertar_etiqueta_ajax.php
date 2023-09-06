<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once("../../CONTROLADOR/key.php");
        $k = new key();
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $result = "";
        require_once("../../MODELO/conect.php");
        $c = new conect();
        $stmt = $c->connect()->prepare("INSERT INTO etiquetas (ID_ETIQUETA, NOMBRE, DESCRIPCION) values (?,?,?)");
        $stmt->execute(array(null, $k->enc($nombre), $k->enc($descripcion)));
        echo 1;
    } catch (PDOException $e) {
        echo 0;
    }
}