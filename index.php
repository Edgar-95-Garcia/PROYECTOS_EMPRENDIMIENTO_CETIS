<?php
$GLOBALS['menu'] = 'index';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['t'])) { #para cuando se cierra sesión y se redirige al index con un GET
    if ($_GET['t'] == "0") {
        session_destroy();
        ?>
        <script>
            window.location.replace("./login.php");
        </script>
        <?php
    }
} elseif (isset($_SESSION['admin']) == null && isset($_SESSION['cliente']) == null) { #Se redirigió a index y no hay sesión activa
} else {
    #Por si se redirige al index sin el GET y existe una sesión activa
}

include_once("./cabecera.php");
?>
<div>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            include_once("./CONTROLADOR/key.php");
            $k = new key();
            include_once("./MODELO/Inicio/Consultar_inicio.php");
            $obj_inicio = new Consultar_inicio();
            $datos_inicio = $obj_inicio->selectInicioPanel($k->enc("."), $k->enc("."));
            $contador = 0;
            foreach ($datos_inicio as $datos_panel) {
                ?>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="data:image/png;base64,<?php echo $k->dec($datos_panel['IMAGEN']); ?>"
                        alt="First slide">
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<hr>
<div class="carousel-container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 70%;">
        <div class="carousel-inner">
            <?php
            include_once("./Controlador/key.php");
            $k = new key();
            include_once("./Modelo/Inicio/Consultar_inicio.php");
            $obj_inicio = new Consultar_inicio();
            $datos_inicio = $obj_inicio->selectInicio();
            $contador = 0;
            foreach ($datos_inicio as $datos) {
                ?>
                <div class="carousel-item <?php echo $contador == 0 ? 'active' : '' ?>" style="text-align:center">
                    <div class="card" style="width: 100%">
                        <img class="card-img-top" src="data:image/png;base64,<?php echo $k->dec($datos['IMAGEN']); ?>"
                            alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title" style='font-size:50px; font-family: "Goudy Stout"; color:#32D532'>
                                <?php echo $k->dec($datos['TITULO']) ?>
                            </h3>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal" onclick="mostrar_modal('<?php echo $k->dec($datos['TITULO'])?>','<?php echo $k->dec($datos['TEXTO'])?>' ,'<?php echo $k->dec($datos['IMAGEN']); ?>')"> Más información </button>
                        </div>
                    </div>
                </div>
                <?php
                $contador++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<?php 
include_once("./Controlador/key.php");
$k = new key();
?>
<hr>
<br><br>
<?php
include_once("./pie.php");
?>

<div class="modal fade" tabindex="-1" role="dialog" id="modal" name="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title" name="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="border: #0000001a solid 1px; padding: 10px">
                    <img name="img_modal" id="img_modal" src="" alt="" style="width:100%; height:100%">
                </div>
                <br>
                <div style="border: #0000001a solid 1px; padding: 10px">
                    <p id="txt_modal" name="txt_modal"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrar_modal(titulo, texto, imagen){
        $("#modal-title").html(titulo)
        $("#txt_modal").html(texto)
        $("#img_modal").attr('src', "data:image/png;base64,"+imagen);
    }
</script>