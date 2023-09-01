<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_usuario = $_POST['id'];
    include_once("../../MODELO/Usuarios/Borrar_usuario.php");
    $obj_usuario = new Borrar_usuario();
    echo $obj_usuario->deleteUsuarioFromIdUsuario($id_usuario);   
}
?>