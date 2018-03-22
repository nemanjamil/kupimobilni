<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 29.7.15.
 * Time: 10.55
 */

require 'proveriAjaxDeny.php';

$db->where('KomitentEmail', $email);
$resultrows = $db->getOne("komitenti");

if ($resultrows) {

    $KomitentSalt = $resultrows['KomitentSalt'];

    if (!$KomitentSalt) {
        /*$KomitentSalt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        $data = Array(
            'KomitentSalt' => $KomitentSalt
        );
        $db->where('KomitentEmail', $email);
        $db->update('komitenti', $data);*/
        $sajt['testsajt'] = 'Nema salt';
        $sajt['error'] = false;
        echo json_encode($sajt,JSON_UNESCAPED_UNICODE);
        die;

    }

    $text = "Hvala što se inicirali promenu šifre sa email adrese <b>" . $email;
    $text .= "</b><br><br>";

    $text .= "Ako ste Vi poslali ovaj zahtev kliknite na ovaj link kako bi dobili novu šifru -
    <a href=\"" . DPROOT . "/proverasifre/" . $KomitentSalt . "\">LINK</a>. <br> Ukoliko to niste bili Vi, slobodno ignorišite ovaj mail.";
    $text .= "<br><br>S poštovanjem, <br>" . GLAVNIMAIL;

    $message .= "<html><body>";
    $message .= $text;
    $message .= "</body></html>";

    $naslovmaila = 'Izmena Sifre za korisnika';

    require 'posaljiMail.php';



} else {

    $sajt['testsajt'] = 'Nema datog maila u bazi';
    $sajt['error'] = false;
}
echo json_encode($sajt,JSON_UNESCAPED_UNICODE);


?>