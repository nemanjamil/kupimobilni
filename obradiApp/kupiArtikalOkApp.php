<?php

if ($m['success']) {


    /* Pripremamo insert u Narudzbine*/
    $insertData = Array (
        'userNarudz' => $KomitentId,
        'imeNarudz' => $KomitentIme,
        'prezimeNarudz' => $KomitentPrezime,
        'adresaNarudz' => $KomitentAdresa,
        'mestoNarudz' => $KomitentMesto,
        'postBrojNarudz' => $KomitentPosBroj,
        'emailNarudz' => $email,
        'mobNarudz' => $KomitentMobTel,
        'fixNarudz' => $KomitentTelefon,
        'napomenaNarudz' => $napomenaNarudz
    );
    /* KRAJ Pripremamo insert u Narudzbine*/


    // First of all, let's begin a transaction
    //$db->setTrace(true);
    $db->startTransaction();

    // pravljenje upita u narudbinu
    $idNar = $db->insert('narudzbine', $insertData);

    if ($idNar) {

        //$error_msg = 'Kreirana Narudzbina Id=' . $idNar.'<br>';

        // ubacujemo u NarudzLista artikle

        if ($ArtikliKupljeni) {
        foreach ($ArtikliKupljeni as $k => $v):

            $ArtikalStanje = $v['ArtikalStanje'];
            $ArtikalMPCena = $v['ArtikalMPCena'];
            $pravaMp = $v['pravaMp'];
            $pravaVp = $v['pravaVp'];
            $dani = $v['dani'];
            $IdUnit = $v['IdUnit'];

            $nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $valutasession, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
            require(DCROOT.'/stranice/cenaPrikazVarijable.php');


            $insertDataLista = Array (
                'IdNarudzPov' => $idNar,
                'ArtIdNarudzLista' => $v['IdArtTempArt'], //$v['IdArtTempArt'], // 125
                'KolicinaNarudzlista' => $v['KolTempArt'],
                'CenaNarudzLista' => $cenaPrikazBroj,
                'ValutaNarudzLista' => $valutaId,
                'UnitNarudzLista' => $IdUnit
            );

            $idNList = $db->insert('narudzlista', $insertDataLista);

            /*if ($idNList) {
                echo 'Ubacena Narudzbenica. Id= ' . $idNList;
            } else {
                echo 'insert failed: Ubacena Narudzbenica ' . $db->getLastError();
                die;
            }*/

        endforeach;

        } else {

            $m['tag'] = 'kupovinaKorpa';
            $m['success'] = false;
            $m['error'] = 15;
            $m['error_msg'] = 'Nema podataka o artiklima koji su kupljeni';
            echo json_encode($m, JSON_UNESCAPED_UNICODE);
            die;

        }

    } else {

        $m['tag'] = 'kupovinaKorpa';
        $m['success'] = false;
        $m['error'] = 11;
        $m['error_msg'] = 'insert failed: ' . $db->getLastError().'<br>';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;

    }


    // sada brisemo iz TempArt baze date arttikle


    // ovo ide kada je produkcija
    // kada je user kod nas u bazi
    if ($userTip) {
        $db->where('KomiTempArt', $userId);
        if ($db->delete('tempart')) {
            $obrisao = true;
        } else {
            $obrisao = false;
        }
    }


    // ako je sve dobro onda uradi komit
    if ($idNList) {

        $db->commit();


        require(DCROOT . '/obradi/posaljiMailKupovina.php');

        if (!$poslatMail) {

            $m['tag'] = 'kupovinaKorpa';
            $m['success'] = false;
            $m['error'] = 12;
            $m['error_msg'] = 'Nije poslat mail ali su svi podaci u bazi';
            echo json_encode($m, JSON_UNESCAPED_UNICODE);
            die;

        } else {

            $m['tag'] = 'kupovinaKorpa';
            $m['success'] = true;
            $m['error'] = 0;
            $m['error_msg'] = 'Sve je ok. Poslat Mail na : '.$email;

        }


    } else {
        // ako nije dobro obrisi sve iz obe tabele
        $db->rollback();

        $m['tag'] = 'kupovinaKorpa';
        $m['success'] = false;
        $m['error'] = 13;
        $m['error_msg'] = '$m - success je false ili je URADJEN ROLLBACK';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;
    }


    //var_dump($db->trace);





} else {
    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 14;
    $m['error_msg'] = 'rollback idNList i obrisao';
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}
?>