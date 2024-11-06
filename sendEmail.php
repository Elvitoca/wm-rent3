<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    $pdfFile = $_FILES['pdf']['tmp_name'];
    $pdfName = $_FILES['pdf']['name'];

    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Cambia esto a tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_email@example.com'; // Cambia esto a tu email
        $mail->Password = 'tu_contraseña'; // Cambia esto a tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587;

        // Receptores
        $mail->setFrom('tu_email@example.com', 'Rent a Car WM');
        $mail->addAddress('destinatario@example.com'); // Cambia esto al destinatario

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Reserva Rent a Car WM';
        $mail->Body = 'Adjunto encontrarás tu reserva.';

        // Adjuntar el PDF
        $mail->addAttachment($pdfFile, $pdfName);

        $mail->send();
        echo 'Correo enviado correctamente.';
    } catch (Exception $e) {
        echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }
}
?>
