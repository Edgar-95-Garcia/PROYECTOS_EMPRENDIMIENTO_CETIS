<?php
include_once("./CONTROLADOR/key.php");
$k = new key();
include_once("./MODELO/Apariencia/Consultar_apariencia.php");
$obj_apariencia = new Consultar_apariencia();
$datos_apariencia = $obj_apariencia->selectApariencia();
if (isset($datos_apariencia) && $datos_apariencia != false) {
    foreach ($datos_apariencia as $datos) {
        if ($datos['TIPO'] == "Q30FAqd0zsnyR0ljRxJBajOO") {
            $color_fondo_inferior = $datos['VALOR'];
        }
    }
} else {
    $color_fondo_inferior = $k->enc("#a8adad");
}
?>
</body>
<footer
    style="background-color: <?php echo $k->dec($color_fondo_inferior) ?>; font-size:large;font-family:Montserrat Black; font-size:19px;color:white">
    <br>
    <center>        
        <p><a href="sugerencias.php" style="color:white">Da click aquí para envíar una sugerencia</a></p>
        <p>Dirección: Av Estanislao Ramírez Ruíz, Amp. Selene, Tláhuac, 13420, Ciudad de México, CDMX.</p>
    </center>
    <br>
</footer>