<?php

include_once("./CONTROLADOR/key.php");
$k = new key();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        Cadena a codificar <input type="text" name="codificar"><br><br>
        Cadena a decodificar <input type="text" name="decodificar"><br><br>
        <input type="submit" value="Aceptar" name="Aceptar"><br><br>
    </form>
</body>

</html>
<?php
if (isset($_POST["Aceptar"])) {
    if (isset($_POST["codificar"])) {
?>
        Original <input type='text' name="c" value="<?php echo $_POST['codificar'] ?>"> Codificada <input type='text' value="<?php echo $k->enc($_POST['codificar']) ?>"> <br><br>
    <?php
    }
    if (isset($_POST["decodificar"])) {
    ?>
        Original <input type='text' name="d" value="<?php echo $_POST['decodificar'] ?>"> Decodificada <input type='text' value="<?php echo $k->dec($_POST['decodificar']) ?>"><br><br>
<?php
    }
}

$variable = "0";
echo $variable;
if (empty($variable)) {
    echo "Está vacía\n";
} else {
    echo "No está vacía\n";
}
