<?php
$mail = new PHPMailer;
//$mail->SMTPDebug = 4;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->Debugoutput = 'html';
$mail->Host = 'mailcluster.loopia.se';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->SMTPAuth = true;
$mail->Username = GLAVNIMAIL;
$mail->Password = PASSMAIL;
$mail->From = GLAVNIMAIL;
$mail->FromName = FROMNAME;
$mail->isHTML(true);


?>