<?php
//require 'proveriAjaxDeny.php';
$KomentarKomentari = $common->clearvariable($_POST['komentar']);

$recaptcha = $_POST['g-recaptcha-response'];
if (!empty($recaptcha)) {
    include("getCurlData.php");
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6LdTzEkUAAAAAInKAzi_mMCuhgTmsY5gV_hPxMlN';
    //$secret = '6LeTYBcTAAAAAJ1NwgkORz3wp0eBYwV39qb8gGrk';
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=" . $ip;
    $res = getCurlData($url);
    $res = json_decode($res, true);
//reCaptcha success check
    if ($res['success']) {


        if ($email) {


            $bodyMail .= '<h1>Hvala na Postavljenom Pitanju</h1>';
            $bodyMail .= '<div><b>Postavio pitanje : '.$email.'</b></div><br>';

            $bodyMail .= '<div style="margin: 10px;border: 1px solid #003f81;padding:0 0 0 15px;background-color: #d9edf7">';
            $bodyMail .= '<div>'.$KomentarKomentari.'</div>';
            $bodyMail .= '</div>';


            /*
            $bodyMail .= '<div style="margin: 10px;border: 1px solid #003f81;padding:0 0 0 15px;background-color: #dedede">';
            $bodyMail .= '<div>Artikal : <a href="' . DPROOT . '/' . $ArtikalLink . '">' . $ArtikalNaziv . '</a></div>';
            $bodyMail .= '</div>';*/




            require RB_ROOT.'/PHPMailer-master/PHPMailerAutoload.php';

            require('postavkaZaSlanjeMaila.php');
            $mail->addAddress($email, 'Postavljno pitanje');     // Add a recipient
            $mail->addReplyTo($email, '');
            $mail->addCC(GLAVNIMAIL);
           // $mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $mail->Subject = 'Postavio pitanje '.$email;
            $mail->Body = $bodyMail;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                $error_msg = 'Message could not be sent.';
                $error_msg .= 'Mailer Error: ' . $mail->ErrorInfo;
                die;
            } else {
                $error_msg = 'OK poslat mail';

            }


        } else {
            $error_msg = 'No email or IdArticle';
        }


    } else {
        $error_msg = "Please re-enter your reCAPTCHA.";
    }

} else {
    $error_msg = "Please re-enter your reCAPTCHA.";
}


header("Location: /hvala-na-pitanju?e=".$error_msg);
?>

