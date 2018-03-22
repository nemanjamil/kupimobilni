<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 28.7.15.
 * Time: 07.57
 */

$langjsonfile = file_get_contents(DCROOT.'/cron/crongotovo/langNew.json');
$jsonlang = json_decode($langjsonfile,true); // ako je ,true onda je array

$osnPodFile = file_get_contents(DCROOT.'/cron/crongotovo/osnovnipodaci.json');
$jsonOsn = json_decode($osnPodFile,true); // ako je ,true onda je array



$bodyMail = '';

$bodyMail .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
$bodyMail .= '<html xmlns="http://www.w3.org/1999/xhtml">';

require ('mail/headmail.php');

$bodyMail .= '<center>';
    $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">';
            $bodyMail .= '<tr>';
                $bodyMail .= '<td align="center" valign="top" id="bodyCell">';
                    $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="600" id="emailBody">';

                    require ('mail/titlemail.php');

                    require ('mail/podaciKupacmail.php');

                    require ('mail/podaciProdavcimail.php');

                    require ('mail/podaciArtikliUnregistrated.php');

                    require ('mail/ostalimail.php');


                    $bodyMail .= '</table>';
                $bodyMail .= '</td>';
            $bodyMail .= '</tr>';

    $bodyMail .= '</table>';
$bodyMail .= '</center>';

$bodyMail .= '</body>';
$bodyMail .= '</html>';



require RB_ROOT.'/PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 4;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = GLAVNIMAIL;  // kpoybpurvlplpqlu rizuhphjjczomrvk itclusterserbia@gmail.com
$mail->Password = PASSMAIL;
$mail->From = GLAVNIMAIL;
$mail->FromName = FROMNAME;
$mail->isHTML(true);
$mail->addAddress($email, $KomitentIme.' '.$KomitentPrezime);     // Add a recipient
//$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
//$mail->addCC('cc@example.com');
$mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->Subject = 'Kupovina - '.$email.' -> '.$idNar;
$mail->Body = $bodyMail;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->send()) {
    $error_msg = 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
    $poslatMail = false;
    die;
} else {
    $error_msg = true;
    $poslatMail = true;
}


?>