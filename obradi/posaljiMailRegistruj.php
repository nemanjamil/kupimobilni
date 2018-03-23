<?php
$bodyMail .= '<h1>Hvala na REGISTRACIJI</h1>';
$bodyMail .= '<div><b>Molimo Vas kliknite na link ispod i aktivirajte nalog : </b></div><br>';

$bodyMail .= '<div style="margin: 10px;border: 1px solid #003f81;padding:0 0 0 15px;background-color: #d9edf7">';
$bodyMail .= '<div><a href="'.BASE_URL.'provera/'.$random_salt.'">AKTIVIRAJTE NALOG</a></div>';
$bodyMail .= '</div>';


/*
$bodyMail .= '<div style="margin: 10px;border: 1px solid #003f81;padding:0 0 0 15px;background-color: #dedede">';
$bodyMail .= '<div>Artikal : <a href="' . DPROOT . '/' . $ArtikalLink . '">' . $ArtikalNaziv . '</a></div>';
$bodyMail .= '</div>';*/

require RB_ROOT.'/PHPMailer-master/PHPMailerAutoload.php';
require('postavkaZaSlanjeMaila.php');
$mail->addAddress($email, 'Nov Korisnik');     // Add a recipient
//$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
//$mail->addCC('cc@example.com');
$mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->Subject = 'Registracija korisnika '.$email;
$mail->Body = $bodyMail;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->send()) {
    $erroropis['tekst'] = 'Message could not be sent.';
    $erroropis['detaljno'] = 'Mailer Error: ' . $mail->ErrorInfo;
    $erroropis['status'] = false;
    //die;
} else {
    $erroropis['tekst'] = 'OK poslat mail';
    $erroropis['status'] = true;

}


?>