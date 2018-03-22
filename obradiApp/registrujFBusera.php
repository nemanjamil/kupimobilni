<?php
$o['error_msg'] = '';

$id = $common->isEmpty($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
$name = $common->isEmpty($_POST['name']);
$gender = $common->isEmpty($_POST['gender']);
$first_name = $common->isEmpty($_POST['first_name']);
$last_name = $common->isEmpty($_POST['last_name']);
$link = $common->isEmpty($_POST['link']);
$picture = $common->isEmpty($_POST['picture']);

if (isset($_POST['email'])) {  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); } else { $email = '';  }
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $o['tag'] = 'registrujFBusera';
        $o['success'] = false;
        $o['error'] = 0;  // stavio sam svuda 1
        $o['error_msg'] =  "The email address you entered is not valid.";
    }


if (empty($id)) {
    $o['tag'] = 'registrujFBusera';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] = "FB ID false";
    $o['error_msg_interni'] = "Ne postoji FB id";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}


if ($id) {


    $db->where('KomitentEmail', $email);
    $db->where('FbId', $id);
    $dlim = $db->getOne("komitenti");
    if ($dlim) {
        // A user with this email address already exists
        $KomitentId = (int) $sad['KomitentId'];

        $o['tag'] = 'registrujFBusera';
        $o['error'] = 0;
        $o['success'] = true;
        $o['error_msg'] = "Postoji email u bazi i povezanaj je sa FB-id";
        $o['error_msg_interni'] = "Postoji email u bazi i povezanaj je sa FB-id";
        $o['uid'] =  $KomitentId;
        $o['user']['KomitentNaziv'] = $sad['KomitentNaziv'];
        $o['user']['KomitentIme'] = $sad['KomitentIme'];
        $o['user']['KomitentPrezime'] = $sad['KomitentPrezime'];
        $o['user']['KomitentAdresa'] = $sad['KomitentAdresa'];
        $o['user']['KomitentPosBroj'] = $sad['KomitentPosBroj'];
        $o['user']['KomitentMesto'] = $sad['KomitentMesto'];
        $o['user']['KomitentTelefon'] = $sad['KomitentTelefon'];
        $o['user']['KomitentMobTel'] = $sad['KomitentMobTel'];
        $o['user']['KomitentEmail'] = $sad['KomitentEmail'];
        $o['user']['KomitentUserName'] = $sad['KomitentUserName'];
        $o['user']['KomitentTipUsera'] = $sad['KomitentTipUsera'];
        $o['user']['KomitentFirma'] = $sad['KomitentFirma'];
        $o['user']['KomitentMatBr'] = $sad['KomitentMatBr'];
        $o['user']['KomitentPIB'] = $sad['KomitentPIB'];
        $o['user']['KomitentFirmaAdresa'] = $sad['KomitentFirmaAdresa'];
        $o['user']['FbId'] = $sad['FbId'];
        echo json_encode($o, JSON_UNESCAPED_UNICODE);
        die;

    }

    $db->where('KomitentEmail', $email);
    $dlim = $db->getOne("komitenti");
    if ($dlim) {
        // A user with this email address already exists
        $KomitentId = (int) $sad['KomitentId'];

        $o['tag'] = 'registrujFBusera';
        $o['error'] = 0;
        $o['success'] = true;
        $o['error_msg'] = "Postoji email u bazi ali nije povezan sa FB-id";
        $o['error_msg_interni'] = "Postoji email u bazi ali nije povezan sa FB-id";
        $o['uid'] =  $KomitentId;
        $o['user']['KomitentNaziv'] = $sad['KomitentNaziv'];
        $o['user']['KomitentIme'] = $sad['KomitentIme'];
        $o['user']['KomitentPrezime'] = $sad['KomitentPrezime'];
        $o['user']['KomitentAdresa'] = $sad['KomitentAdresa'];
        $o['user']['KomitentPosBroj'] = $sad['KomitentPosBroj'];
        $o['user']['KomitentMesto'] = $sad['KomitentMesto'];
        $o['user']['KomitentTelefon'] = $sad['KomitentTelefon'];
        $o['user']['KomitentMobTel'] = $sad['KomitentMobTel'];
        $o['user']['KomitentEmail'] = $sad['KomitentEmail'];
        $o['user']['KomitentUserName'] = $sad['KomitentUserName'];
        $o['user']['KomitentTipUsera'] = $sad['KomitentTipUsera'];
        $o['user']['KomitentFirma'] = $sad['KomitentFirma'];
        $o['user']['KomitentMatBr'] = $sad['KomitentMatBr'];
        $o['user']['KomitentPIB'] = $sad['KomitentPIB'];
        $o['user']['KomitentFirmaAdresa'] = $sad['KomitentFirmaAdresa'];
        $o['user']['FbId'] = $sad['FbId'];
        echo json_encode($o, JSON_UNESCAPED_UNICODE);
        die;

    } else {

        require('registruUserFbAkoNema.php');

    }


} else {

    $o['tag'] = 'registrujFBusera';
    $o['success'] = false;
    $o['error'] = 3;
    $o['error_msg'] = "No FB-id";
    $o['error_msg_interni'] = "Ne postoji FB-id";

}


echo json_encode($o, JSON_UNESCAPED_UNICODE);



?>