<?php
    require_once('../../fpdf/fpdf.php');
    require_once('../config/config.php');

    $id = $_GET['id'];

    // Conexion
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    // Recuperar destinatarios
    $sql = "SELECT * FROM candidatos WHERE `idPostulante` = '$id';";
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        //Obtener Datos
        $campos = array(
            'Nombre',
            'Calle y número',
            'Colonia',
            'Código postal',
            'Ciudad',
            'Estado',
            'Teléfono 1',
            'Teléfono 2',
            'Email 1',
            'Email 2',
            'Beneficiario',
            'Curp',
            'RFC',
            'NSS',
            'INE',
            'Nivel de estudios',
            'Fecha de nacimiento',
            'Estado civil',
            'Experiencia',
            'Experiencia en',
            'Turno de interés',
            'Fecha de registro'
        );

        $datos = mysqli_fetch_array($query);
        $datosArray = array();

        array_push($datosArray, $datos['nombre']);
        array_push($datosArray, $datos['calleNumero']);
        array_push($datosArray, $datos['colonia']);
        array_push($datosArray, (int)$datos['cp']);
        array_push($datosArray, $datos['ciudad']);
        array_push($datosArray, $datos['estado']);
        array_push($datosArray, (int)$datos['telefono01']);
        array_push($datosArray, (int)$datos['telefono02']);
        array_push($datosArray, $datos['email01']);
        array_push($datosArray, $datos['email02']);
        array_push($datosArray, $datos['beneficiario']);
        array_push($datosArray, $datos['curp']);
        array_push($datosArray, $datos['rfc']);
        array_push($datosArray, $datos['nss']);
        array_push($datosArray, $datos['ine']);
        array_push($datosArray, $datos['nivelEstudios']);
        array_push($datosArray, $datos['fechaNac']);
        array_push($datosArray, $datos['estadoCivil']);
        array_push($datosArray, $datos['experiencia']);
        array_push($datosArray, $datos['experienciaDonde']);
        array_push($datosArray, $datos['turnoInteres']);
        array_push($datosArray, $datos['fechaRegistro']);

        class PDF extends FPDF {
            function Header()
            {
                $this->SetFont('Arial','',12);
                $this->SetTextColor(102, 108, 100);
                $this->Image('../../img/logo.png', 90, 10, 32);
                $this->Ln(20);
            }
        }
        $pdf=new PDF(); //Crear PDF
        //Formato de PDF
        $pdf->SetMargins(40, 20, 40);
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->SetTextColor(0, 108, 184);
        $pdf->Cell(140,10,'Solicitud ' . $id, 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',14);

        
        for ($i=0; $i < sizeof($datosArray); $i++) { 
            $pdf->SetTextColor(0, 108, 184);
            $pdf->Cell(60,10, utf8_decode($campos[$i]) . ':', 0, 0, 'R');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(10, 10);
            $pdf->Cell(60,10, $datosArray[$i], 0, 0, 'L');
            $pdf->Ln();
        }

        $pdfDoc = $pdf->Output('', '../pdf/solicitud_' . $id . '.pdf');
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }

    mysqli_close($conexion);
?>