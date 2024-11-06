<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    $pdfFile = $_FILES['pdf']['tmp_name'];
    $recipientEmail = 'elvitoca@gmail.com'; // Cambia por la dirección de destino

    $subject = 'Nueva Reserva de Rent a Car WM';
    $message = 'Se ha generado un nuevo pedido de alquiler.';

    $boundary = md5(time());

    // Cabeceras del correo
    $headers = "From: gerencia@rentacarwm.com.py\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    // Cuerpo del correo
    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";
    $body .= "--{$boundary}\r\n";
    $body .= "Content-Type: application/pdf; name=\"Reserva_Rent_a_Car_WM.pdf\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment; filename=\"Reserva_Rent_a_Car_WM.pdf\"\r\n\r\n";
    $body .= chunk_split(base64_encode(file_get_contents($pdfFile))) . "\r\n";
    $body .= "--{$boundary}--";

    // Enviar el correo
    if (mail($recipientEmail, $subject, $body, $headers)) {
        echo 'PDF enviado exitosamente.';
    } else {
        echo 'Error al enviar el PDF.';
    }
}
?>
