<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargando...</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="preloader"></div>
</body>
</html>

<?php
    require_once('./config.php');
    // Conexion
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $nombre = utf8_decode($_POST['nombre']);
    $calleNumero = utf8_decode($_POST['calleNumero']);
    $colonia = utf8_decode($_POST['colonia']);
    $cp = (int)$_POST['cp'];
    $ciudad = utf8_decode($_POST['ciudad']);
    $estado = utf8_decode($_POST['estado']);
    $telefono01 = (int)$_POST['telefono01'];
    $telefono02 = (int)$_POST['telefono02'];
    $email01 = $_POST['email01'];
    $email02 = $_POST['email02'];
    $beneficiario = utf8_decode($_POST['beneficiario']);
    $curp = strtoupper($_POST['curp']);
    $rfc = strtoupper($_POST['rfc']);
    $nss = strtoupper($_POST['nss']);
    $ine = strtoupper($_POST['ine']);
    $nivelEstudios = $_POST['nivelEstudios'];
    $fechaNac = $_POST['fechaNac'];
    $estadoCivil = $_POST['estadoCivil'];
    $experiencia = $_POST['experiencia'];
    $experienciaDonde = utf8_decode($_POST['experienciaDonde']);
    $turnoInteres = $_POST['turnoInteres'];
    $avisoPrivacidad = null;
    if (isset($_POST['avisoPrivacidad'])) $avisoPrivacidad = $_POST['avisoPrivacidad'];

    $fechaHoy = date("Y/m/d"); //Conseguiimos la fecha actual
    $codigoFechaHoy = str_replace("/", "", $fechaHoy); //Formateo de fecha para que se ajuste al codigo
    $query = mysqli_query($conexion, "SELECT idPostulante FROM postulantes ORDER BY idPostulante DESC LIMIT 1");//Consulta del id del ultimo registro ingresado en la base de datos
    $ultimoRegistro=mysqli_fetch_array($query);//Guardamos los result en una variable
    $fechaUltimoRegistro = substr($ultimoRegistro[0], 0, -3);//Sacamos el codigo de fecha que tenia el ultimo registro
    
    if ($codigoFechaHoy == $fechaUltimoRegistro) {
        $idPostulante = intval($ultimoRegistro[0]) + 1;
    }
    else {
        $idPostulante = $codigoFechaHoy . '001';
    }
    
    $mensajeError = '';

    if ($avisoPrivacidad == "aceptado") {
        if ($nombre != null &&
            $telefono01 != null &&
            $email01 != null &&
            $curp != null &&
            $ine != null &&
            $fechaNac != null) {
    
            if (strlen($nombre) <= 0) { $mensajeError .= '-nombre- '; }
            if (!filter_var($email01, FILTER_VALIDATE_EMAIL)) { $mensajeError .= '-email-'; }
            if (!(strlen($telefono01) == 10)) { $mensajeError .= '-teléfono- '; }
            if (!(strlen($curp) == 18)) { $mensajeError .= '-curpLongitud- '; }
            if (!(strlen($ine) == 18)) { $mensajeError .= '-ineLongitud- '; }
            if (!(ctype_alnum($curp))) { $mensajeError .= '-curpLetras- '; }
            if (!(ctype_alnum($ine))) { $mensajeError .= '-ineLetras- '; }
            
            if (strlen($mensajeError) <= 0) {
                $sql = "INSERT INTO `postulantes` (`idPostulante`, `nombre`, `calleNumero`, `colonia`, `cp`, `ciudad`, `estado`, `telefono01`, `telefono02`, `email01`, `email02`, `beneficiario`, `curp`, `rfc`, `nss`, `ine`, `nivelEstudios`, `fechaNac`, `estadoCivil`, `experiencia`, `experienciaDonde`, `turnoInteres`) VALUES
                ('$idPostulante', '$nombre', '$calleNumero', '$colonia', $cp, '$ciudad', '$estado', $telefono01, $telefono02, '$email01', '$email02', '$beneficiario', '$curp', '$rfc', '$nss', '$ine', '$nivelEstudios', '$fechaNac', '$estadoCivil', '$experiencia', '$experienciaDonde', '$turnoInteres');";
                $query = mysqli_query($conexion, $sql);
    
                if ($query) {
                    echo "<script>
                    location.href = './enviarDatos.php?id=" . $idPostulante ."';
                    </script> <br>";
                } 
                else { echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>"; }
            }
            else {
                $mensajeError .= ' formato equivocado';
                echo "<script>
                    alert('$mensajeError');
                    location.href = '../index.html';
                    </script>";
            }
        }
        mysqli_close($conexion);
    }
    else {
        echo "<script>
            alert('Debes leer y aceptar el aviso de privacidad para continuar');
            location.href = '../index.html';
            </script>";
    }
?>