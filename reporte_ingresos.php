<?php
$GLOBALS['menu'] = 'reportes';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_cetis"]) == null) {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else {
    include_once("./cabecera.php");
    include_once("./MODELO/Aud/Consultar_aud.php");
    $obj_aud = new Consultar_aud();
    include_once("./CONTROLADOR/key.php");
    $k = new key();
    ?>
    <div>
        <center>
            <br><br>
            <h2>REPORTE DE INGRESO DE USUARIOS</h2>
            <br><br>
        </center>
    </div>
    <div>
        <center>
            <br><br>
            <h3>INGRESOS DEL DÍA
                <i>
                    <?php echo date("d") ?>
                </i>
            </h3>
            <hr class="red">
            <br><br>
        </center>
    </div>

    <div>
        <canvas id="myPieChart" width="400" height="400"></canvas>
    </div>

    <script>
        <?php
        $datos_aud_aux = $datos_aud = $obj_aud->selectAud();
        $fecha_actual = date("Y-m-d");
        $contador_fecha_dias = 0;
        $contador_fecha_dias_total = 0;
        foreach ($datos_aud_aux as $dato_aud_aux) {
            $fecha = $k->dec($dato_aud_aux['FECHA']);
            if ($fecha == $fecha_actual) {
                $contador_fecha_dias++;
            }
            $contador_fecha_dias_total++;
        }
        ?>
        var ctx = document.getElementById('myPieChart').getContext('2d');//Contexto del lienzo
        var data = {
            labels: ['<?php echo "Fecha: " . $fecha_actual; ?>', 'Todas las fechas'],
            datasets: [{
                data: [<?php echo $contador_fecha_dias ?>, <?php echo $contador_fecha_dias_total ?>],
                backgroundColor: ['#122ee5', '#64042C']
            }]
        };
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    <!-- Por mes -->
    <div>
        <center>
            <br><br>
            <h3>INGRESOS DEL MES
                <?php
                echo date("m");
                ?>
            </h3>
            <hr class="red">
            <br><br>
        </center>
    </div>

    <div>
        <canvas id="myPieChart_2" width="400" height="400"></canvas>
    </div>

    <script>
        <?php
        $datos_aud_aux = $datos_aud = $obj_aud->selectAud();
        $mes_actual = date("Y-m");
        $contador_fecha_dias = 0;
        $contador_fecha_dias_total = 0;
        foreach ($datos_aud_aux as $dato_aud_aux) {
            $fecha = date("Y-m", strtotime($k->dec($dato_aud_aux['FECHA'])));
            if ($fecha == $mes_actual) {
                $contador_fecha_dias++;
            }
            $contador_fecha_dias_total++;
        }
        ?>
        var ctx = document.getElementById('myPieChart_2').getContext('2d');//Contexto del lienzo
        var data = {
            labels: ['<?php echo "Fecha: " . $mes_actual; ?>', 'Todas las fechas'],
            datasets: [{
                data: [<?php echo $contador_fecha_dias ?>, <?php echo $contador_fecha_dias_total ?>],
                backgroundColor: ['#122ee5', '#64042C']
            }]
        };
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    
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