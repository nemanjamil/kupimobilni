<?php
/*
 * POST
 * */
if (isset($_POST['email'])) {  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); } else { $email = '';  }

if ($email) {
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $o['tag'] = 'povuciUidOdEmail';
        $o['success'] = false;
        $o['error'] = 1;
        $o['error_msg'] =  "The email address you entered is not valid.";

        echo json_encode($o, JSON_UNESCAPED_UNICODE);
        exit();
    }


    $db->where("KomitentEmail", $email);
    $db->where("KomitentActive", 1);
    $sad = $db->getOne("komitenti");

    if ($sad) {

        $KomitentId = (int) $sad['KomitentId'];

        $o['tag'] = 'povuciUidOdEmail';
        $o['error'] = 0;
        $o['success'] = true;
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

    } else {

        $db->where("KomitentEmail", $email);
        $userTipUpit = $db->getOne("komitenti");

        if ($userTipUpit) {

            $o['tag'] = 'povuciUidOdEmail';
            $o['success'] = false;
            $o['error'] = 4;
            $o['error_msg'] = 'Ima korisnika u bazi ali nije aktivan';

        } else {

            // ako ne postoji user
            $o['tag'] = 'povuciUidOdEmail';
            $o['success'] = false;
            $o['error'] = 2;
            $o['error_msg'] = 'Nema korisnika u bazi';

        }
    }

    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    exit();

} else {

    // ako nema podataka
    $o['tag'] = 'povuciUidOdEmail';
    $o['success'] = false;
    $o['error'] = 3;
    $o['error_msg'] = 'Nije dobar Mail';

    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    exit();

}

?>
