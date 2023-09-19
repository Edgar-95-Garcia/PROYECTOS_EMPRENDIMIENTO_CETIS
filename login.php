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

    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
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
                                <br><br><input name="c_u" type="text" placeholder="Matricula o correo"
                                    style="width: 25%; text-align:center"> <br>
                                <br><br><input name="con" type="password" placeholder="Contraseña"
                                    style="width: 25%; text-align:center"> <br><br>
                                <br><br>
                                <?php include_once("./CONTROLADOR/usuarios/ingreso_usuarios.php"); ?>
                                <input type="submit" class="btn btn-success" style="width: 60%;" value="Ingresar" name="aceptar" style="width: 10%;">
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