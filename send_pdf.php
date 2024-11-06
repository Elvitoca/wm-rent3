<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdfData = $_POST['pdf'];
    $fileName = $_POST['name'];

    // Decodifica el PDF
    $pdfContent = base64_decode($pdfData);

    // Guarda el archivo en el servidor
    $filePath = 'uploads/' . $fileName;
    file_put_contents($filePath, $pdfContent);

    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor de correo
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto a tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'iralavictor39@gmail.com'; // Tu correo electrónico
        $mail->Password = 'QcvZ?^yHy>7~sXV'; // Tu contraseña de correo
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Receptores
        $mail->setFrom('iralavictor39@gmail.com', 'Rent a Car WM');
        $mail->addAddress('recipient@example.com'); // Cambia esto al destinatario

        // Archivos adjuntos
        $mail->addAttachment($filePath);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nueva Reserva - Rent a Car WM';
        $mail->Body    = 'Adjunto encontrarás el PDF de la reserva.';

        $mail->send();
        echo 'Mensaje enviado correctamente';
    } catch (Exception $e) {
        echo "El mensaje no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
