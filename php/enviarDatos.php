<!DOCTYPE html>
<html lang="es">
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
    require_once('../477-admin/config/config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
    require('../fpdf/fpdf.php');

    $id = $_GET['id'];

    // Conexion
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$conexion) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    // Recuperar destinatarios
    $sql = "SELECT * FROM usuarios WHERE estatus=1 AND estatusCorreo=1";
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
            'Turno de interés'
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

        $mail = new PHPMailer(true); //Crear instancia de email

        class PDF extends FPDF {
            function Header()
            {
                $this->SetFont('Arial','',12);
                $this->SetTextColor(102, 108, 100);
                $this->Image('../img/logo.png', 90, 10, 32);
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

        $pdfDoc = $pdf->Output('F', '../pdf/solicitud_' . $id . '.pdf');

        try {
            //Server settings PHPMailer::ENCRYPTION_SMTPS
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.ionos.mx';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'rh@477tmk.mx';
            $mail->Password   = '#rh.477Tmk@';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Attachments
            $mail->AddAttachment('../pdf/solicitud_' . $id . '.pdf', '', $encoding = 'base64', $type = 'application/pdf');

            //Recipients
            $mail->setFrom('rh@477tmk.mx', 'rh');

            for ($i=0; $i < sizeof($correosDest); $i++) { 
                $mail->addAddress($correosDest[$i], $nombresDest[$i]);
            }

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Empleo enviada por ' . $datos['nombre'];
            $mail->Body    = utf8_decode('Solicitud <b>' . $id . '</b><br><br>' .
                'Nombre: <b>' . $datos['nombre'] . '</b><br>' .
                'Email: <b>' . $datos['email01'] . '</b><br>' .
                'Teléfono: <b>' . $datos['telefono01'] . '</b><br><br>' .
                'Iniciar conversación:<br>
                https://api.whatsapp.com/send?phone=+52' . $datos['telefono01'] . '&text=Hola%20te%20contactamos%20desde%20477TMK');

            $mail->send();
            $nombreEncode = utf8_encode($datos['nombre']);
            
            echo "<script>
                location.href = '../datos-enviados.php?nombre=$nombreEncode';
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