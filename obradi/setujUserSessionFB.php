<?php


$_SESSION['user']['KomitentId'] = $komitentSelect['KomitentId'];
$_SESSION['user']['KomitentEmail'] = $komitentSelect['KomitentEmail'];
$KomitentPasswordFb = $komitentSelect['KomitentPassword'];
$user_browser = GLAVNIMAIL;
$_SESSION['user']['login_string'] = hash('sha512', $KomitentPasswordFb . $user_browser);
$_SESSION['user']['logovankako'] = LOGOVANKAKOFB;

$cookie_nameFb = 'logovankako';
if(!isset($_COOKIE[$cookie_nameFb])) {
    setcookie($cookie_nameFb, LOGOVANKAKOFB, time() + (86400 * 30 * 12), "/",'', 0, 0); // setovano da se izbrise cookie za 360 dana
} else {
    //videti sta staviti
    //$sajtcheck = $_COOKIE[$cookie_name];
}
