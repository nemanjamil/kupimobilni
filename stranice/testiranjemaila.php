<?php
echo 'testiranje SSL';
echo '</br>';
echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
echo '</br>';
echo '</br>';



require RB_ROOT.'/PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->SMTPDebug = 4;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPAutoTLS = false;
$mail->Debugoutput = 'html';
//$mail->Host = 'mailcluster.loopia.se:587';
$mail->Host = 'tls://mailcluster.loopia.se:587';

//$mail->Port = 587;
//$mail->SMTPAuth = false;
//$mail->SMTPSecure = false;
//$mail->SMTPSecure = 'tls';
/*$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);*/
//$mail->SMTPAuth = true;
$mail->Username = GLAVNIMAIL;
$mail->Password = PASSMAIL;
$mail->From = GLAVNIMAIL;
$mail->FromName = FROMNAME;
$mail->isHTML(true);

$mail->addAddress('nemanjamil@gmail.com', 'Nemanja Mil');     // Add a recipient
//$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
//$mail->addCC('cc@example.com');
$mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->Subject = "Naslov Test";
$mail->Body = "Body";
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

echo '</br>';
echo $sajt['testsajt'];