<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    include_once("../../MODELO/Sugerencias/Borrar_sugerencia.php");
    $obj_usuario = new Borrar_sugerencia();
    echo $obj_usuario->deleteUSugerenciaFromId($id);
}
?>