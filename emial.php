<?php
require 'PHPMailer/PHPMailerAutoload.php';

$sender_email = 'ihelpbdtest@gmail.com';
$sender_mail_password = 'xdunngyogngirfon';
$sender_name = 'Google';
// $receiver_email = 'shantakhananisa@gmail.com';
$receiver_email = 'amirhamja422@gmail.com';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = $sender_email;
$mail->Password = $sender_mail_password;
$mail->SetFrom($sender_email, $sender_name);
$mail->Subject = 'Anisha';
$mail->Body = 'Dear Gadha';
$mail->AddAddress($receiver_email);

if (!$mail->send()) {
    echo $mail->ErrorInfo . '<br>';
} else {
    echo 'Email has been sent. <br>';
}