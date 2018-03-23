<?php
require RB_ROOT.'/PHPMailer-master/PHPMailerAutoload.php';
require('postavkaZaSlanjeMaila.php');

$mail->addAddress($email, 'Izmena Maila');     // Add a recipient
//$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
//$mail->addCC('cc@example.com');
$mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->Subject = $naslovmaila;
$mail->Body = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->send()) {
    /*echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    die;*/
    $poslatMail = false;
    $sajt['testsajt'] = 'Nije poslat mail';
    $sajt['error'] = false;

} else {
    $poslatMail = true;
    $sajt['testsajt'] = 'Poslat mail';
    $sajt['error'] = true;
    /*echo 'OK poslat mail';*/
}



?>