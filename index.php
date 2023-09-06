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
<hr>
<br>
<hr>

<?php
include_once("./pie.php");
?>