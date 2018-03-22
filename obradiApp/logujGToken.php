<?php

//require 'proveriAjaxDeny.php';
$o['error_msg'] = '';
/*$postdata = file_get_contents("php://input");
$postdata = $_GET; // ovo nam nece trebati jer ce ici POST, ali nam je potrebno za test*/


if (isset($_POST['token'])) {
    $string = filter_var($_POST['token'], FILTER_SANITIZE_STRING);
} else {
    $string = '';
}
$linkDoTokena = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=";

//$string = "eyJhbGciOiJSUzI1NiIsImtpZCI6IjhhYzNmMWYxODA1ODkwYmYxZWJmNDNkYmVmNjdhYjZmM2RhZjhjNGMifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJpYXQiOjE0NzkzOTcwNjcsImV4cCI6MTQ3OTQwMDY2NywiYXVkIjoiMzkzODQ5OTExNjI2LXIyZG9naWY4OTRiOGh0NG5sOGZxdWdzcGkybGw3M2VtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwic3ViIjoiMTE0MTYzNzY2MzM0MTc0Mzc0MDAzIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF6cCI6IjM5Mzg0OTkxMTYyNi1xZTcxY2E0YnFjN3ZvMjExbWNiazlqazM2ZWRjM2F1bi5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsImVtYWlsIjoiYWpkYWNpYy5kLmplbGVuYUBnbWFpbC5jb20iLCJuYW1lIjoiSmVsZW5hIEFqZGFjaWMiLCJwaWN0dXJlIjoiaHR0cHM6Ly9saDMuZ29vZ2xldXNlcmNvbnRlbnQuY29tLy1IbTlBUFBpWUIzOC9BQUFBQUFBQUFBSS9BQUFBQUFBQUFDWS9RMzBSbG1YWFV3RS9zOTYtYy9waG90by5qcGciLCJnaXZlbl9uYW1lIjoiSmVsZW5hIiwiZmFtaWx5X25hbWUiOiJBamRhY2ljIiwibG9jYWxlIjoiZW4ifQ.rW5UMe-WDPxg6jOO6I3mJbCnnZkEHaSOfRR3W08dPSNm58tMYf2PcEeOaLuySinPa9JBjqNg3hmcBH4S52_aazeeLofplUJmpXVcCbt3c6G8NsfKkkbIdYFHSMp4fG-P-4U2UvDfANHRD1AZLGBP73pgvGa4ZgtNWYfM15_dahutZl4TMqmIN2GahxKbgwInbfF7M2uFj7JX2DZZtoXBlqCUt2S7ptcTQ928Vi-xXOAVPFqe_8iTjuLrdgdJ3cNo91K2T5RY0QqjQh8wzeB56XsrnjyWP8Ew3lf5oEPfRZcOB8c9A2jIRE8aIXrWCNtf3yMvR7Ft-08HQn_czxj0fw";

if (empty($string)) {
    $o['tag'] = 'logujGToken';
    $o['success'] = false;
    $o['error'] = 0;  // stavio sam svuda 1
    $o['error_msg'] = "Token Not Exist";
    $o['error_msg_interni'] = "Ne postoji string token";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}


// dekodiraj token
require DCROOT . "/obradi/getCurlData.php";
$linkCurl = $linkDoTokena . $string;
$getResponce = getCurlData($linkCurl);

require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('Token : '.$string);
$log->lwrite('Ovo pozivam : '.$linkCurl);
$log->lwrite('Dobijam odgovor');
$log->lwrite($getResponce);
$log->lwrite('');

if ($getResponce) {



    $djDec = json_decode($getResponce);
    $email = $djDec->email;
    $name = $djDec->name;
    $picture = $djDec->picture;
    $KomitentIme = $djDec->given_name;
    $KomitentPrezime = $djDec->family_name;

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $log->lwrite('Log email : '.$email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $o['tag'] = 'register';
        $o['success'] = false;
        $o['error'] = 5;
        $o['error_msg'] =  "The email address you entered is not valid. ".$email;
    }

    if ($email || !$o['error_msg']) {

        $db->where('KomitentEmail', $email);
        $db->where('KomitentActive', 1);
        $sad = $db->getOne("komitenti");
        if ($sad) {

            $o['tag'] = 'logujGToken';
            $o['error'] = 0;
            $o['success'] = true;
            $o['uid'] = $sad['KomitentId'];
            $o['user']['KomitentNaziv'] = $sad['KomitentNaziv'];
            $o['user']['KomitentIme'] = $sad['KomitentIme'];
            $o['user']['KomitentPrezime'] = $sad['KomitentPrezime'];
            $o['user']['KomitentAdresa'] = $sad['KomitentAdresa'];
            $o['user']['KomitentPosBroj'] = $sad['KomitentPosBroj'];
            $o['user']['KomitentMesto'] = $sad['KomitentMesto'];
            $o['user']['KomitentTelefon'] = $sad['KomitentTelefon'];
            $o['user']['KomitentMobTel'] = $sad['KomitentMobTel'];
            $o['user']['KomitentEmail'] = $sad['KomitentEmail'];
            $o['user']['KomitentUserName'] = $sad['KomitentUserName'];
            $o['user']['KomitentTipUsera'] = $sad['KomitentTipUsera'];
            $o['user']['KomitentFirma'] = $sad['KomitentFirma'];
            $o['user']['KomitentMatBr'] = $sad['KomitentMatBr'];
            $o['user']['KomitentPIB'] = $sad['KomitentPIB'];
            $o['user']['KomitentFirmaAdresa'] = $sad['KomitentFirmaAdresa'];


        } else {

            $db->where('KomitentEmail', $email);
            $sad = $db->getOne("komitenti");
            if ($sad) {

                $o['tag'] = 'logujGToken';
                $o['success'] = false;
                $o['error'] = 4;
                $o['error_msg'] = 'User is not Active';
                $o['error_msg_interni'] = "User is not Active";

            } else {
                $o['tag'] = 'logujGToken';
                $o['success'] = false;
                $o['error'] = 1;
                $o['error_msg'] = 'There is no User id';
                $o['error_msg_interni'] = "Ne postoji komitent u bazi ".$email;
            }
        }


    } /*else {

        $o['tag'] = 'logujGToken';
        $o['success'] = false;
        $o['error'] = 2;  // stavio sam svuda 1
        $o['error_msg'] = "No Email od Code od something else";
        $o['error_msg_interni'] = "Nismo dobili dobar email ili nema sifre";

    }*/


} else {

    $o['tag'] = 'logujGToken';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] = "No response on googleapis";
    $o['error_msg_interni'] = "Nismo dobili response od https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=";

}


echo json_encode($o, JSON_UNESCAPED_UNICODE);


?>