<?php
    // include class
    require('fpdf/fpdf.php');

    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $nombre = $_POST['nombre'];
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
    $curp = $_POST['curp'];
    $rfc = $_POST['rfc'];
    $nss = $_POST['nss'];
    $ine = $_POST['ine'];
    $nivelEstudios = utf8_decode($_POST['nivelEstudios']);
    $fechaNac = $_POST['fechaNac'];
    $estadoCivil = utf8_decode($_POST['estadoCivil']);
    $experiencia = $_POST['experiencia'];
    $experienciaDonde = utf8_decode($_POST['experienciaDonde']);
    $turnoInteres = $_POST['turnoInteres'];

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

    if ($nombre != null &&
        $telefono01 != null &&
        $email01 != null &&
        $curp != null &&
        $ine != null &&
        $fechaNac != null) {

        if (strlen($nombre) <= 0) { $mensajeError .= '-nombre- '; }
        if (!filter_var($email01, FILTER_VALIDATE_EMAIL)) { $mensajeError .= '-email-'; }
        if (!(strlen($telefono01) == 10)) { $mensajeError .= '-teléfono- '; }
        if (!(strlen($curp) == 18)) { $mensajeError .= '-curp- '; }
        if (!(strlen($ine) == 18)) { $mensajeError .= '-ine- '; }
        
        if (strlen($mensajeError) <= 0) {
            $sql = "INSERT INTO `postulantes` (`idPostulante`, `nombre`, `calleNumero`, `colonia`, `cp`, `ciudad`, `estado`, `telefono01`, `telefono02`, `email01`, `email02`, `beneficiario`, `curp`, `rfc`, `nss`, `ine`, `nivelEstudios`, `fechaNac`, `estadoCivil`, `experiencia`, `experienciaDonde`, `turnoInteres`) VALUES
            ('$idPostulante', '$nombre', '$calleNumero', '$colonia', $cp, '$ciudad', '$estado', $telefono01, $telefono02, '$email01', '$email02', '$beneficiario', '$curp', '$rfc', '$nss', '$ine', '$nivelEstudios', '$fechaNac', '$estadoCivil', '$experiencia', '$experienciaDonde', '$turnoInteres');";
            $query = mysqli_query($conexion, $sql);

            if ($query) {
                // create document
                $pdf = new FPDF();
                $pdf->AddPage();

                // config document
                $pdf->SetTitle('solicitud_' . $idPostulante);
                $pdf->SetAuthor('477TMK');
                $pdf->SetCreator('477TMK');

                // add title
                $pdf->SetFont('Arial', 'B', 24);
                $pdf->Cell(0, 10, 'Solicitud ' . $idPostulante, 0, 1);
                $pdf->Ln();

                // add text
                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(0, 7, utf8_decode('Mensaje de prueba.'), 0, 1);
                $pdf->Ln();

                // output file
                $pdf->Output('', 'fpdf-complete.pdf', true);

                echo "<script>
                alert('Datos guardados');
                location.href = 'datosEnviados.php/?nombre=" . $nombre ."';
                </script> <br>";
            } 
            else { echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>"; }
        }
        else {
            $mensajeError .= ' formato equivocado';
            echo "<script>
                alert('$mensajeError');
                location.href = 'index.php?" . $nombre ."';
                </script>";
            }
        }
        mysqli_close($conexion);
?>