<?php

//require 'proveriAjaxDeny.php';
$o['error_msg'] = '';
$postdata = file_get_contents("php://input");
$postdata = $_GET; // ovo nam nece trebati jer ce ici POST, ali nam je potrebno za test


if (!empty($postdata)) {
    $tp = $postdata;
} else {
    // ako nema upste podataka
    $o['tag'] = 'register';
	$o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "No Data";

    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

$tp = json_encode($tp); // ovo nam nece trebati jer dobijamo JSON kada se salje POST
$someObject = json_decode($tp);

// hvatamo varijable
$email = trim($someObject->email);
$sifra = trim($someObject->sifra);
$KomitentIme = trim($someObject->komitentime);
$KomitentPrezime = trim($someObject->komitentprezime);

// prvi upit ako nema varijabli Ime i prezima
if (!$KomitentIme || !$KomitentPrezime) {
    $o['tag'] = 'register';
    $o['success'] = false;
    $o['error'] = 2;  // stavio sam svuda 1
    $o['error_msg'] =  "There is no Name or Surname.";
}


// dako nema mail i sifre i ako ne postiji ni jedan error
if (isset($email,$sifra) || !$o['error_msg']) {
    // prebacijemo sifru u sha512

    $password = hash('sha512', $sifra);

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        // validirano mail, ako nije dobar onda stavljamo error
        $o['tag'] = 'register';
        $o['success'] = false;
		$o['error'] = 3;  // stavio sam svuda 1
        $o['error_msg'] =  "The email address you entered is not valid.";


    }

    // ovo je vec kriptovan pass iz JS-a
    // p.value = hex_sha512(password.value);
    // $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $o['tag'] = 'register';
        $o['success'] = false;
		$o['error'] = 4;  // stavio sam svuda 1
        $o['error_msg'] =  "Invalid password configuration.";

    }


    $db->where ('KomitentEmail', $email);
    $dlim = $db->has("komitenti");
    if ($dlim) {
        // A user with this email address already exists
        $o['tag'] = 'register';
        $o['success'] = false;
        $o['error'] = 5;
        $o['error_msg'] =  "A user with this email address already exists.";

    }


    // ako do sada nema ni jednog ERRORA
    if (empty($o['error_msg'])) {

        /*
         * $password = hash('sha512', $sifra);
         * ovo smo stavili na liniju 44
         */

        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);

        $pieces = explode("@", $email);
        $emailIme =  trim($pieces[0]);

        //proveravamo da li ima User Name od Korisnika
        $db->where ('KomitentUserName', $emailIme);
        $dlim = $db->has("komitenti");
        if ($dlim) {
           $emailIme = $emailIme.rand(10,500);
        }

        $insertData = Array (
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
            $id = $db->insert ('komitenti', $insertData);


            $db->commit();

        } catch (Exception $e) {
            // An exception has been thrown
            // We must rollback the transaction
            $db->rollback();
        }

        if ($id) {

            include_once 'posaljiMailRegistrujAndroid.php';


            $cols = Array ("K.KomitentId","K.VremeKomitent", "K.KomitentEmail","K.KomitentUserName", "K.KomitentIme", "K.KomitentPrezime");
            $db->join("tipusera t", "K.KomitentTipUsera = t.IdTipUsera", "LEFT");
            $db->where('KomitentEmail', $email);
            $sadUpisan = $db->get("komitenti K", null,$cols);
            // ako smo dobro upisali, jos jednom da proverimo
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
                $o['error_msg'] =  "Nema korisnika u bazi nakon što je registrovan";


            }

        }

    }

}
// stampamo JSON
echo json_encode($o,JSON_UNESCAPED_UNICODE);



?>