<?php
require 'proveriAjaxDeny.php';

$error_msg = '';

if (isset($_POST['email'],$_POST['p'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= 'The email address you entered is not valid';
        /*header("Location: /izvestaj?err= Email adresa koju ste uneli nije ispravna.
        Unesite ponovo adresu.");*/
        //exit();
    }

    // ovo je vec kriptovan pass iz JS-a
    // p.value = hex_sha512(password.value);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= 'Invalid password configuration.';
        /*header("Location: /izvestaj?err=Invalid password configuration");*/
        //exit();
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
    //$db->setTrace (true);
    $db->where ('KomitentEmail', $email);
    $dlim = $db->has("komitenti");
    //print_r ($db->trace);



    if ($dlim) {
        // A user with this email address already exists
        $error_msg .= 'A user with this email address already exists.';
        /*header("Location: /izvestaj?err=Vec postoji taj mail");*/
       // exit();
    }

    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {

        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);


        $insertData = Array (
            'KomitentEmail' => $email,
            'KomitentPassword' => $password,
            'KomitentSalt' => $random_salt,
            'KomitentIpAdresa' => $ipAdresa
        );


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
            $error_msg = 'Uradjen RoolBack';
        }

        if ($id) {

            include_once 'posaljiMailRegistruj.php';

            if ($erroropis['status']) {
                $error_msg = 'Uspesno ste se registrovali. Pogledajte mail.';
            } else {
                $db->rollback();
                $error_msg = 'Uradjen RoolBack -> Nije poslat mail';
            }
        }

    }

} else {
    $error_msg = 'Nema Podataka Email i Pass';
}
echo $error_msg;


?>