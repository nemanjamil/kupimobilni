<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 29.7.15.
 * Time: 10.55
 */


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
    $text .= "<br><br>";

    $text .= "Ako ste Vi poslali ovaj zahtev kliknite na ovaj link kako bi dobili novu šifru -
    <a href=\"" . DPROOT . "/proverasifre/" . $KomitentSalt . "\">LINK</a>. <br> Ukoliko to niste bili Vi, slobodno ignorišite ovaj mail.";
    $text .= "<br><br>S poštovanjem, <br>" . GLAVNIMAIL;

    $message .= "<html><body>";
    $message .= $text;
    $message .= "</body></html>";

    $naslovmaila = 'Izmena Sifre za korisnika';

    require 'posaljiMail.php';

    if ($poslatMail) {
        $o['tag'] = 'izgsifra';
        $o['success'] = true;
        $o['error'] = 0;  // stavio sam svuda 1
        $o['error_msg'] =  "Poslat mail";
    } else {
        $o['tag'] = 'izgsifra';
        $o['success'] = false;
        $o['error'] = 2;  // stavio sam svuda 1
        $o['error_msg'] =  "Nije poslat mail";
    }


} else {

    $o['tag'] = 'izgsifra';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema datog maila u bazi";
    $o['error_msg_opis'] =  $db->getLastError();

}

echo json_encode($o,JSON_UNESCAPED_UNICODE);


/*
if ($resultrows) {

    $KomitentId = $resultrows['KomitentId'];
    $KomitentEmail = $resultrows['KomitentEmail'];
    $passwordorg1 = rand(100,1000);
    $passwordorg = hash('sha512', $passwordorg1);
    $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
    $password = hash('sha512', $passwordorg . $random_salt);

    $data = Array(
        'KomitentPassword' => $password,
        'KomitentSalt' => $random_salt
    );
    $db->where('KomitentId', $KomitentId);
    if ($db->update('komitenti', $data)) {

        //  $opis = $db->count . ' records were updated <br/>';
        $opis .= '<div class="alert alert-success"> <strong>NOVA SIFRA ! </strong> Uspešno ste promenuli šifru. Vaša nova šifra je : <b>'.$passwordorg1.'</b></div>';;
        $opis .= '<div class="alert alert-danger"> <strong>Paznja ! </strong> Molimo Vas da je zapamtite, zapišete, ili što pre promenite ovu šifru u vašem profilu</div>';
        $opis .= '<div class="alert alert-info"> <strong>Info LogIn ! </strong> Molimo da se ponovo <a href="/login">ulogujte</a>  na sistem koristeći novu šifru.</div>';
        $opis .= '<br/>';

    } else {
        $opis = 'update failed: ' . $db->getLastError();
        $opis .= 'Nije uspešno promenjena šifra';
    }


} else {

    $opis = 'Nema takvog salta u bazi';
}*/


?>