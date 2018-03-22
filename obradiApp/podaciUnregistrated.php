<?php
// kupimo podatke iz POST-a
/*$wew = '{
    "KomitentIme": "Ime",
    "KomitentPrezime": "Prezime",
    "KomitentAdresa": "Adresa111",
    "KomitentPosBroj": "11002",
    "KomitentMesto": "Beograd",
    "KomitentTelefon": "1235",
    "KomitentMobTel": "060",
    "email": "nemanjamil@gmail.com",
    "napomena": "Nesto sam napisao",
    "valutaId" : 1,
    "jezikId": 1,
    "korpa": [
        {
            "artikalID": 124,
            "cena": 123.434,
            "kolicina": 3

        },
        {
            "artikalID": 333,
            "cena": 123.434,
            "kolicina": 5

        },
        {
            "artikalID": 1217,
            "cena": 123.434,
            "kolicina": 2

        }
    ]
}';*/

$wew = file_get_contents("php://input");

if (empty($wew)) {
    $o['tag'] = 'kupovinaKorpaUnregistered';
    $o['success'] = false;
    $o['error'] = 43;
    $o['error_msg'] = "Ne postoje podaci.";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    exit();
}

$podaciUnreg = json_decode($wew);

$KomitentIme = $podaciUnreg->KomitentIme;
$KomitentPrezime = $podaciUnreg->KomitentPrezime;
$KomitentAdresa = $podaciUnreg->KomitentAdresa;
$KomitentPosBroj = $podaciUnreg->KomitentPosBroj;
$KomitentMesto = $podaciUnreg->KomitentMesto;
$KomitentTelefon = $podaciUnreg->KomitentTelefon;
$KomitentMobTel = $podaciUnreg->KomitentMobTel;
$email = $podaciUnreg->email;
$napomenaNarudz = $common->clearvariable($podaciUnreg->napomena);

$valutaId = $podaciUnreg->valutaId;
$jezikId = $podaciUnreg->jezikId;

$korpaUnregistrated = $podaciUnreg->korpa;



if (!$KomitentIme ) {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema KomitentIme";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentPrezime ) {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema KomitentPrezime";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentAdresa ) {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = "Nema KomitentAdresa";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentMesto ) {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 4;
    $m['error_msg'] = "Nema KomitentMesto";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentPosBroj ) {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 5;
    $m['error_msg'] = "Nema KomitentPosBroj";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentMobTel ) {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 6;
    $m['error_msg'] = "Nema KomitentMobTel";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


if ($email) {
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $m['tag'] = 'kupovinaKorpaUnregistered';
        $m['success'] = false;
        $m['error'] = 7;
        $m['error_msg'] = 'The email address you entered is not valid';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;

    }
}

if (!$korpaUnregistrated) {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 8;
    $m['error_msg'] = "Nema Podatka u korpi";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


if (!$valutaId) {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 41;
    $m['error_msg'] = "Nema valutaId";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$jezikId) {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 42;
    $m['error_msg'] = "Nema jezik Id";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}



?>