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
    $o['tag'] = 'registrujGToken';
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

if ($getResponce) {


    $djDec = json_decode($getResponce);
    $email = $djDec->email;
    $name = $djDec->name;
    $picture = $djDec->picture;
    $KomitentIme = $djDec->given_name;
    $KomitentPrezime = $djDec->family_name;
    $sifra = substr(md5(microtime()), rand(0, 26), 8);

    if (!$sifra) {
        $o['tag'] = 'register';
        $o['success'] = false;
        $o['error'] = 7;  // stavio sam svuda 1
        $o['error_msg'] = "There is no Password.";
    }


    if (($email && $sifra) || !$o['error_msg']) {
        // prebacijemo sifru u sha512

        $sifra = hash('sha512', $sifra);
        if (strlen($sifra) != 128) {
            // The hashed pwd should be 128 characters long.
            // If it's not, something really odd has happened
            $o['tag'] = 'register';
            $o['success'] = false;
            $o['error'] = 4;  // stavio sam svuda 1
            $o['error_msg'] = "Invalid password configuration.";

        }


        $db->where('KomitentEmail', $email);
        $dlim = $db->has("komitenti");
        if ($dlim) {
            // A user with this email address already exists
            $o['tag'] = 'register';
            $o['success'] = false;
            $o['error'] = 5;
            $o['error_msg'] = "A user with this email address already exists. ".$email;

        }


        // ako do sada nema ni jednog ERRORA
        if (empty($o['error_msg'])) {



            // Create a random salt
            $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

            // Create salted password
            // linija 66 za $sifra
            $password = hash('sha512', $sifra . $random_salt);

            $pieces = explode("@", $email);
            $emailIme = trim($pieces[0]);

            //proveravamo da li ima User Name od Korisnika
            $db->where('KomitentUserName', $emailIme);
            $dlim = $db->has("komitenti");
            if ($dlim) {
                $emailIme = $emailIme . rand(10, 500);
            }

            $insertData = Array(
                'KomitentEmail' => $email,
                'KomitentPassword' => $password,
                'KomitentSalt' => $random_salt,
                'KomitentUserName' => $emailIme,
                'KomitentIme' => $KomitentIme,
                'KomitentPrezime' => $KomitentPrezime,
                'KomitentActive' => 1,
                'KomitentIpAdresa' => $ipAdresa,
                'KomitentTipUsera' => 1 // obican korisnik
            );

            $id = '';
            try {
                // First of all, let's begin a transaction
                $db->startTransaction();

                // A set of queries; if one fails, an exception should be thrown
                $id = $db->insert('komitenti', $insertData);


                $db->commit();

            } catch (Exception $e) {
                // An exception has been thrown
                // We must rollback the transaction
                $db->rollback();
            }

            if ($id) {

                include_once 'posaljiMailRegistrujAndroid.php';


                $cols = Array("K.KomitentId", "K.VremeKomitent", "K.KomitentEmail", "K.KomitentUserName", "K.KomitentIme", "K.KomitentPrezime");
                $db->join("tipusera t", "K.KomitentTipUsera = t.IdTipUsera", "LEFT");
                $db->where('KomitentEmail', $email);
                $sadUpisan = $db->get("komitenti K", null, $cols);
                // ako smo dobro upisali, jos jednom da proverimo

                if ($error['StatusCodeMail']) {
                    if ($sadUpisan) {

                        $o['tag'] = 'register';
                        $o['success'] = true;
                        $o['error'] = 0;
                        $o['uid'] = $id;
                        $o['user']['KomitentIme'] = $sadUpisan[0]['KomitentIme'];
                        $o['user']['KomitentPrezime'] = $sadUpisan[0]['KomitentPrezime'];
                        $o['user']['KomitentUserName'] = $sadUpisan[0]['KomitentUserName'];
                        $o['user']['email'] = $email;
                        $o['user']['created_at'] = $sadUpisan[0]['VremeKomitent'];

                    } else {

                        $o['tag'] = 'register';
                        $o['success'] = false;
                        $o['error'] = 6;
                        $o['error_msg'] = "Nema korisnika u bazi nakon što je registrovan";


                    }
                } else {
                    $o['tag'] = 'register';
                    $o['success'] = false;
                    $o['error'] = 8;
                    $o['error_msg'] = "Upisan u bazu ali nije poslat mail";

                }

            }

        }

    } else {

        $o['tag'] = 'registrujGToken';
        $o['success'] = false;
        $o['error'] = 3;  // stavio sam svuda 1
        $o['error_msg'] = "No Email od Code od something else";
        $o['error_msg_interni'] = "Nismo dobili dobar email ili nema sifre";

    }


} else {

    $o['tag'] = 'registrujGToken';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] = "No response on googleapis";
    $o['error_msg_interni'] = "Nismo dobili response od https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=";

}


echo json_encode($o, JSON_UNESCAPED_UNICODE);



?>