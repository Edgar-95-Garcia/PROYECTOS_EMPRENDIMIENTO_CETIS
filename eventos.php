<?php
$GLOBALS['menu'] = 'EVENTOS';


include_once("./cabecera.php");
include_once("./CONTROLADOR/key.php");
$k = new key();
include_once("./MODELO/Eventos/Consultar_evento.php");
$obj_eventos = new Consultar_evento();
$datos_eventos = $obj_eventos->selectAllEventos();
include_once("./MODELO/Usuarios/Consultar_usuario.php");
$obj_usuarios = new Consultar_usuario();
?>
<center>
    <br><br>
    <h2>EVENTOS REGISTRADOS EN EL SISTEMA</h2>
    <hr class="red">
    <br><br>
</center>
<center>
    <div id='calendar' style="width: 80%;"></div>
</center>
<br><br>
<?php
include_once("./CONTROLADOR/key.php");
$k = new Key();
include_once("./MODELO/Eventos/Consultar_evento.php");
$obj_eventos = new Consultar_evento();
$datos_eventos = $obj_eventos->selectAllEventos();
if (!empty($datos_eventos)) {
    foreach ($datos_eventos as $evento) {
        $evento_array = array(
            //'id' => $evento['ID'],
            'title' => $k->dec($evento['NOMBRE']),
            'start' => $k->dec($evento['FECHA_INICIO']),
            'end' => $k->dec($evento['FECHA_FIN']),
            'description' => $k->dec($evento['DESCRIPCION']),
            //'id_usuario' => ($evento['ID_USUARIO']),
            //'fecha_registro' => $k->dec($evento['FECHA_MODIFICACION'])
        );
        $eventos[] = $evento_array;
    }
    $eventos_json = json_encode($eventos);
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var eventos = <?php echo $eventos_json; ?>;
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: eventos,
            eventContent: function (arg) {
                var eventHtml = '<b>' + arg.event.title + '</b><br>';
                return { html: eventHtml };
            },
            eventClick: function (info) {
                //Se genera una alerta que muestra la información detallada del evento
                var event = info.event;
                var titulo = event.title;
                var description = event.extendedProps.description;
                Swal.fire({
                    title: titulo,
                    text: description,
                    icon: 'info',
                    confirmButtonText: 'Cerrar'
                });
            }
        });

        calendar.render();

    });
</script>

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

<?php
include_once("./pie.php");
?>