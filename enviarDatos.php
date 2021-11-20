<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/Exception.php';
    require './PHPMailer/PHPMailer.php';
    require './PHPMailer/SMTP.php';
    require('./fpdf/fpdf.php');

    $id = $_GET['id'];
    $mailFrom = 'cuenta.prueba.dguez@gmail.com';

    // Conexion
    $conexion = mysqli_connect("localhost", "root", "root", "formulario_postulacion");
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    // Recuperar destinatarios
    $sql = "SELECT * FROM destinatarios";
    $query = mysqli_query($conexion, $sql);
    if ($query) {
        $correosDest = array();
        $nombresDest = array();
        $cont = 0;
        while ($row = @mysqli_fetch_array($query)) {
            $correosDest[$cont] = $row['correo'];
            $nombresDest[$cont] = $row['nombre'];
            $cont++;
        }
    }
    else {
        die("Destinatarios no recuperados correctamente: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM postulantes WHERE `idPostulante` = '$id';";
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        //Obtener Datos
        $datos = mysqli_fetch_array($query);
        $nombre = $datos['nombre'];
        $calleNumero = $datos['calleNumero'];
        $colonia = $datos['colonia'];
        $cp = (int)$datos['cp'];
        $ciudad = $datos['ciudad'];
        $estado = $datos['estado'];
        $telefono01 = (int)$datos['telefono01'];
        $telefono02 = (int)$datos['telefono02'];
        $email01 = $datos['email01'];
        $email02 = $datos['email02'];
        $beneficiario = $datos['beneficiario'];
        $curp = $datos['curp'];
        $rfc = $datos['rfc'];
        $nss = $datos['nss'];
        $ine = $datos['ine'];
        $nivelEstudios = $datos['nivelEstudios'];
        $fechaNac = $datos['fechaNac'];
        $estadoCivil = $datos['estadoCivil'];
        $experiencia = $datos['experiencia'];
        $experienciaDonde = $datos['experienciaDonde'];
        $turnoInteres = $datos['turnoInteres'];

        $mail = new PHPMailer(true); //Crear instancia de email

        class PDF extends FPDF {
            function Header()
            {
                $this->SetFont('Arial','',14);
                $this->Cell(80);
                $this->Image('./img/logo.png', 150, 10, 32);
                $this->Ln(20);
            }
        }
        $pdf=new PDF(); //Crear PDF
        //Formato de PDF
        $pdf->SetMargins(20, 20, 20);
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(80,10,'Solicitud ' . $id);
        $pdf->Ln();
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(60,10, 'Id', 1, 0, 'R');
        $pdf->Cell(110,10, $id, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Nombre', 1, 0, 'R');
        $pdf->Cell(110,10, $nombre, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, utf8_decode('Calle y número'), 1, 0, 'R');
        $pdf->Cell(110,10, $calleNumero, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Colonia', 1, 0, 'R');
        $pdf->Cell(110,10, $colonia, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, utf8_decode('Código postal'), 1, 0, 'R');
        $pdf->Cell(110,10, $cp, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Ciudad', 1, 0, 'R');
        $pdf->Cell(110,10, $ciudad, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Estado', 1, 0, 'R');
        $pdf->Cell(110,10, $estado, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, utf8_decode('Teléfono 1'), 1, 0, 'R');
        $pdf->Cell(110,10, $telefono01, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, utf8_decode('Teléfono 2'), 1, 0, 'R');
        $pdf->Cell(110,10, $telefono02, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Email 1', 1, 0, 'R');
        $pdf->Cell(110,10, $email01, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Email 2', 1, 0, 'R');
        $pdf->Cell(110,10, $email02, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Beneficiario', 1, 0, 'R');
        $pdf->Cell(110,10, $beneficiario, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Curp', 1, 0, 'R');
        $pdf->Cell(110,10, $curp, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'RFC', 1, 0, 'R');
        $pdf->Cell(110,10, $rfc, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'NSS', 1, 0, 'R');
        $pdf->Cell(110,10, $nss, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'INE', 1, 0, 'R');
        $pdf->Cell(110,10, $ine, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Nivel de estudios', 1, 0, 'R');
        $pdf->Cell(110,10, $nivelEstudios, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Fecha de nacimiento', 1, 0, 'R');
        $pdf->Cell(110,10, $fechaNac, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Estado civil', 1, 0, 'R');
        $pdf->Cell(110,10, $estadoCivil, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Experiencia', 1, 0, 'R');
        $pdf->Cell(110,10, $experiencia, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, 'Experiencia en', 1, 0, 'R');
        $pdf->Cell(110,10, $experienciaDonde, 1, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(60,10, utf8_decode('Turno de interés'), 1, 0, 'R');
        $pdf->Cell(110,10, $turnoInteres, 1, 0, 'R');
        $pdf->Ln();

        $pdfDoc = $pdf->Output('F', './pdf/solicitud_' . $id . '.pdf');

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $mailFrom;
            $mail->Password   = 'amaz0N_pand1tA_24';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Attachments
            $mail->AddAttachment('./pdf/solicitud_' . $id . '.pdf', '', $encoding = 'base64', $type = 'application/pdf');

            //Recipients
            $mail->setFrom($mailFrom, 'Antonio Dominguez');

            for ($i=0; $i < sizeof($correosDest); $i++) { 
                $mail->addAddress($correosDest[$i], $nombresDest[$i]);
            }

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Empleo Enviada por ' . $nombre;
            $mail->Body    = 'Solicitud <b>' . $id . '</b><br>';

            $mail->send();
            $nombreEncode = utf8_encode($nombre);
            
            //Verificar si hay que limpiar server
            $idSubstr = substr($id, -1);
            if ($idSubstr == '1'){
                echo "<script>
                    location.href = './php/liberarArchivos.php?nombre=$nombreEncode';
                </script>'";
            }
            
            echo "<script>
                location.href = 'vDatosEnviados.php?nombre=$nombreEncode';
            </script>'";
        } catch (Exception $e) {
            echo "Mensaje no enviado. Error: {$mail->ErrorInfo}";
        }
    } 
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion) . "<br>";
    }

    mysqli_close($conexion);
?>