<?php
    $id = $_GET['id'];
    $mailTo = 'tony_dominguezt@outlook.com';
    $mailFrom = 'tony_dominguezt@outlook.com';
    $mailSubject = 'Solicitud: ' . $id;

    require('fpdf/fpdf.php');
    
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,$id);
    $pdfDoc = $pdf->Output('I', $id, true);

    $message = "<p>Consulte el archivo adjunto.</p>";
    $separator = md5(time());
    $eol = PHP_EOL;
    $filename = $id;
    $attachment = chunk_split(base64_encode($pdfdoc));

    //Headers
    $headers = "From: " . $mailFrom . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

    $body = '';
    $body .= "Content-Transfer-Encoding: 7bit" . $eol;
    $body .= "This is a MIME encoded message." . $eol; //had one more .$eol


    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
    $body .= $message . $eol;


    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol . $eol;
    $body .= $attachment . $eol;
    $body .= "--" . $separator . "--";

    $sentEmail = mail($mailTo, $mailSubject, $body, $headers);
    if ($sentEmail) {
        echo 'Mensaje Enviado';
    }
    else {
        echo 'Mensaje no enviado';
    }
?>