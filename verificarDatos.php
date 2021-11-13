<?php
    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }
    echo "Conexion exitosa <br>";

    $nombre = $_POST['nombre'];
    $calleNumero = $_POST['calleNumero'];
    $colonia = $_POST['colonia'];
    $cp = (int)$_POST['cp'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $telefono01 = (int)$_POST['telefono01'];
    $telefono02 = (int)$_POST['telefono02'];
    $email01 = $_POST['email01'];
    $email02 = $_POST['email02'];
    $beneficiario = $_POST['beneficiario'];
    $curp = $_POST['curp'];
    $rfc = $_POST['rfc'];
    $nss = $_POST['nss'];
    $ine = $_POST['ine'];
    $nivelEstudios = $_POST['nivelEstudios'];
    $fechaNac = $_POST['fechaNac'];
    $estadoCivil = $_POST['estadoCivil'];
    $experiencia = $_POST['experiencia'];
    $experienciaDonde = $_POST['experienciaDonde'];
    $turnoInteres = $_POST['turnoInteres'];

    $fechaHoy = date("Y/m/d"); //Conseguiimos la fecha actual
    $codigoFechaHoy = str_replace("/", "", $fechaHoy); //Formateo de fecha para que se ajuste al codigo
    $query = mysqli_query($conexion, "SELECT idPostulante FROM postulantes ORDER BY idPostulante DESC LIMIT 1");//Consulta del id del ultimo registro ingresado en la base de datos
    $ultimoRegistro=mysqli_fetch_array($query);//Guardamos los result en una variable
    $fechaUltimoRegistro = substr($ultimoRegistro[0], 0, -3);//Sacamos el codigo de fecha que tenia el ultimo registro
    
    if ($codigoFechaHoy == $fechaUltimoRegistro) {
        /* $idPostulante = sprintf('%03d', intval(str_replace($codigoFechaHoy, "", $ultimoRegistro[0])) + 1); */
        $idPostulante = intval($ultimoRegistro[0]) + 1;
    }
    else {
        $idPostulante = intval($codigoFechaHoy . '001');
    }
    
    $mensajeError = '';

    if ($nombre != null &&
        $telefono01 != null &&
        $email01 != null &&
        $curp != null &&
        $ine != null &&
        $fechaNac != null) {

        if (!(strlen($telefono01) == 10)) { $mensajeError = $mensajeError . 'Longitud de teléfono inválido' . "\n"; }
        if (!(strlen($curp) == 18)) { $mensajeError = $mensajeError . 'Longitud de curp inválido' . "\n"; }
        if (!(strlen($ine) == 18)) { $mensajeError = $mensajeError . 'Longitud de ine inválido' . "\n"; }
        
        if (strlen($mensajeError) <= 0) {
            $sql = "INSERT INTO postulantes VALUES ('$idPostulante' '$nombre', '$calleNumero', '$colonia', '$cp', '$ciudad', '$estado', '$telefono01', '$telefono02', '$email01', '$email02', '$beneficiario', '$curp', '$rfc', '$nss', '$ine', '$nivelEstudios', '$fechaNac', '$estadoCivil', '$experiencia', '$experienciaDonde', '$turnoInteres')";
            $query = mysqli_query($conexion, $sql);

            if ($query) { echo "Consulta exitosa"; } 
            else { echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>"; }
            
            echo var_dump($idPostulante) . '<br>';
            echo var_dump($nombre) . '<br>';
            echo var_dump($calleNumero) . '<br>';
            echo var_dump($colonia) . '<br>';
            echo var_dump($cp) . '<br>';
            echo var_dump($ciudad) . '<br>';
            echo var_dump($estado) . '<br>';
            echo var_dump($telefono01) . '<br>';
            echo var_dump($telefono02) . '<br>';
            echo var_dump($email01) . '<br>';
            echo var_dump($email02) . '<br>';
            echo var_dump($beneficiario) . '<br>';
            echo var_dump($curp) . '<br>';
            echo var_dump($rfc) . '<br>';
            echo var_dump($nss) . '<br>';
            echo var_dump($ine) . '<br>';
            echo var_dump($nivelEstudios) . '<br>';
            echo var_dump($fechaNac) . '<br>';
            echo var_dump($estadoCivil) . '<br>';
            echo var_dump($experiencia) . '<br>';
            echo var_dump($experienciaDonde) . '<br>';
            echo var_dump($turnoInteres) . '<br>';
        }
        else {
            echo "<script>
                alert('hubo un error');
                location.href = 'index.php';
                </script>";
            }
        }
        mysqli_close($conexion);
?>