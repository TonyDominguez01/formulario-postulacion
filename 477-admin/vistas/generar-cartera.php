<?php
    require_once('../../fpdf/fpdf.php');
    require_once('../config/config.php');

    // Conexion
    require_once('../modelos/Conexion.php');

    // Recuperar destinatarios
    $sql = "SELECT `nombre`, `telefono01`, `telefono02`, `email01`, `email02` FROM postulantes";
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        //Obtener Datos
        $campos = array(
            'Nombre',
            'Teléfono 1',
            'Teléfono 2',
            'Email 1',
            'Email 2'
        );

        $datos = mysqli_fetch_array($query);

        $nombres = array();
        $telefonos01 = array();
        $telefonos02 = array();
        $emails01 = array();
        $emails02 = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $nombres[$cont] = utf8_encode($row['nombre']);
            $telefonos01[$cont] = $row['telefono01'];
            $telefonos02[$cont] = $row['telefono02'];
            $emails01[$cont] = $row['email01'];
            $emails02[$cont] = $row['email02'];
            $cont++;
        }

        class PDF extends FPDF {
            function Header()
            {
                $this->SetFont('Arial','',12);
                $this->SetTextColor(102, 108, 100);
                $this->Image('../../img/logo.png', 130, 10, 32);
                $this->Ln(20);
            }
        }
        $pdf=new PDF(); //Crear PDF
        //Formato de PDF
        $pdf->SetMargins(30, 20, 30);
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','B',16);
        $pdf->SetTextColor(0, 108, 184);
        $pdf->Cell(235,10,'Cartera de Candidatos', 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','B',14);

        $pdf->Cell(47,8, 'Nombre', 0, 0, 'L');
        $pdf->Cell(47,8, utf8_decode('Teléfono 1'), 0, 0, 'L');
        $pdf->Cell(47,8, utf8_decode('Teléfono 2'), 0, 0, 'L');
        $pdf->Cell(47,8, 'Email 1', 0, 0, 'L');
        $pdf->Cell(47,8, 'Email 2', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial','',12);

        for ($i=0; $i < sizeof($nombres); $i++) { 
            $pdf->Cell(47,8, utf8_decode($nombres[$i]), 0, 0, 'L');
            $pdf->Cell(47,8, utf8_decode($telefonos01[$i]), 0, 0, 'L');
            $pdf->Cell(47,8, utf8_decode($telefonos02[$i]), 0, 0, 'L');
            $pdf->Cell(47,8, utf8_decode($emails01[$i]), 0, 0, 'L');
            $pdf->Cell(47,8, utf8_decode($emails02[$i]), 0, 0, 'L');
            $pdf->Ln();
        }

        $pdfDoc = $pdf->Output('', '../pdf/cartera.pdf');
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }

    mysqli_close($conexion);
?>