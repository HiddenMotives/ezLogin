<?php
require 'ezLogin.php';
require 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

if(USE_SMTP) {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    if(SMTP_AUTH) {
        $mail->SMTPAuth = SMTP_AUTH;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port = SMTP_PORT;
    }
}

$mail->From = FROM_EMAIL;
$mail->FromName = FROM_NAME;

function sendMail($to, $subject, $body) {
    global $mail;
    $mail->addAddress($to);

    $mail->Subject = $subject;
    $mail->msgHTML($body);

    if($mail->send()) {
        return true;
    } else {
        error_log($mail->ErrorInfo);
        return false;
    }
}