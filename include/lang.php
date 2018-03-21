<?php
$cookie_name = 'sajtcheck';
if(!isset($_COOKIE[$cookie_name])) {
    $sajtCheck = mt_rand();
    setcookie($cookie_name,$sajtCheck, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana // false,true
    $_SESSION['sajtcheck'] = (int) $sajtCheck;

} else {

    $sajtCheck = (int) $_SESSION['sajtcheck'];
    if (!$sajtCheck) {

    }

}


// -------------------------------------------------------------- KONTROLE
if (!$_SESSION['kontrole']) {
    $_SESSION['kontrole']['sortKontrole'] = 1;
    $_SESSION['kontrole']['limitpostrani'] = (int) LIMITPOSTRANI;
    $_SESSION['kontrole']['brend'] = '';
    $kontrole = $_SESSION['kontrole'];
}


if (isset($_POST['kontrole'])) {
    $_SESSION['kontrole']['sortKontrole'] = (int) $_POST['kontrole']['sortKontrole'];
    $_SESSION['kontrole']['limitpostrani'] = (int) $_POST['kontrole']['limitpostrani'];
    $_SESSION['kontrole']['brend'] = (int) $_POST['kontrole']['brend'];
    $kontrole =  $_POST['kontrole'];
} else {
    $kontrole =  $_SESSION['kontrole'];
}

// -------------------------------------------------------------- KONTROLE KRAJ
$valutaLangSes = $common->isEmpty($_SESSION['valuta'],'int');
$stateLangSes = $common->isEmpty($_SESSION['state'],'int');
$langLangSes = $common->isEmpty($_SESSION['languageId'],'int');
$limitpostraniSes = $common->isEmpty($_SESSION['kontrole']['limitpostrani'],'int');
$sortKontroleSes = $common->isEmpty($_SESSION['kontrole']['sortKontrole'],'int');


if(($valutaLangSes>0) && ($stateLangSes>0)  && ($langLangSes>0) && ($limitpostraniSes>0)) {

    if (LOCALIZATION_ENABLED) {
        $state = (int) $_SESSION['state'];
        $jezikId = (int) $_SESSION['languageId'];
        $valutasession = (int) $_SESSION['valuta'];
        $limitpostrani = (int) $_SESSION['kontrole']['limitpostrani'];
        $sortKontrole = (int) $_SESSION['kontrole']['sortKontrole'];

    } else {
        $_SESSION['state'] = (int) LOCALIZATION_COUNTRY;
        $state = (int) LOCALIZATION_COUNTRY;

        $_SESSION['languageId'] = (int) LOCALIZATION_LANGUAGE;
        $jezikId = (int) LOCALIZATION_LANGUAGE;

        $_SESSION['valuta'] = (int) LOCALIZATION_CURRENCY;
        $valutasession = (int) LOCALIZATION_CURRENCY;

        $_SESSION['kontrole']['limitpostrani'] = (int) LIMITPOSTRANI;
        $limitpostrani = (int) LIMITPOSTRANI;

    }
} else {

    /*
     * State
     * */
    $cookie_name = 'state';
    if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, LOCALIZATION_COUNTRY, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
        $_SESSION['state'] = (int) LOCALIZATION_COUNTRY;
        $state = (int) LOCALIZATION_COUNTRY;
    } else {

        $_SESSION['state'] = LOCALIZATION_ENABLED ? (int) $_COOKIE[$cookie_name] : LOCALIZATION_COUNTRY;
        $state = (int) $_SESSION['state'];
    }

    /*
     * Language ID
     * */
    $cookie_nameIdLang = 'languageId';
    if(!isset($_COOKIE[$cookie_nameIdLang])) {
        setcookie($cookie_nameIdLang, LOCALIZATION_LANGUAGE, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
        $_SESSION['languageId'] = (int) LOCALIZATION_LANGUAGE;
        $jezikId = (int) LOCALIZATION_LANGUAGE;
    } else {
        $_SESSION['languageId'] = LOCALIZATION_ENABLED ? (int)$_COOKIE[$cookie_nameIdLang] : LOCALIZATION_LANGUAGE;
        $jezikId = (int) $_SESSION['languageId'];
    }

    /*
     * valuta
     * */
    $cookie_name = 'valuta';
    if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, LOCALIZATION_CURRENCY, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
        $_SESSION['valuta'] = (int) LOCALIZATION_CURRENCY;
        $valutasession = (int) LOCALIZATION_CURRENCY;
    } else {
        $_SESSION['valuta'] = LOCALIZATION_ENABLED ? (int)$_COOKIE[$cookie_name] : LOCALIZATION_CURRENCY;
        $valutasession = (int) $_SESSION['valuta'];
    }

    /*
    * Limit Po Strani
    * */
    $cookie_name = 'limitpostrani';
    if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, LIMITPOSTRANI, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
        $_SESSION['kontrole']['limitpostrani'] = (int) LIMITPOSTRANI;
        $limitpostrani = (int) LIMITPOSTRANI;
    } else {
        $_SESSION['kontrole']['limitpostrani'] = LOCALIZATION_ENABLED ? (int)$_COOKIE[$cookie_name] : LIMITPOSTRANI;
        $limitpostrani = (int) $_SESSION['kontrole']['limitpostrani'];
    }

}


// ovo koristimo kod  G:\projects\Masine\trunk\parts\section\blog\review.php

/*
     * Language ID
     * */
$cookie_namelanguageSrb = 'language';
if(!isset($_COOKIE[$cookie_namelanguageSrb])) {
    setcookie($cookie_namelanguageSrb, LANGUAGE_OLD, time() + (86400 * 30 * 12), "/");
    $_SESSION['language'] =  LANGUAGE_OLD;
    $jezikSrb = LANGUAGE_OLD;
} else {
    $_SESSION['language'] = LOCALIZATION_ENABLED ? $_COOKIE[$cookie_namelanguageSrb] : LANGUAGE_OLD;
    $jezikSrb = $_SESSION['language'];
}
$sesValuta = $valutasession; //cena i valuta proizvoda
