<?php

$first_nameFb = $_POST['first_nameFb'];
$last_nameFb = $_POST['last_nameFb'];
$nameFb = $_POST['nameFb'];
$genderFb = $_POST['genderFb'];
$KomitentUserName = $common->friendly_convert($nameFb);


$passwordorg1 = rand(100,1000);
$passwordorg = hash('sha512', $passwordorg1);
$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
$password = hash('sha512', $passwordorg . $random_salt);

$data = Array (
    'FbId' => $id,
    'KomitentEmail' => $email,
    'KomitentIme' => $first_nameFb,
    'KomitentPrezime' => $last_nameFb,
    'KomitentNaziv' => $nameFb,
    'KomitentGender' => $genderFb,
    'KomitentUserName' => $KomitentUserName,
    'KomitentActive' => 1,
    'KomitentPassword' => $password,
    'KomitentSalt' => $random_salt
);


$idKomitent = $db->insert ('komitenti', $data);
if ($idKomitent) {


    $msg['message'] = 'user was created. Id=' . $idKomitent;
    $msg['status'] = true;


    $_SESSION['user']['KomitentId'] = $idKomitent;
    $_SESSION['user']['KomitentEmail'] = $email;
    $user_browser = GLAVNIMAIL;
    $_SESSION['user']['login_string'] = hash('sha512', $password . $user_browser);
    $_SESSION['user']['logovankako'] = LOGOVANKAKOFB;

    $cookie_nameFb = 'logovankako';
    if(!isset($_COOKIE[$cookie_nameFb])) {
        setcookie($cookie_nameFb, LOGOVANKAKOFB, time() + (86400 * 30 * 12), "/",'', 0, 0); // setovano da se izbrise cookie za 360 dana
    } else {
        //videti sta staviti
        //$sajtcheck = $_COOKIE[$cookie_name];
    }


} else {

    $msg['message'] = 'insert failed : kod kriranja komitenta ' . $db->getLastError();
    $msg['status'] = true;

}
