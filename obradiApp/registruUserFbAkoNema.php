<?php
$sifra = substr(md5(microtime()), rand(0, 26), 8);

if (!$sifra) {
    $o['tag'] = 'registrujFBusera';
    $o['success'] = false;
    $o['error'] = 7;  // stavio sam svuda 1
    $o['error_msg'] = "There is no Password.";
}


if (($email && $sifra) || !$o['error_msg']) {

    $sifra = hash('sha512', $sifra);
    if (strlen($sifra) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $o['tag'] = 'registrujFBusera';
        $o['success'] = false;
        $o['error'] = 4;  // stavio sam svuda 1
        $o['error_msg'] = "Invalid password configuration.";

    }


    $db->where('KomitentEmail', $email);
    $dlim = $db->has("komitenti");
    if ($dlim) {
        // A user with this email address already exists
        $o['tag'] = 'registrujFBusera';
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
            'KomitentIme' => $first_name,
            'KomitentPrezime' => $last_name,
            'FbId' => $id,
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

                    $o['tag'] = 'registrujFBusera';
                    $o['success'] = true;
                    $o['error'] = 0;
                    $o['uid'] = $id;
                    $o['user']['KomitentIme'] = $sadUpisan[0]['KomitentIme'];
                    $o['user']['KomitentPrezime'] = $sadUpisan[0]['KomitentPrezime'];
                    $o['user']['KomitentUserName'] = $sadUpisan[0]['KomitentUserName'];
                    $o['user']['KomitentEmail'] = $email;
                    $o['user']['created_at'] = $sadUpisan[0]['VremeKomitent'];

                } else {

                    $o['tag'] = 'registrujFBusera';
                    $o['success'] = false;
                    $o['error'] = 6;
                    $o['error_msg'] = "Nema korisnika u bazi nakon što je registrovan";


                }
            } else {
                $o['tag'] = 'registrujFBusera';
                $o['success'] = false;
                $o['error'] = 8;
                $o['error_msg'] = "Upisan u bazu ali nije poslat mail";
                $o['error_msg_interni'] = $error['ErrorMessageMail'];
            }

        }

    }

} else {

    $o['tag'] = 'registrujFBusera';
    $o['success'] = false;
    $o['error'] = 9;  // stavio sam svuda 1
    $o['error_msg'] = "No Email od Code od something else";
    $o['error_msg_interni'] = "Nismo dobili dobar email ili nema sifre";

}
