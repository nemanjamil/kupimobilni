<?php

function cleanDataForMail($str)
{
    $str = urldecode($str);
    $str = filter_var($str, FILTER_SANITIZE_STRING);
    $str = filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
    return $str;
}


if (isset($_POST['email'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
} else {
    $email = '';
}

if ($email) {
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $m['tag'] = 'posaljiMailAndr';
        $m['success'] = false;
        $m['error'] = 0;
        $m['error_msg'] = 'The email address you entered is not valid';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;
    }
}

$pitanje = cleanDataForMail($_POST['pitanje']);

if ($email) {


    $bodyMail .= '<h1>Hvala na Postavljenom Pitanju</h1>';
    $bodyMail .= '<div><b>Postavio pitanje : ' . $email . '</b></div><br>';

    $bodyMail .= '<div style="margin: 10px;border: 1px solid #003f81;padding:0 0 0 15px;background-color: #d9edf7">';
    $bodyMail .= '<div>' . $pitanje . '</div>';
    $bodyMail .= '</div>';


    /*
    $bodyMail .= '<div style="margin: 10px;border: 1px solid #003f81;padding:0 0 0 15px;background-color: #dedede">';
    $bodyMail .= '<div>Artikal : <a href="' . DPROOT . '/' . $ArtikalLink . '">' . $ArtikalNaziv . '</a></div>';
    $bodyMail .= '</div>';*/


    require RB_ROOT . '/PHPMailer-master/PHPMailerAutoload.php';

    require('../obradi/postavkaZaSlanjeMaila.php');
    $mail->addAddress($email, 'Postavljno pitanje');     // Add a recipient
    $mail->addReplyTo($email, '');
    $mail->addCC(GLAVNIMAIL);
    // $mail->addBCC(GLAVNIMAIL);
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    $mail->Subject = 'Postavio pitanje ' . $email;
    $mail->Body = $bodyMail;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        $m['tag'] = 'posaljiMailAndr';
        $m['success'] = false;
        $m['error'] = 1;
        $m['error_msg'] = 'Nije poslat mail';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;
    } else {
        $m['tag'] = 'posaljiMailAndr';
        $m['success'] = true;
        $m['error'] = 2;
        $m['error_msg'] = 'OK poslat mail';
    }


} else {
    $m['tag'] = 'posaljiMailAndr';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = 'Nema Email';
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);

?>