<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if (isset($_POST["aceptar"]) && $_POST["aceptar"] == "Aceptar") {
        if (isset($_POST["nombres"])) {
            $nombres = htmlentities($_POST["nombres"]);
        }
        if (isset($_POST["paterno"])) {
            $apellido_paterno = htmlentities($_POST["paterno"]);
        }
        if (isset($_POST["materno"])) {
            $apellido_materno = htmlentities($_POST["materno"]);
        }
        if (isset($_POST["flexRadio"])) {
            $tipo_usuario = htmlentities($_POST["flexRadio"]);
        }
        if (isset($_POST["dynamic-input-value"])) {
            $campo_dinamico = htmlentities($_POST["dynamic-input-value"]);
        }
        if (isset($_POST["password"])) {
            $pass = htmlentities($_POST["password"]);
        }
        /*Primero se validan los campos y de haber sido rellenado se agregan los valores, en caso contrario la variable permanece
        Vacia y posteriormente la bandera se convierte en FALSE lo cual permite mostrar la alerta da javascript
        */
        if (empty($nombres)) {
            echo "<p style='color:red'>*Ingresa tu nombre o nombres</p>";
            $flag = false;
        }
        if (empty($apellido_paterno)) {
            echo "<p style='color:red'>*Ingresa apellido paterno</p>";
            $flag = false;
        }
        if (empty($apellido_materno)) {
            echo "<p style='color:red'>*Ingresa apellido materno</p>";
            $flag = false;
        }
        if (empty($campo_dinamico)) {
            echo "<p style='color:red'>*Ingresa matricula o correo</p>";
            $flag = false;
        }
        if (empty($pass)) {
            echo "<p style='color:red'>*Ingresa contraseña</p>";
            $flag = false;
        }
        #se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./MODELO/conect.php");
            $mysql_object = new conect();
            include_once("./MODELO/Usuarios/Insertar_usuario.php");
            $insertar = new Insertar_usuario();
            $a = $insertar->addUser($nombres, $apellido_paterno, $apellido_materno, $campo_dinamico, $pass, $tipo_usuario);
            if ($a == 1) {
                ?>
                <script>
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Registro exitoso',
                        icon: 'success',
                    })
                </script>
                <?php
            } else if ($a == 2) {
                ?>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Registro no realizado',
                        icon: 'error',
                    })
                </script>
                <?php
            } elseif ($a == 3) {
                ?>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Registro no realizado, por favor intente en unos minutos',
                        icon: 'warning',
                    })
                </script>
                <?php
            } elseif ($a == 5) {
                ?>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Correo ya registrado',
                        icon: 'error',
                    })
                </script>
                <?php
            } elseif ($a == 6) {
                ?>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Matricula ya registrada',
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