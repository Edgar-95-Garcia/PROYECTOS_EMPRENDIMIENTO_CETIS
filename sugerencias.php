<?php
$GLOBALS['menu'] = '';

if (!isset($_SESSION)) {
    session_start();
}

    include_once("./cabecera.php");
    ?>
    <center>
        <br><br>
        <h2>FORMULARIO PARA AGREGAR SUGERENCIAS</h2>
        <hr class="red">
        <br><br>
    </center>
    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <font size="4" face="Constantia">
                            <p>Envía una sugerencia, comentario o queja</p>
                            <textarea name="sug" id="sug" cols="50" rows="10"></textarea>
                            <br><br><br>
                            <?php include_once("./CONTROLADOR/sugerencias/registro_sugerencias.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="Aceptar" name="aceptar">
                            </p>
                        </font>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
    <br><br>
    </div>
    <?php
    include_once("./pie.php");

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