<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 28.7.15.
 * Time: 22.36
 */
require 'proveriAjaxDeny.php';



if (!isset($_POST['email'])) {
    $error_msg['ok'] = 'Nema Email';
    echo $m = json_encode($error_msg);
    die;
}

if (!isset($_POST['p'])) {
    $error_msg['ok'] = 'Nema pass';
    echo $m = json_encode($error_msg);
    die;
}

if (isset($_POST['email'], $_POST['p'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        echo $error_msg .= 'Email adresa koju ste uneli nije ispravna';
        /*header("Location: /izvestaj?err= Email adresa koju ste uneli nije ispravna.
        Unesite ponovo adresu.");*/
        exit();
    }

    // ovo je vec kriptovan pass iz JS-a
    // p.value = hex_sha512(password.value);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        echo $error_msg .= 'Invalid password configuration.';
        /*header("Location: /izvestaj?err=Invalid password configuration");*/
        exit();
    }


    if (empty($error_msg)) {

        $sesKorEc = $sesKor->login($email, $password);
        if ($sesKorEc == 1) {
            $error_msg['ok'] = 'Dobrodošli !';
            echo $m = json_encode($error_msg);
        } else {

            //$error_msg['err'] = 'Login failed';
           echo $m = json_encode($sesKorEc);
            //exit();
        }


    }

} else {
    echo 'Nisu uneseni podaci email ili password';
}
