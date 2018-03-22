<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 19.8.15.
 * Time: 14.18
 */

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


/*if ($KomitentId<=0) {
    header("refresh: 0;");
    //echo 'Nema dobrog Id-a od komitenta ZATO STO NIJE DEFINISAN COOKIE reload page; '.$KomitentId;
    die;
}*/