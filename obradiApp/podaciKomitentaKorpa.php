<?php
if ($userTip) {

    $cols = Array("*");
    $db->where("KomitentId", $userId);
    $komitent = $db->getOne("komitenti", null, $cols);
    if ($db->count > 0) {


        //$KomitentNaziv = $komitent['KomitentNaziv'];
        $KomitentIme = $komitent['KomitentIme'];
        $KomitentPrezime = $komitent['KomitentPrezime'];
        $KomitentAdresa = $komitent['KomitentAdresa'];
        $KomitentPosBroj = $komitent['KomitentPosBroj'];
        $KomitentMesto = $komitent['KomitentMesto'];
        $KomitentTelefon = $komitent['KomitentTelefon'];
        $KomitentMobTel = $komitent['KomitentMobTel'];
        $email = $komitent['KomitentEmail'];


    }

} else {

    // kupimo podatke iz GET-a
    if (isset($_GET['KomitentIme'])) {
        $KomitentIme = filter_input(INPUT_GET, 'KomitentIme', FILTER_SANITIZE_STRING);
    } else {
        $KomitentIme = '';
    }
    if (isset($_GET['KomitentPrezime'])) {
        $KomitentPrezime = filter_input(INPUT_GET, 'KomitentPrezime', FILTER_SANITIZE_STRING);
    } else {
        $KomitentPrezime = '';
    }
    if (isset($_GET['KomitentAdresa'])) {
        $KomitentAdresa = filter_input(INPUT_GET, 'KomitentAdresa', FILTER_SANITIZE_STRING);
    } else {
        $KomitentAdresa = '';
    }
    if (isset($_GET['KomitentMesto'])) {
        $KomitentMesto = filter_input(INPUT_GET, 'KomitentMesto', FILTER_SANITIZE_STRING);
    } else {
        $KomitentMesto = '';
    }
    if (isset($_GET['KomitentPosBroj'])) {
        $KomitentPosBroj = filter_input(INPUT_GET, 'KomitentPosBroj', FILTER_SANITIZE_STRING);
    } else {
        $KomitentPosBroj = '';
    }
    if (isset($_GET['KomitentMobTel'])) {
        $KomitentMobTel = filter_input(INPUT_GET, 'KomitentMobTel', FILTER_SANITIZE_STRING);
    } else {
        $KomitentMobTel = '';
    }
    if (isset($_GET['KomitentTelefon'])) {
        $KomitentTelefon = filter_input(INPUT_GET, 'KomitentTelefon', FILTER_SANITIZE_STRING);
    } else {
        $KomitentTelefon = '';
    }

    // ovo je za e-mail
    if (isset($_GET['email'])) {  $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL); } else { $email = '';  }

    if ($email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $m['tag'] = 'kupovinaKorpa';
            $m['success'] = false;
            $m['error'] = 7;
            $m['error_msg'] = 'The email address you entered is not valid';
            echo json_encode($m, JSON_UNESCAPED_UNICODE);
            die;

        }
    }




}

$napomenaNarudz = $common->clearvariable($_GET['napomena']);

if (!$KomitentIme ) {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema KomitentIme";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentPrezime ) {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema KomitentPrezime";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentAdresa ) {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = "Nema KomitentAdresa";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentMesto ) {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 4;
    $m['error_msg'] = "Nema KomitentMesto";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentPosBroj ) {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 5;
    $m['error_msg'] = "Nema KomitentPosBroj";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$KomitentMobTel ) {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 6;
    $m['error_msg'] = "Nema KomitentMobTel";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

?>

