<?php

if ($m['success']) {


    /* Pripremamo insert u Narudzbine*/
    $insertData = Array (
        'userNarudz' => $userId,
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

        if ($korpaUnregistrated) {
        foreach ($korpaUnregistrated as $k):

            /*"artikalID": 444,
            "cena": 123.434,
            "valuta": 1,
            "kolicina": 2*/

            $artikalID = $k->artikalID;
            $cena = $k->cena;
            $kolicina = $k->kolicina;
            $IdUnit = 8; // $k->$IdUnit;

            $insertDataLista = Array (
                'IdNarudzPov' => $idNar,
                'ArtIdNarudzLista' => $artikalID, //$v['IdArtTempArt'], // 125
                'KolicinaNarudzlista' => $kolicina,
                'CenaNarudzLista' => $cena,
                'ValutaNarudzLista' => $valutaId,
                'UnitNarudzLista' => $IdUnit
            );



            $idNList = $db->insert('narudzlista', $insertDataLista);

           /*if ($idNList) {
                echo 'Id = ' . $idNList.' <br>';
            } else {
                echo '<br> insert failed kod : <br> '.var_dump($insertDataLista).' <br> ' . $db->getLastError();
                die;
            }*/

        endforeach;

        } else {

            $m['tag'] = 'kupovinaKorpaUnregistered';
            $m['success'] = false;
            $m['error'] = 15;
            $m['error_msg'] = 'Nema podataka o artiklima koji su kupljeni';
            echo json_encode($m, JSON_UNESCAPED_UNICODE);
            die;

        }

    } else {

        $m['tag'] = 'kupovinaKorpaUnregistered';
        $m['success'] = false;
        $m['error'] = 11;
        $m['error_msg'] = 'insert failed: ' . $db->getLastError().'<br>';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;

    }

/*    $file = 'log-'.$idNar.'.txt';
    $current = file_get_contents($file);
    $current .= "John Smith\n";
    file_put_contents($file, $current);*/

    // ako je sve dobro onda uradi komit
    if ($idNList) {

        $db->commit();

        require(DCROOT . '/obradi/posaljiMailKupovinaUnregistrated.php');

        if (!$poslatMail) {

            $m['tag'] = 'kupovinaKorpaUnregistered';
            $m['success'] = false;
            $m['error'] = 12;
            $m['error_msg'] = 'Nije poslat mail ali su svi podaci u bazi';
            echo json_encode($m, JSON_UNESCAPED_UNICODE);
            die;

        } else {

            $m['tag'] = 'kupovinaKorpaUnregistered';
            $m['success'] = true;
            $m['error'] = 0;
            $m['error_msg'] = 'Sve je ok. Poslat Mail na : '.$email;

        }


    } else {
        // ako nije dobro obrisi sve iz obe tabele
        $db->rollback();

        $m['tag'] = 'kupovinaKorpaUnregistered';
        $m['success'] = false;
        $m['error'] = 13;
        $m['error_msg'] = '$m - success je false ili je URADJEN ROLLBACK';
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;
    }


    //var_dump($db->trace);





} else {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 14;
    $m['error_msg'] = 'rollback idNList i obrisao';
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}
?>