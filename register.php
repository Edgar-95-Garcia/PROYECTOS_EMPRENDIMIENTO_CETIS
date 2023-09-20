<?php
$GLOBALS['menu'] = 'admon';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["admin_cetis"])) {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else {
    include_once("./cabecera.php");
    ?>
    <center>
        <br><br>
        <h2>REGISTRO DE USUARIOS</h2>
        <hr class="red">
        <br><br>
    </center>
    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <font size="4" face="Constantia">
                            <p class="card-text">
                                NOMBRE (S)<br><br><input name="nombres" type="text"> <br><br>
                                APELLIDO PATERNO <br><br><input name="paterno" type="text"> <br><br>
                                APELLIDO MATERNO<br><br><input name="materno" type="text"> <br><br>
                                TIPO DE USUARIO:<br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio1" checked
                                    onclick="verificar()" value="1">
                                <label class="form-check-label" for="flexRadio1">
                                    ESTUDIANTE
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio2"
                                    onclick="verificar()" value="2">
                                <label class="form-check-label" for="flexRadio2">
                                    PROFESOR
                                </label>
                            </div>
                            <br><br>
                            <label class="form-check-label" for="dynamic-input-value" id="dynamic-input">
                                MATRICULA
                            </label><br><br><input name="dynamic-input-value" id="dynamic-input-value" type="text"><br><br>
                            <!-- CORREO<br><br><input name="correo" type="text"> <br><br> -->
                            CONTRASEÑA<br><br><input name="password" type="text"> <br><br><br>
                            <?php include_once("./CONTROLADOR/usuarios/registro_usuarios.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="Aceptar" name="aceptar">
                            </p>
                        </font>
                    </div>
                    <script>
                        function verificar() {
                            if ($('#flexRadio2').is(":checked")) {
                                $("#dynamic-input").text("CORREO")
                                $("#dynamic-input-value").val("")
                            } else {
                                $("#dynamic-input").text("MATRICULA")
                                $("#dynamic-input-value").val("")
                            }
                        }
                    </script>
                </div>
                <br>
            </form>
        </div>
    </div>
    <br><br>
    </div>
    <?php
    include_once("./pie.php");
}
?>
<style>
    .container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 1fr;
        gap: 60px 0px;
        grid-auto-flow: row;
        grid-template-areas:
            ". . .";
    }

    .red {
        margin: 10px 0 70px;
        border-top-color: #7e9d9d;
        display: block;
        unicode-bidi: isolate;
        margin-block-start: 0.5em;
        margin-block-end: 0.5em;
        margin-inline-start: auto;
        margin-inline-end: auto;
        overflow: hidden;
        width: 70%;
    }

    hr.red::before {
        content: " ";
        width: 35px;
        height: 5px;
        background-color: #b38e5d;
        display: block;
        position: absolute;
    }
</style>