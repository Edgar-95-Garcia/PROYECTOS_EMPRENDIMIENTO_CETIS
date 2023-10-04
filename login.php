<?php
$GLOBALS['menu'] = 'ENTRAR';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user']) != null) {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else {

    include_once("./cabecera.php");
    ?>
    <div class="card text-center card_login">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <font size="6" face="Cooper Black" color="#a70000">
                        <h5 class="card-header">INICIAR SESIÓN</h5>
                    </font>
                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                            enctype="multipart/form-data">
                            <p class="card-text">
                                <br><br><input class="input_media" name="c_u" type="text" placeholder="Matricula o correo">
                                <br>
                                <br><br><input class="input_media" name="con" type="password" placeholder="Contraseña">
                                <br><br>
                                <br><br>
                                <?php include_once("./CONTROLADOR/usuarios/ingreso_usuarios.php"); ?>
                                <input type="submit" class="btn btn-success" style="width: 60%;" value="Ingresar"
                                    name="aceptar" style="width: 10%;">
                            </p>
                        </form>
                        <br>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
    <?php
}
?>
<?php include_once("./pie.php"); ?>
<style>
    @media (orientation: landscape) {
        .card_login {
            width: 50%;
            height: 100%;
            position: relative;
            left: 25%
        }

        .input_media {
            width: 30%;
            text-align: center
        }
    }

    @media (orientation: portrait) {
        .card_login {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .input_media {
            width: 70%;
            text-align: center
        }
    }
</style>