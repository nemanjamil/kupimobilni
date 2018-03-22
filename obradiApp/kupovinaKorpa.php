<?php
$m['success'] = true;
$KomitentId = $userId;

require('podaciKomitentaKorpa.php');

if ($email) {


    /* Proveravamo valutu */

    $valutasessionUpper = strtoupper($valutasession);

    $cols = Array("ValutaId");
    $db->where("ValutaValuta", $valutasession);
    $valup = $db->getOne("valuta", null, $cols);

    $valutaId = $valup['ValutaId'];

    if (!$valutaId) {
        $m['tag'] = 'kupovinaKorpa';
        $m['success'] = false;
        $m['error'] = 8;
        $m['error_msg'] = "Nema ID od valute";
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;
    }

    /* KRAJ  Proveravamo valutu */

    if ($userTip) {


        /*
         * artikli za kupovinu !!!
         * */

        require(DCROOT . '/obradiApp/upitZaKorpuApp.php');

        $ArtikliKupljeni = $db->rawQuery($upitArtArrayHead);

        if (!$ArtikliKupljeni) {
            $m['tag'] = 'kupovinaKorpa';
            $m['success'] = false;
            $m['error'] = 9;
            $m['error_msg'] = "Nema Artikala u bazi";
            echo json_encode($m, JSON_UNESCAPED_UNICODE);
            die;
        }
    }

    /* KRAJ  Provaravamo Artikle koje je kupio korisnik */


    require('kupiArtikalOkApp.php');


} else {

    $m['tag'] = 'kupovinaKorpa';
    $m['success'] = false;
    $m['error'] = 10;
    $m['error_msg'] = "Nema email";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}

echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);

?>