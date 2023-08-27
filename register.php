<?php
$GLOBALS['menu'] = 'registro';

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
                    <font size="6" face="Cooper Black" color="#3CA43C">
                        <h5 class="card-header">REGISTRATE</h5>
                    </font>
                    <div class="card-body">
                        <font size="4" face="Constantia" color="#356425">
                            <p class="card-text">
                                NOMBRE (S)<br><br><input name="nombres" type="text"> <br><br>
                                APELLIDO PATERNO <br><br><input name="paterno" type="text"> <br><br>
                                APELLIDO MATERNO<br><br><input name="materno" type="text"> <br><br>
                                SOY:<br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio1" checked onclick="verificar()" value="1">
                                <label class="form-check-label" for="flexRadio1">
                                    ESTUDIANTE
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio2" onclick="verificar()" value="2">
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
                        function verificar(){
                            if ($('#flexRadio2').is(":checked")){
                                $("#dynamic-input").text("CORREO")
                                $("#dynamic-input-value").val("")
                            }else{
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