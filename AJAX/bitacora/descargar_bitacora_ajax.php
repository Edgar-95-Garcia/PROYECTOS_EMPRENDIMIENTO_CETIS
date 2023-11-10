<?php
if (isset($_GET['id'])) {
    $IDArchivo = $_GET['id'];
    include_once("../../MODELO/Archivos_proyecto/Consultar_archivo_proyecto.php");
    $obj_archivo_proyectos = new Consultar_archivo_proyecto();
    include_once("../../CONTROLADOR/key.php");
    $k = new key();
    $datos_archivo = $obj_archivo_proyectos->selectFileByID($IDArchivo);
    foreach ($datos_archivo as $archivo) {
        $nombreArchivo = $k->dec($archivo['NOMBRE_ARCHIVO']);
        $tipo = $k->dec($archivo['TIPO_ARCHIVO']);
        $size = $k->dec($archivo['SIZE_ARCHIVO']);
        $archivo = $archivo['ARCHIVO'];
    }
    header("Content-Length: $size");
    header("Content-Type: $tipo");
    header("Content-Disposition: attachment; filename=$nombreArchivo");
    ob_clean();
    flush();
    echo $archivo;
    exit;
}
?>