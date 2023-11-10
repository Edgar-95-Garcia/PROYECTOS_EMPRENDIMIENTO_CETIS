<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    $temp = 2; //bandera que permite llevar un control de validaciones del formulario (se verifica que no existan campos vacios)
    if ($_POST["aceptar"] == "Ingresar") {
        if (isset($_POST["c_u"])) {
            $matricula = htmlentities(($_POST["c_u"]));
        }
        if (isset($_POST["con"])) {
            $pass = htmlentities($_POST["con"]);
        }
    }
    if (empty($matricula)) {
        echo "<p style='color:red'>*Ingresa tu Matricula o Correo</p>";
        $flag = false;
    } else {
        $temp--;
    }
    if (empty($pass)) {
        echo "<p style='color:red'>*Ingresa tu contraseña</p><br>";
        $flag = false;
    } else {
        $temp--;
    }
    if ($flag == true && $temp == 0) {
        include_once("./MODELO/conect.php");
        $mysql_object = new conect();
        include_once("./MODELO/Usuarios/Consultar_usuario.php");
        $consultar = new Consultar_usuario();
        $val = intval(($consultar->selectUserUserName($matricula, $pass)));
        if ($val == 4) {
            //cuenta no está activada
            ?>
            <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'Solicita al administrador del sitio activar tu cuenta',
                    icon: 'error',
                })
            </script>
            <?php
        } else if ($val == 3) {
            //ingresa usuario ALUMNO de sitio
            $actual_session = md5($matricula);
            $_SESSION["user"] = $actual_session;
            $_SESSION["nombre"] = $consultar->selectNameUserName($matricula);
            $_SESSION["id"] = $_SESSION["id_alumno"] = $consultar->selectUserIDFromCorreo($matricula);
            include_once("./CONTROLADOR/key.php");
            $k = new key();
            include_once("./MODELO/Aud/Insertar_aud.php");
            $obj_aud = new Insertar_aud();
            $obj_aud->add_aud(array(null, $_SESSION["id"], $k->enc("ingreso"), $k->enc(date("Y-m-d"))));
            ?>
                <script>
                    Swal.fire({
                        title: '¡Exito!',
                        text: 'Inicio de sesión exitoso',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Aquí puedes poner la URL a la que deseas redireccionar
                            window.location.href = "index.php";
                        }
                    });
                </script>
            <?php
        } else if ($val == 2) {
            #usuario ADMINISTRADOR
            $actual_session = md5($matricula);
            $_SESSION["user_cetis"] = $actual_session;
            $_SESSION["user"] = $actual_session;
            $_SESSION["nombre"] = $consultar->selectNameUserName($matricula);
            $_SESSION["admin_cetis"] = $consultar->selectUserIDFromCorreo($matricula);
            ?>
                    <script>
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Inicio de sesión exitoso',
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Aquí puedes poner la URL a la que deseas redireccionar
                                window.location.href = "index.php";
                            }
                        });
                    </script>
            <?php
        } else if ($val == 0) {
            //ingresa usuario PROFESOR
            $actual_session = md5($matricula);
            $_SESSION["user_profesor"] = $actual_session;
            $_SESSION["user"] = $actual_session;
            $_SESSION["nombre"] = $consultar->selectNameUserName($matricula);
            $_SESSION["id_profesor"] = $_SESSION["id"] = $consultar->selectUserIDFromCorreo($matricula);
            include_once("./CONTROLADOR/key.php");
            $k = new key();
            include_once("./MODELO/Aud/Insertar_aud.php");
            $obj_aud = new Insertar_aud();
            $obj_aud->add_aud(array(null, $_SESSION["id_profesor"], $k->enc("ingreso"), $k->enc(date("Y-m-d"))));
            ?>
                        <script>
                        Swal.fire({
                            title: '¡Exito!',
                            text: 'Inicio de sesión exitoso',
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Aquí puedes poner la URL a la que deseas redireccionar
                                window.location.href = "index.php";
                            }
                        });
                    </script>
            <?php
        } else if ($val == 5) {
            ?>
                            <script>
                                Swal.fire({
                                    title: '¡Error!',
                                    text: 'Matricula o correo y/o contraseña incorrectoss',
                                    icon: 'error',
                                })
                            </script>
            <?php
        }
    }
}
?>