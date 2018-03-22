<?php

$KomitentId = $common->isEmpty($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$pass = $common->isEmpty($_POST['pass']);
$passduo = $common->isEmpty($_POST['passduo']);
$salt = $common->isEmpty($_POST['salt']);

$db->where('KomitentId', $KomitentId);
$db->where('KomitentSalt', $salt);
$upitKomitent = $db->getOne('komitenti', 'KomitentSalt, KomitentId');

$KomitentIdUpit = $upitKomitent['KomitentId'];
$KomitentSaltUpit = $upitKomitent['KomitentSalt'];

if ($pass == $passduo) {

    if ($KomitentIdUpit) {

        if ($KomitentSaltUpit == $salt) {

            $passwordorg1 = $pass;
            $passwordorg = hash('sha512', $passwordorg1);
            $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
            $password = hash('sha512', $passwordorg . $random_salt);

            $data = Array(
                'KomitentPassword' => $password,
                'KomitentSalt' => $random_salt
            );

            $db->where('KomitentId', $KomitentIdUpit);
            $db->update('komitenti', $data);

            header("Location:" . URLVRATI . "");

        } else {


            $opis .= '<div class="inner-box">';
            $opis .= '<div class="content">';
            $opis .= '<div class="forgot-password-done">';
            $opis .= '<i class="icon-ok success-icon"></i>';
            $opis .= '<span>GRESKA</span>';
            $opis .= '<div class="alert alert-info"> <strong>Lozinka: </strong> Molimo da ponovo <button><a href="'.URLVRATI.'">pokusate</a></button></div>';
            $opis .= '</div>';
            $opis .= '</div>';
            $opis .= '</div>';


            echo $opis;
        }


    } else {
        $opis .= '<div class="inner-box">';
        $opis .= '<div class="content">';
        $opis .= '<div class="forgot-password-done">';
        $opis .= '<i class="icon-ok success-icon"></i>';
        $opis .= '<span>GRESKA</span>';
        $opis .= '<div class="alert alert-info"> <strong>Lozinka </strong> Molimo da ponovo  <button><a href="'.URLVRATI.'">pokusate</a></button></div>';
        $opis .= '</div>';
        $opis .= '</div>';
        $opis .= '</div>';


        echo $opis;
    }

} else {

    $opis .= '<div class="inner-box">';
    $opis .= '<div class="content">';
    $opis .= '<div class="forgot-password-done">';
    $opis .= '<i class="icon-ok success-icon"></i>';
    $opis .= '<span>GRESKA</span>';
    $opis .= '<div class="alert alert-danger"> <strong>Paznja ! </strong> Ne poklapaju se unete lozinke!</div>';
    $opis .= '<div class="alert alert-info"> <strong>Lozinka </strong> Molimo da ponovo <button><a href="'.URLVRATI.'">pokusate</a></button></div>';
    $opis .= '</div>';
    $opis .= '</div>';
    $opis .= '</div>';


    echo $opis;


}

