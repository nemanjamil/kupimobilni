<?php

if (empty($error_msg)) {


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
        foreach ($ArtikliKupljeni as $k => $v):

            $ArtikalStanje = $v['ArtikalStanje'];
            $ArtikalMPCena = $v['ArtikalMPCena'];
            $pravaMp = $v['pravaMp'];
            $pravaVp = $v['pravaVp'];
            $dani = $v['dani'];
            $IdUnit = $v['IdUnit'];

            $nakasd = $common->stanjeOpis($ArtikalStanje, $ArtikalMPCena, $valutasession, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
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
                echo 'user was created. Id=' . $idNList;
            } else {
                echo 'insert failed: ' . $db->getLastError();
                die;
            }*/

        endforeach;

    } else {
        $error_msg = 'insert failed: ' . $db->getLastError().'<br>';
    }


    // sada brisemo iz tempart baze date arttikle


    // ovo ide kada je produkcija
      $db->where('KomiTempArt', $KomitentId);
      if($db->delete('tempart')) {
          $obrisao = true;
      } else {
          $obrisao = false;
      }


    // ako je sve dobro onda uradi komit
    if ($idNList && $obrisao) {
        $db->commit();
        include_once 'posaljiMailKupovina.php';

        if (!$poslatMail) {
            $error_msg = 'Nije poslat mail ali su svi podaci u bazi';
        }


    } else {
        // ako nije dobro obrisi sve iz obe tabele
        $db->rollback();
        $error_msg = 'Nema Komitent ili email';
    }


    //var_dump($db->trace);





} else {
    header("Location: " . DPROOT . "/thank-you?e=$error_msg");
    die;
}
?>