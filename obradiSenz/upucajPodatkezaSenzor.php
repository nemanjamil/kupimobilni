<?php


/*
 * ZUTA ZONA
 */
$errorMail = false;


if (($vrednostPodatak <= $OdPodaciIdeal && $vrednostPodatak >= $OdZutoIdeal) || ($vrednostPodatak >= $DoPodaciIdeal && $vrednostPodatak <= $DoZutoIdeal)) {

    $vecManjaZuta = ($vrednostPodatak <= $OdPodaciIdeal && $vrednostPodatak >= $OdZutoIdeal) ? 0 : 1;

    $data = Array("notSifraSenzora" => $idSifra,
        "tipNotifikacije" => $zutazona,
        "tipSenzora" => $tipSenzora,
        "idPodatka" => $idSenzorPodatak,
        "idKulture" => $IdKulture,
        "tipBaga" => $tipBaga,
        "VrednostPodatka" => $vrednostPodatak,
        "vecaManjaNoti" => $vecManjaZuta
    );

    $id = $db->insert('podacinotifikacija', $data);

    if ($id) {
        $errorMail = true;
    } else {
        $o['tag'] = 'idSenzorVazduha';
        $o['success'] = false;
        $o['error'] = $tipSenzora;
        $o['errorBoja'] = $zutazona;
        $o['error_msg'] =  "Nije upucana ".$opisSenzora." u podacinotifikacija => Zuta";
        $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
        $o['error_msg_opis'] =  $db->getLastError();
        echo json_encode($o,JSON_UNESCAPED_UNICODE);
        die;
    }
}

/*
 * CRVENA ZONA
 */
if (($vrednostPodatak < $OdZutoIdeal) || ($vrednostPodatak > $DoZutoIdeal)) {
//   tipNotifikacije  vremeNotifikacije
    $vecManjaCrvena = ($vrednostPodatak < $OdZutoIdeal) ? 0 : 1;

    $data = Array("notSifraSenzora" => $idSifra,
        "tipNotifikacije" => $crvenazona,
        "tipSenzora" => $tipSenzora,
        "idPodatka" => $idSenzorPodatak,
        "idKulture" => $IdKulture,
        "tipBaga" => $tipBaga,
        "VrednostPodatka" => $vrednostPodatak,
        "vecaManjaNoti" => $vecManjaCrvena
    );
    $id = $db->insert('podacinotifikacija', $data);

    if ($id) {
        $errorMail = true;
    } else {
        $o['tag'] = 'idSenzorVazduha';
        $o['success'] = false;
        $o['error'] = $tipSenzora;
        $o['errorBoja'] = $crvenazona;
        $o['error_msg'] =  "Nije upucana ".$opisSenzora." u podacinotifikacija => Crvena";
        $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
        $o['error_msg_opis'] =  $db->getLastError();
        echo json_encode($o,JSON_UNESCAPED_UNICODE);
        die;
    }

}

/*
 * ZELENA ZONA
 */
if ($vrednostPodatak > $OdPodaciIdeal && $vrednostPodatak < $DoPodaciIdeal) {

    $vecManjaZelena = ($vrednostPodatak <= $OdPodaciIdeal && $vrednostPodatak >= $OdZutoIdeal) ? 0 : 0;

    $data = Array("notSifraSenzora" => $idSifra,
        "tipNotifikacije" => $zelenazona,
        "tipSenzora" => $tipSenzora,
        "idPodatka" => $idSenzorPodatak,
        "idKulture" => $IdKulture,
        "tipBaga" => $tipBaga,
        "VrednostPodatka" => $vrednostPodatak,
        "vecaManjaNoti" => 0

    );

    $id = $db->insert('podacinotifikacija', $data);

    if ($id) {
        $errorMail = true;
    } else {
        $o['tag'] = 'idSenzorVazduha';
        $o['success'] = false;
        $o['error'] = $tipSenzora;
        $o['errorBoja'] = $zelenazona;
        $o['error_msg'] =  "Nije upucana ".$opisSenzora." u podacinotifikacija => Zelena";
        $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
        $o['error_msg_opis'] =  $db->getLastError();
        echo json_encode($o,JSON_UNESCAPED_UNICODE);
        die;
    }
}

if ($errorMail===false){

    $email = GLAVNIMAIL;
    $imePosiljaoca = FROMNAME;
    $naslovmaila = 'Bag';
    $o['tag'] = $opisSenzora;
    $o['success'] = false;
    $o['error'] = $tipSenzora;
    $o['errorBoja'] = $zelenazona;
    $o['error_msg'] =  "Nije upucana ".$opisSenzora." u podacinotifikacija => Zelena";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
    $ere = json_encode($o,JSON_UNESCAPED_UNICODE);
    $message = '<div><pre>'.$ere.'</pre></div>';
    $sta = $mailClass->posaljiMail($email,$imePosiljaoca,$naslovmaila,$message);


    $o['error'] = $tipSenzora;
    $o['errorMail'] = $sta['error'].' -> Da li je poslat mail ili ne';
    $o['error_msg'] =  "Obradi Vlaznost Vazduha -> false";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
    echo  json_encode($o,JSON_UNESCAPED_UNICODE);


    die;


}


?>