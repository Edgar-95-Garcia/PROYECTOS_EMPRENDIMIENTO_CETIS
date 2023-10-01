<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    $id = 0;
    if (isset($_POST["aceptar"]) && $_POST["aceptar"] == "Aceptar") {
        if (isset($_POST["sug"])) {
            $sug = htmlentities($_POST["sug"]);
        }
        if (isset($_SESSION['id_profesor'])) {
            $id = $_SESSION['id_profesor'];
        }
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
        }

        /*Primero se validan los campos y de haber sido rellenado se agregan los valores, en caso contrario la variable permanece
        Vacia y posteriormente la bandera se convierte en FALSE lo cual permite mostrar la alerta da javascript
        */
        if (empty($sug)) {
            echo "<p style='color:red'>*Ingresa tu sugerencia, queja o comentario</p>";
            $flag = false;
        }
        #se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./MODELO/conect.php");
            $mysql_object = new conect();
            include_once("./MODELO/Sugerencias/Insertar_sugerencia.php");
            $insertar = new Insertar_sugerencia();
            $a = $insertar->add_sug(array(null, $id, $k->enc($sug), $k->enc(date("Y-m-d"))));
            if ($a == 1) {
                ?>
                <script>
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Sugerencia envíada',
                        icon: 'success',
                    })
                </script>
                <?php
            } else if ($a == 0) {
                ?>
                    <script>
                        Swal.fire({
                            title: '¡Error!',
                            text: 'No realizado, reintente en unos minutos',
                            icon: 'error',
                        })
                    </script>
                <?php
            }
        } else {
            ?>
            <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'Revisa los datos ingresados',
                    icon: 'warning',
                })
            </script>
            <?php
            unset($mysql_object);
            unset($insertar);
        }
    }
}