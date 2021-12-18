<?php
    require_once('../../fpdf/fpdf.php');
    require_once('../config/config.php');

    $correo = $_GET['correo'];

    // Conexion
    require_once('../modelos/Conexion.php');

    // Recuperar destinatarios
    $sql = "SELECT * FROM solicitudesrapidas WHERE `correo` = '$correo';";
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        //Obtener Datos
        $campos = array(
            'Correo',
            'Nombre',
            'Teléfono',
            'Lunes',
            'Martes',
            'Miercoles',
            'Jueves',
            'Viernes',
            'Sabado',
            'Hora inicio',
            'Hora final',
            'Fecha de registro'
        );

        $datos = mysqli_fetch_array($query);
        $datosArray = array();

        array_push($datosArray, $datos['correo']);
        array_push($datosArray, $datos['nombre']);
        array_push($datosArray, (int)$datos['telefono']);
        array_push($datosArray, $datos['lunes']);
        array_push($datosArray, $datos['martes']);
        array_push($datosArray, $datos['miercoles']);
        array_push($datosArray, $datos['jueves']);
        array_push($datosArray, $datos['viernes']);
        array_push($datosArray, $datos['sabado']);
        array_push($datosArray, $datos['horaInicio']);
        array_push($datosArray, $datos['horaFinal']);
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
        $pdf->Cell(140,10, utf8_decode('Solicitud rápida'), 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',14);

        
        for ($i=0; $i < sizeof($datosArray); $i++) { 
            $pdf->SetTextColor(0, 108, 184);
            $pdf->Cell(60,10, utf8_decode($campos[$i]) . ':', 0, 0, 'R');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(10, 10);

            if ($datosArray[$i] == 1) {
                $pdf->SetTextColor(0, 170, 0);
                $pdf->Cell(60,10, 'Disponible', 0, 0, 'L');
            }
            else if ($datosArray[$i] == '0') {
                $pdf->SetTextColor(210, 0, 0);
                $pdf->Cell(60,10, 'No disponible', 0, 0, 'L');
            }
            else {
                $pdf->Cell(60,10, $datosArray[$i], 0, 0, 'L');
            }

            $pdf->Ln();
        }

        $pdfDoc = $pdf->Output('', '../pdf/solicitud-rapida_' . $correo . '.pdf');
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }

    mysqli_close($conexion);
?>