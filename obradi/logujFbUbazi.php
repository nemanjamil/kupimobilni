<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 28.7.15.
 * Time: 22.36
 */
require 'proveriAjaxDeny.php';

if ($email && $id) {

    //$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $msg['message'] = 'The email address you entered is not valid';
        $msg['status'] = false;
        /*header("Location: /izvestaj?err= Email adresa koju ste uneli nije ispravna.
        Unesite ponovo adresu.");*/
        exit();
    }

    $cols = Array ("KomitentId", "KomitentIme", "KomitentPrezime","KomitentEmail","KomitentPassword", "FbId");
    $db->where ("FbId", $id);
    $db->where ("KomitentEmail", $email);
    $komitentSelect = $db->getOne("komitenti", null, $cols);
    if ($db->count > 0) {

            $msg['message'] = 'Ima datog emaila sa FBId povezanog i SETUJEMO SESSION';
            $msg['status'] = true;
            // setujemo usera u session posto ga imamo u bazi
            require('setujUserSessionFB.php');

    } else {

        $msg['message'] = 'Nema datog emaila sa FBId povezanog. Treba da se poveze ili da se doda FbId';
        $msg['status'] = true;


        // Proveravamo da li ima EMAIL
        $cols = Array ("KomitentId", "KomitentIme", "KomitentPrezime","KomitentEmail");
        $db->where ("KomitentEmail", $email);
        $samoEmail = $db->getOne("komitenti", null, $cols);
        if ($samoEmail) {

            $data = Array (
                'FbId' => $id
            );
            $db->where ('KomitentEmail', $email);
            if ($db->update ('komitenti', $data)) {

                $msg['message'] = $db->count . ' Proveravamo da li ima EMAIL -> Uradjen update mail';
                $msg['status'] = true;


            } else {

                $msg['message'] = 'Proveravamo da li ima EMAIL -> update failed: ' . $db->getLastError();
                $msg['status'] = true;

            }
        } else {

            $msg['message'] = 'Nema datog maila u bazi kod nas. Treba da se radi INSERT Usera u bazu';
            $msg['status'] = true;
            require('insertUserSessionFB.php');

        }


    }
    /*
     // ovo je vec kriptovan pass iz JS-a
    // p.value = hex_sha512(password.value);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        echo $error_msg .= 'Invalid password configuration.';
        // header("Location: /izvestaj?err=Invalid password configuration");
        exit();
    }


    if (empty($error_msg)) {

        $sesKorEc = $sesKor->login($email, $password);
        if ($sesKorEc == 1) {
            $error_msg['ok'] = 'LOG OK !!! - reload page';
            echo $m = json_encode($error_msg);
        } else {

            //$error_msg['err'] = 'Login failed';
           echo $m = json_encode($sesKorEc);
            //exit();
        }


    }*/

} else {
    $msg['message'] = 'Nema IdFb ili Email od korisnika';
    $msg['status'] = false;

}
echo json_encode($msg,JSON_UNESCAPED_UNICODE);