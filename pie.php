<?php
include_once("./Controlador/key.php");
$k = new key();
include_once("./Modelo/Apariencia/Consultar_apariencia.php");
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
<font color="Black" face="arial" size="4">
    <center>
        <footer style="background-color: <?php echo $k->dec($color_fondo_inferior) ?>;">
            <a href="">
                <center><img src="./Static/images/face.png" align='right' width="100" height="100"></center>
            </a>
            <a href="">
                <center><img src="" align='left' width="100" height="100"></center>
            </a>
            <a href="">
                <center><img src="./Static/images/insta.png" align='center' width="100" height="100"></center>
            </a>
            <font size="3" face="Bodoni MT Black" color="#2C3E50 "><br>
                Correo: </br>
                <p> Dirección: Av Estanislao Ramírez Ruiz, Amp. Selene, Tláhuac, 13420 Ciudad de México, CDMX</p>
                <p>Pagina web: </br></p>

        </footer>
    </center>
</font>
</body>