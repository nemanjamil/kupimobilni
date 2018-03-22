<?php


//var_dump($_POST);



if ($KomitentId && $email) {

    if (isset($_POST['KomitentIme'])) {  $KomitentIme = filter_input(INPUT_POST, 'KomitentIme', FILTER_SANITIZE_STRING); } else { $KomitentIme = '';  }
    if (isset($_POST['KomitentPrezime'])) {  $KomitentPrezime = filter_input(INPUT_POST, 'KomitentPrezime', FILTER_SANITIZE_STRING); } else { $KomitentPrezime = '';  }
    if (isset($_POST['KomitentAdresa'])) {  $KomitentAdresa = filter_input(INPUT_POST, 'KomitentAdresa', FILTER_SANITIZE_STRING); } else { $KomitentAdresa = '';  }
    if (isset($_POST['KomitentMesto'])) {  $KomitentMesto = filter_input(INPUT_POST, 'KomitentMesto', FILTER_SANITIZE_STRING); } else { $KomitentMesto = '';  }
    if (isset($_POST['KomitentPosBroj'])) {  $KomitentPosBroj = filter_input(INPUT_POST, 'KomitentPosBroj', FILTER_SANITIZE_STRING); } else { $KomitentPosBroj = '';  }
    if (isset($_POST['KomitentMobTel'])) {  $KomitentMobTel = filter_input(INPUT_POST, 'KomitentMobTel', FILTER_SANITIZE_STRING); } else { $KomitentMobTel = '';  }
    if (isset($_POST['KomitentTelefon'])) {  $KomitentTelefon = filter_input(INPUT_POST, 'KomitentTelefon', FILTER_SANITIZE_STRING); } else { $KomitentTelefon = '';  }
    $napomenaNarudz = $common->clearvariable($_POST['napomena']);


    /* Proveravamo valutu */

    $valutasessionUpper = strtoupper($valutasession);

    $cols = Array ("ValutaId");
    $db->where ("ValutaId",$valutasession);
    $valup = $db->getOne("valuta", null, $cols);

    $valutaId = $valup['ValutaId'];

    if (!$valutaId)
        $error_msg .= 'Nema ID od valute <br>';
    /* KRAJ  Proveravamo valutu */

    require(DCROOT.'/stranice/upitZaKorpu.php');


    $ArtikliKupljeni = $db->rawQuery($upitArtArrayHead);



    if (!$ArtikliKupljeni) {
        $error_msg = 'Nema Artikala u bazi';
    }
    /* KRAJ  Provaravamo Artikle koje je kupio korisnik */

    require('kupiArtikalOk.php');
    header("Location: " . DPROOT . "/thank-you?e=$error_msg");


} else {
    echo $error_msg = 'Nema KomitentId ili email od korisnika';
    die;
}




?>