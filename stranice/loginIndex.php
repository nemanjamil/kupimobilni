<?php
if ($sesKor->login_check() == true) {
    include_once('podaci.php');
    $logged = true;
    $tipUsera = $KomitentTipUsera;
    $RegistrovanUBazi = true;
    if ($tipUsera >= 3) {
        $VpKorisnik = true;
    } else {
        $VpKorisnik = false;
    }
    $KomitentTipPrijave = true;


} else {
    $logged = false;
    $tipUsera = 0;
    $KomitentId = $sajtCheck;
    // Komitent rabat
    $KomiRabatKupi = 0;
    $InstaliranAppAnd = 0;
    $VpKorisnik = false;
    $KomitentiValuta = $valutasession; // ovo koristimo zbog C:\wamp64\www\kupimobilni\stranice\upitZaKorpu.php ZA VP GetKurs ($KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac)
  }
$KomitentId = filter_var($KomitentId, FILTER_SANITIZE_NUMBER_INT);


// SET KOMITENTA
require DCROOT."/stranice/setKomitent.php";

// ovo je za testiranje
$logUser['logovan'] = $logged;
$logUser['KomitentId'] = $KomitentId;
$logUser['KomitentTipUsera'] = $KomitentTipUsera;
$logUser['RegistrovanUBazi'] = $RegistrovanUBazi;
$logUser['VpKorisnik'] = $VpKorisnik;
$logUser['KomitentTipPrijave'] = $KomitentTipPrijave;
$logUser['KomitentValuta'] = $KomitentiValuta;


/*if ($KomitentId<=0) {
    header("refresh: 0;");
    //echo 'Nema dobrog Id-a od komitenta ZATO STO NIJE DEFINISAN COOKIE reload page; '.$KomitentId;
    die;
}*/