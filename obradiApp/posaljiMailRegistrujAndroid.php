<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 28.7.15.
 * Time: 07.57
 */

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

require('../obradi/postavkaZaSlanjeMaila.php');
$mail->addAddress($email, 'Nov Korisnik');     // Add a recipient
//$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
//$mail->addCC(GLAVNIMAIL);
$mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->Subject = 'Registracija korisnika '.$email;
$mail->Body = $bodyMail;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->send()) {
   $error['ErrorMessageMail'] = 'Message could not be sent.'.' '.$mail->ErrorInfo;
   $error['StatusCodeMail'] = false;
} else {
   $error['ErrorMessageMail'] = 'Poslat mail';
   $error['StatusCodeMail'] = true;
}


?>