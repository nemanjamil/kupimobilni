<?php

// agro/parametri.php?action=izmeniPodatkeKomitent&id=57&KomitentNaziv=NazivKom&KomitentIme=Xman&KomitentPrezime=Xavier&KomitentAdresa=Adresa&KomitentPosBroj=11000&KomitentMesto=Beograd&KomitentTelefon=1234tel&KomitentMobTel=1234mobTel&email=x@y.z&KomitentUserName=x&KomitentTipUsera=1&KomitentFirma=Firma&KomitentMatBr=1234MatBr&KomitentPIB=1234&KomitentFirmaAdresa=FrimaAdresa

/*$postdata = file_get_contents("php://input");
$w = json_encode($postdata);
$someObject = json_decode($w);
$idSifra = $someObject->ID;
$temperature = $someObject->temperature;
$humidity = $someObject->humidity;
$luminosity = $someObject->luminosity;
$moisture = $someObject->moisture;*/

$db->where('KomitentEmail', $email);
$db->where('KomitentId', $id);
$resultrows = $db->getOne("komitenti");


$KomitentNaziv = filter_var($_GET['KomitentNaziv'], FILTER_SANITIZE_STRING);
$KomitentIme = filter_var($_GET['KomitentIme'], FILTER_SANITIZE_STRING);
$KomitentPrezime = filter_var($_GET['KomitentPrezime'], FILTER_SANITIZE_STRING);
$KomitentAdresa = filter_var($_GET['KomitentAdresa'], FILTER_SANITIZE_STRING);
$KomitentPosBroj = filter_var($_GET['KomitentPosBroj'], FILTER_SANITIZE_STRING);
$KomitentMesto = filter_var($_GET['KomitentMesto'], FILTER_SANITIZE_STRING);
$KomitentTelefon = filter_var($_GET['KomitentTelefon'], FILTER_SANITIZE_STRING);
$KomitentMobTel = filter_var($_GET['KomitentMobTel'], FILTER_SANITIZE_STRING);
$KomitentFirma = filter_var($_GET['KomitentFirma'], FILTER_SANITIZE_STRING);
$KomitentMatBr = filter_var($_GET['KomitentMatBr'], FILTER_SANITIZE_STRING);
$KomitentPIB = filter_var($_GET['KomitentPIB'], FILTER_SANITIZE_STRING);
$KomitentFirmaAdresa = filter_var($_GET['KomitentFirmaAdresa'], FILTER_SANITIZE_STRING);


if ($resultrows) {

    $data = Array (
        'KomitentNaziv' => $KomitentNaziv,
        'KomitentIme' => $KomitentIme,
        'KomitentPrezime' => $KomitentPrezime,
        'KomitentAdresa' => $KomitentAdresa,
        'KomitentPosBroj' => $KomitentPosBroj,
        'KomitentMesto' => $KomitentMesto,
        'KomitentTelefon' => $KomitentTelefon,
        'KomitentMobTel' => $KomitentMobTel,
        'KomitentFirma' => $KomitentFirma,
        'KomitentMatBr' => $KomitentMatBr,
        'KomitentPIB' => $KomitentPIB,
        'KomitentFirmaAdresa' => $KomitentFirmaAdresa
    );
    $db->where ('KomitentId', $id);
    if ($db->update ('komitenti', $data)) {

        $o['tag'] = 'komitentPodaciIzmena';
        $o['success'] = true;
        $o['error'] = 0;
        $o['error_msg'] =  "Sve je upucano kako treba ".$db->count;


    } else {

        $o['tag'] = 'komitentPodaciIzmena';
        $o['success'] = false;
        $o['error'] = 2;
        $o['error_msg'] =  "update failed";
        $o['error_msg_opis'] =  $db->getLastError();
    }



} else {

    $o['tag'] = 'komitentPodaciIzmena';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema datog maila u bazi";
    $o['error_msg_opis'] =  $db->getLastError();

}

echo json_encode($o,JSON_UNESCAPED_UNICODE);




?>